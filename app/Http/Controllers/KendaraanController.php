<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Region;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    public function index(Request $request)
    {
        $query = Kendaraan::with('region');

        // Optional: filter/search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('nomor_polisi', 'like', "%$search%")
                  ->orWhere('merk', 'like', "%$search%")
                  ->orWhere('model', 'like', "%$search%");
        }

        $kendaraans = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('kendaraans.index', compact('kendaraans'));
    }

    public function create()
    {
        $regions = Region::all();
        return view('kendaraans.create', compact('regions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_polisi' => 'required|string|max:20|unique:kendaraans,nomor_polisi',
            'tipe' => 'required|in:angkut_orang,angkut_barang',
            'kepemilikan' => 'required|in:perusahaan,sewa',
            'merk' => 'required|string|max:50',
            'model' => 'required|string|max:50',
            'tahun' => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'region_id' => 'required|exists:regions,id',
            'status' => 'required|in:aktif,tidak_aktif',
        ]);

        Kendaraan::create($request->all());

        return redirect()->route('kendaraans.index')->with('success', 'Data kendaraan berhasil disimpan.');
    }

    public function show(Kendaraan $kendaraan)
    {
        $kendaraan->load('region');
        return view('kendaraans.show', compact('kendaraan'));
    }

    public function edit(Kendaraan $kendaraan)
    {
        $regions = Region::all();
        return view('kendaraans.edit', compact('kendaraan', 'regions'));
    }

    public function update(Request $request, Kendaraan $kendaraan)
    {
        $request->validate([
            'nomor_polisi' => 'required|string|max:20|unique:kendaraans,nomor_polisi,' . $kendaraan->id,
            'tipe' => 'required|in:angkut_orang,angkut_barang',
            'kepemilikan' => 'required|in:perusahaan,sewa',
            'merk' => 'required|string|max:50',
            'model' => 'required|string|max:50',
            'tahun' => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'region_id' => 'required|exists:regions,id',
            'status' => 'required|in:aktif,tidak_aktif',
        ]);

        $kendaraan->update($request->all());

        return redirect()->route('kendaraans.index')->with('success', 'Data kendaraan berhasil diperbarui.');
    }

    public function destroy(Kendaraan $kendaraan)
    {
        $kendaraan->delete();
        return redirect()->route('kendaraans.index')->with('success', 'Data kendaraan berhasil dihapus.');
    }
}
