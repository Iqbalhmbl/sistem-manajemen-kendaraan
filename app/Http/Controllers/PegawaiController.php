<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\User;
class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function __construct()
     {
         $this->middleware('auth');
         $this->middleware('role:admin');
         $this->middleware('permission:create-pegawai|edit-pegawai|delete-pegawai', ['only' => ['index','show']]);
         $this->middleware('permission:create-pegawai', ['only' => ['create','store']]);
         $this->middleware('permission:edit-pegawai', ['only' => ['edit','update']]);
         $this->middleware('permission:delete-pegawai', ['only' => ['destroy']]);
     }

    public function index()
    {
        $pegawais = Pegawai::paginate(10);
        return view('pegawai.index', compact('pegawais'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pegawai.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'user.email' => 'required|email|unique:users,email',
            'user.password' => 'required|string|min:6',
        ]);
    
        DB::beginTransaction();
        try {
            $user = User::create([
                'id' => Str::uuid(),
                'name' => $request->input('nama'),
                'email' => $request->input('user.email'),
                'password' => Hash::make($request->input('user.password')),
            ]);
    
            // Assign role 'staff' to the user
            $user->assignRole('staff');
    
            Pegawai::create([
                'id' => Str::uuid(),
                'nama' => $request->nama,
                'jabatan' => $request->jabatan,
                'user_id' => $user->id,
            ]);
    
            DB::commit();
            return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pegawai $pegawai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pegawai = Pegawai::with('user')->findOrFail($id);
    
        return view('pegawai.edit', compact('pegawai'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'user.email' => 'required|email', 
            'user.password' => 'nullable|string|min:6',
        ]);
    
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->update([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
        ]);
    
        $user = $pegawai->user;
        $user->email = $request->input('user.email');
        if ($request->filled('user.password')) {
            $user->password = Hash::make($request->input('user.password'));
        }
        $user->save();
    
        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil diperbarui.');
    }
    

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Cari pegawai berdasarkan id
            $pegawai = Pegawai::findOrFail($id);
            
            // Hapus data user terkait
            $user = $pegawai->user;
            $user->delete();
    
            // Hapus pegawai
            $pegawai->delete();
    
            return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menghapus data: ' . $e->getMessage()]);
        }
    }
    
}
