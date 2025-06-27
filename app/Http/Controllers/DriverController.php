<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Region;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::with('region')->orderBy('created_at', 'desc')->paginate(10);
        return view('drivers.index', compact('drivers'));
    }

    public function create()
    {
        $regions = Region::all();
        return view('drivers.create', compact('regions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'no_hp' => 'required|string|max:20',
            'region_id' => 'required|exists:regions,id',
        ]);

        Driver::create($request->all());

        return redirect()->route('drivers.index')->with('success', 'Driver berhasil ditambahkan.');
    }

    public function show(Driver $driver)
    {
        $driver->load('region');
        return view('drivers.show', compact('driver'));
    }

    public function edit(Driver $driver)
    {
        $regions = Region::all();
        return view('drivers.edit', compact('driver', 'regions'));
    }

    public function update(Request $request, Driver $driver)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'no_hp' => 'required|string|max:20',
            'region_id' => 'required|exists:regions,id',
        ]);

        $driver->update($request->all());

        return redirect()->route('drivers.index')->with('success', 'Driver berhasil diperbarui.');
    }

    public function destroy(Driver $driver)
    {
        $driver->delete();
        return redirect()->route('drivers.index')->with('success', 'Driver berhasil dihapus.');
    }
}
