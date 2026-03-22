<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Services\RoleService;

class RoleController extends Controller
{
    protected $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    /**
     * Display a listing of the roles.
     */
    public function index()
    {
        $roles = $this->roleService->getAllRoles();
        return view('backend.pages.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new role.
     */
    public function create()
    {
        $permissions = $this->roleService->getAllPermissions();
        $permission_groups = $permissions->groupBy(function($item) {
            return explode('.', $item->name)[0];
        });
        
        return view('backend.pages.roles.create', compact('permissions', 'permission_groups'));
    }

    /**
     * Store a newly created role in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:roles,name']);
        
        $this->roleService->storeRole($request->all());

        return redirect()->route('role.index')
            ->with('success', 'Role created successfully.');
    }

    /**
     * Show the form for editing the specified role.
     */
    public function edit(Role $role)
    {
        $permissions = $this->roleService->getAllPermissions();
        $permission_groups = $permissions->groupBy(function($item) {
            return explode('.', $item->name)[0];
        });
        
        return view('backend.pages.roles.edit', compact('role', 'permissions', 'permission_groups'));
    }

    /**
     * Update the specified role in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate(['name' => 'required|unique:roles,name,' . $role->id]);
        
        $this->roleService->updateRole($role, $request->all());

        return redirect()->route('role.index')
            ->with('success', 'Role updated successfully.');
    }

    /**
     * Remove the specified role from storage.
     */
    public function destroy(Role $role)
    {
        $this->roleService->deleteRole($role);

        return redirect()->route('role.index')
            ->with('success', 'Role deleted successfully.');
    }
}
