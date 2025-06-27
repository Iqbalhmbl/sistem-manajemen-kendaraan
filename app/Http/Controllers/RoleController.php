<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-role|edit-role|delete-role', ['only' => ['index','show']]);
        $this->middleware('permission:create-role', ['only' => ['create','store']]);
        $this->middleware('permission:edit-role', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-role', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::with('permissions')->paginate(10);
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($uuid)
    {
        $role = Role::where('uuid', $uuid)->with('permissions')->firstOrFail();
        $permissions = Permission::all();
        return view('roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        $request->validate([
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,uuid',
        ]);

        $role = Role::where('uuid', $uuid)->firstOrFail();

        $permissionUuids = $request->input('permissions', []);
        $permissionIds = Permission::whereIn('uuid', $permissionUuids)->pluck('uuid');
        
        $role->syncPermissions($permissionIds);
        
        return redirect()->route('roles.index')->with('success', 'Permissions updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        $role = Role::where('uuid', $uuid)->firstOrFail();
        $role->delete();
    
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }
}
