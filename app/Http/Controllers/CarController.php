<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // ✅ correcte import
use App\Models\Car;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the cars of the authenticated user.
     */
    public function showmycars()
    {
        $user = auth()->user();
        $cars = Car::where('user_id', $user->id)->get();
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
        $validated = $request->validate([
            'license_plate' => 'required|string',
            'make' => 'required|string',
            'model' => 'required|string',
            'price' => 'required|numeric',
            'mileage' => 'required|integer',
            'seats' => 'nullable|integer',
            'doors' => 'nullable|integer',
            'year' => 'nullable|integer',
            'weight' => 'nullable|integer',
            'color' => 'nullable|string',
        ], [
            'license_plate.required' => 'Het kenteken is verplicht.',
            'make.required' => 'Het merk is verplicht.',
            'model.required' => 'Het model is verplicht.',
            'price.required' => 'De prijs is verplicht.',
            'mileage.required' => 'De kilometerstand is verplicht.',
        ]);

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
        ]);

        return redirect()->route('home')->with('success', 'Auto succesvol toegevoegd!');
    }

    /**
     * Display the specified car.
     */
    public function show(Car $car)
    {
        //
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
        //
    }

    /**
     * Remove the specified car from storage.
     */
    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()->route('cars.mycars')->with('success', 'Auto succesvol verwijderd!');
    }
}
