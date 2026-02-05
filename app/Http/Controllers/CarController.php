<?php

namespace App\Http\Controllers;

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

    public function showmycars()
    {
        $user = auth()->user();
        $cars = Car::where('user_id', $user->id)->get();
        return view('mycars', ['cars' => $cars]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('offercar');
    }

    public function create_step1()
    {
        $license_plate = request('license_plate');



        //HIER KOMT NOG API CALL OM TE CHECKEN OF KENTEKEN BESTAAT
        
        return redirect()->route('offercar.step2', ['license_plate' => $license_plate]);

        
    }

    public function create_step2($license_plate)
    {
        return view('offercar_step2', ['license_plate' => $license_plate]);
    }

    /**
     * Store a newly created resource in storage.
     */
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
        ],
        [
            'license_plate.required' => 'Het kenteken is verplicht.',
            'make.required' => 'Het merk is verplicht.',
            'model.required' => 'Het model is verplicht.',
            'price.required' => 'De prijs is verplicht.',
            'mileage.required' => 'De kilometerstand is verplicht.',
        ]
        );
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
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarRequest $request, Car $car)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()->route('cars.mycars')->with('success', 'Auto succesvol verwijderd!');
    }
}
