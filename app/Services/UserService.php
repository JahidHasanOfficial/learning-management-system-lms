<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Helpers\ImageHelper;

class UserService
{
    /**
     * Get all users.
     */
    public function getAllUsers()
    {
        return User::with('roles')->latest()->paginate(10);
    }

    /**
     * Store a new user.
     */
    public function storeUser(array $data)
    {
        if (isset($data['profile_image'])) {
            $data['profile_image'] = ImageHelper::create($data['profile_image'], 'users');
        }

        $data['password'] = Hash::make($data['password']);
        
        $user = User::create($data);
        
        if (isset($data['roles'])) {
            $user->syncRoles($data['roles']);
        }

        return $user;
    }

    /**
     * Update an existing user.
     */
    public function updateUser(User $user, array $data)
    {
        if (isset($data['profile_image'])) {
            $data['profile_image'] = ImageHelper::update($data['profile_image'], 'users', $user->profile_image);
        }

        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        if (isset($data['roles'])) {
            $user->syncRoles($data['roles']);
        }

        return $user;
    }

    /**
     * Toggle user status (Active/Inactive/Suspend).
     */
    public function toggleStatus(User $user, string $status)
    {
        $user->update(['status' => $status]);
        return $user;
    }

    /**
     * Delete a user.
     */
    public function deleteUser(User $user)
    {
        ImageHelper::delete($user->profile_image);
        return $user->delete();
    }
}
