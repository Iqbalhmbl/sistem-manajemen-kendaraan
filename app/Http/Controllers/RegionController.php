<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $regions = Region::orderBy('created_at', 'desc')->paginate(10);
        return view('regions.index', compact('regions'));
    }

    public function create()
    {
        return view('regions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_region' => 'required|string|max:100',
            'tipe' => 'required|in:kantor_pusat,kantor_cabang,tambang',
            'alamat' => 'required|string',
        ]);

        Region::create($request->all());

        return redirect()->route('regions.index')->with('success', 'Region created successfully.');
    }

    public function show(Region $region)
    {
        return view('regions.show', compact('region'));
    }

    public function edit(Region $region)
    {
        return view('regions.edit', compact('region'));
    }

    public function update(Request $request, Region $region)
    {
        $request->validate([
            'nama_region' => 'required|string|max:100',
            'tipe' => 'required|in:kantor_pusat,kantor_cabang,tambang',
            'alamat' => 'required|string',
        ]);

        $region->update($request->all());

        return redirect()->route('regions.index')->with('success', 'Region updated successfully.');
    }

    public function destroy(Region $region)
    {
        $region->delete();
        return redirect()->route('regions.index')->with('success', 'Region deleted successfully.');
    }
}
