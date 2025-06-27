<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function index(Request $request)
     {
         $query = User::with('roles');
     
         if ($request->filled('search')) {
             $search = $request->search;
             $query->where(function ($q) use ($search) {
                 $q->where('name', 'like', "%$search%")
                   ->orWhere('email', 'like', "%$search%");
             });
         }
     
         if ($request->filled('sort_by') && $request->filled('order')) {
             $query->orderBy($request->sort_by, $request->order);
         } else {
             $query->latest();
         }
     
         $users = $query->paginate(10)->appends($request->all());
     
         return view('users.index', compact('users'));
     }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed|min:6',
            'role' => 'required|exists:roles,uuid',
        ]);
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
    
        $user->assignRole($request->role);
    
        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::where('id', $id)->firstOrFail();
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|confirmed|min:6',
            'role' => 'required|exists:roles,uuid',
        ]);
    
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
    
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
    
        $user->save();
    
        $user->syncRoles([$request->role]);
    
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::where('id', $id)->firstOrFail();
        $user->roles()->detach();
        $user->delete();
    
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    public function export(Request $request)
    {
        $fields = $request->input('fields', ['name', 'email', 'roles']);
        return Excel::download(new UsersExport($fields), 'users.xlsx');
    }
    
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv,xls',
        ]);

        // Excel::import(new UsersImport, $request->file('file'));

        //queue
        Excel::queueImport(new UsersImport, $request->file('file'));

        return back()->with('success', 'Import sedang diproses di background (queue).');
    }
}
