<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; 
use App\Models\Car;
use App\Models\Tag;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;


class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::latest()->paginate(21);
        return view('welcome', ['cars' => $cars]);
    }

    /**
     * Show the cars of the authenticated user.
     */
    public function showmycars()
    {
        $user = auth()->user();
        $cars = Car::where('user_id', $user->id)->latest()->paginate(21);
        return view('mycars', ['cars' => $cars]);
    }

    /**
     * Show the form for creating a new car.
     */
    public function create()
    {
        return view('offercar');
    }

    /**
     * Step 1: Get car data from RDW API using license plate.
     */
    public function create_step1()
    {
        

        $license_plate_api = strtoupper(str_replace('-', '', request('license_plate')));
        $license_plate = strtoupper(request('license_plate'));

        if (Car::where('license_plate', $license_plate)->exists()) {
            return back()
                ->withInput()
                ->withErrors([
                    'license_plate' => 'Deze auto is al aangeboden.'
                ]);
        }

        //API CALL
        $response = Http::withHeaders([
            'X-App-Token' => config('services.rdw.token'),
            'Accept' => 'application/json',
        ])->get('https://opendata.rdw.nl/resource/m9d7-ebf2.json', [
            'kenteken' => $license_plate_api,
        ]);

       if ($response->failed()) {
            return back()
                ->withInput()
                ->withErrors([
                    'license_plate' => 'Fout bij het ophalen van gegevens. Probeer het later opnieuw.'
                ]);
        }

        $data = $response->json();

        if (empty($data)) {
            return back()
                ->withInput()
                ->withErrors([
                    'license_plate' => 'Kenteken niet gevonden'
                ]);
        }

        session(['car_api_data' => $data[0]]);

        return redirect()->route('offercar.step2', [
            'license_plate' => $license_plate
        ]);
    }

    
    public function create_step2($license_plate)
    {
        $car_api_data = session('car_api_data');
        return view('offercar_step2', [
            'license_plate' => $license_plate,
            'car_api_data' => $car_api_data
        ]);
    }

   
    public function store(StoreCarRequest $request)
    {
        $this->authorize('create', Car::class);

        $validated = $request->validate([
            'license_plate' => 'required|string',
            'make' => 'required|string',
            'model' => 'required|string',
            'price' => 'required|numeric|min:0|max:10000000',
            'mileage' => 'required|integer|min:0|max:1000000',
            'seats' => 'nullable|integer',
            'doors' => 'nullable|integer',
            'year' => 'nullable|integer',
            'weight' => 'nullable|integer',
            'color' => 'nullable|string',
            'image' => 'nullable|image|max:4096',
        ], [
            'license_plate.required' => 'Het kenteken is verplicht.',
            'make.required' => 'Het merk is verplicht.',
            'model.required' => 'Het model is verplicht.',
            'price.required' => 'De prijs is verplicht.',
            'mileage.required' => 'De kilometerstand is verplicht.',
            'image.image' => 'Upload een geldige afbeelding (jpg, png, webp).',
            'image.max' => 'De afbeelding mag maximaal 4MB zijn.',
            'seats.integer' => 'Het aantal zitplaatsen moet een getal zijn.',
            'doors.integer' => 'Het aantal deuren moet een getal zijn.',
            'year.integer' => 'Het bouwjaar moet een getal zijn.',
            'weight.integer' => 'Het gewicht moet een getal zijn.',
            'color.string' => 'De kleur moet een tekst zijn.',
            'price.numeric' => 'De prijs moet een getal zijn.',
            'mileage.integer' => 'De kilometerstand moet een geheel getal zijn.',
            'price.min' => 'De prijs moet minimaal 0 zijn.',
            'price.max' => 'De prijs mag niet hoger zijn dan 10.000.000',
            'mileage.min' => 'De kilometerstand moet minimaal 0 zijn.',
            'mileage.max' => 'De kilometerstand mag niet hoger zijn dan 1.000.000.',
        ]);

        $imageUrl = null;
        $imageFile = $request->file('image');
        if ($imageFile && !$imageFile->isValid()) {
            return back()
                ->withInput()
                ->withErrors([
                    'image' => 'Upload mislukt. Controleer bestandstype en grootte.'
                ]);
        }
        if ($imageFile && $imageFile->isValid()) {
            $targetDir = public_path('img/cars');
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0755, true);
            }

            $extension = $imageFile->getClientOriginalExtension();
            $filename = uniqid('car_', true) . '.' . $extension;
            $imageFile->move($targetDir, $filename);
            $imageUrl = '/img/cars/' . $filename;
        }

        $user = auth()->user();

        Car::create([
            'user_id' => $user->id,
            'license_plate' => $validated['license_plate'],
            'make' => $validated['make'],
            'model' => $validated['model'],
            'price' => $validated['price'],
            'mileage' => $validated['mileage'],
            'seats' => $validated['seats'] ?? null,
            'doors' => $validated['doors'] ?? null,
            'production_year' => $validated['year'] ?? null,
            'weight' => $validated['weight'] ?? null,
            'color' => $validated['color'] ?? null,
            'image' => $imageUrl,
        ]);

        $tags = Tag::all();
        $car = Car::where('license_plate', $validated['license_plate'])->first();
        return redirect()->route('offercar.step3', ['car' => $car])->with('tags', $tags);
    }

    public function create_step3(Car $car)
    {
        $this->authorize('view', $car);
        $tags = Tag::orderBy('name')->get();
        return view('offercar_step3', [
            'car' => $car,
            'tags' => $tags,
        ]);
    }

    public function store_tags(Request $request)
    {
        $this->authorize('update', Car::findOrFail($request->input('car_id')));
        $validated = $request->validate([
            'car_id' => 'required|exists:cars,id',
            'tags' => 'required|array',
            'tags.*' => 'exists:tags,id',
        ],[
            'car_id.required' => 'Er is een fout opgetreden bij het opslaan van de tags. Probeer het opnieuw.',
            'car_id.exists' => 'De opgegeven auto bestaat niet.',
            'tags.required' => 'Selecteer minimaal één tag, of klik op "Opslaan zonder tags".',
            'tags.array' => 'Ongeldige tags-indeling.',
            'tags.*.exists' => 'Een of meer geselecteerde tags bestaan niet.',
        ]);

        $car = Car::findOrFail($validated['car_id']);
        $car->tags()->sync($validated['tags']);

        return redirect()->route('cars.mycars')->with('success', 'Tags succesvol opgeslagen.');
    }

    public function edit_tags(Car $car)
    {
        $this->authorize('update', $car);
        $tags = Tag::orderBy('name')->get();

        return view('edit_tags', [
            'car' => $car,
            'tags' => $tags,
        ]);
    }

    /**
     * Display the specified car.
     */
    public function show(Car $car)
    {
        $car = Car::findOrFail($car->id);
        $car->increment('views');
        return view('show_car', ['car' => $car]);
    }

    /**
     * Show the form for editing the specified car.
     */
    public function edit(Car $car)
    {
        //
    }

    /**
     * Update the specified car in storage.
     */
    public function update(UpdateCarRequest $request, Car $car)
    {
        
    }

    /**
     * Remove the specified car from storage.
     */
    public function destroy(Car $car)
    {
        $this->authorize('delete', $car);
        $car->delete();
        return redirect()->route('cars.mycars')->with('success', 'Auto succesvol verwijderd!');
    }
}
