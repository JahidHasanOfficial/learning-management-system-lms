<?php

namespace App\Services;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleService
{
    /**
     * Get all roles.
     */
    public function getAllRoles()
    {
        return Role::all();
    }

    /**
     * Get all permissions.
     */
    public function getAllPermissions()
    {
        return Permission::all();
    }

    /**
     * Store a new role.
     */
    public function storeRole(array $data)
    {
        $role = Role::create(['name' => $data['name']]);
        if (isset($data['permissions'])) {
            $role->syncPermissions($data['permissions']);
        }
        return $role;
    }

    /**
     * Update an existing role.
     */
    public function updateRole(Role $role, array $data)
    {
        $role->update(['name' => $data['name']]);
        if (isset($data['permissions'])) {
            $role->syncPermissions($data['permissions']);
        } else {
            $role->syncPermissions([]);
        }
        return $role;
    }

    /**
     * Delete a role.
     */
    public function deleteRole(Role $role)
    {
        return $role->delete();
    }
}
