<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bike;
use Illuminate\Validation\Rule;

class BikeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bikes = Bike::all();

        return view('bikes.index', compact('bikes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('bikes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = request->validate([
            'serial_number' => ['required', 'string', 'unique:bikes, serial_number'],
            'model' => ['required', 'string', 'max:255'],
            'price_per_hour' => ['required', 'numeric', 'min:0'],
            'status' => ['required', Rule::in(['available', 'rented', 'maintenance'])],
        ]);

        Bike::create($data);

        return redirect()->route('bikes.index')->with('success', 'Bicicleta añadida correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $bike = Bike::findOrFail($id);
        return view('bikes.show', compact('bike'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $bike = Bike::findOrFail($id);
        return view('bikes.edit', compact('bike'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = request->validate([
            'serial_number' => ['required', 'string', 'unique:bikes, serial_number'],
            'model' => ['required', 'string', 'max:255'],
            'price_per_hour' => ['required', 'numeric', 'min:0'],
            'status' => ['required', Rule::in(['available', 'rented', 'maintenance'])],
        ]);   

        Bike::update($data);

        return redirect()->route('bikes.index')->with('success', 'Bicicleta actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bike->delete();

        return redirect()->route('bikes.index')->with('success', 'Bicicleta eliminada correctamente.');
    }
}
