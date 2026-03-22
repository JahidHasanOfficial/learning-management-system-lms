<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Services\UserService;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the users.
     */
    public function index()
    {
        $users = $this->userService->getAllUsers();
        return view('backend.pages.users.index', compact('users'));
    }

    /**
     * Display the specified user profile.
     */
    public function show(User $user)
    {
        return view('backend.pages.users.show', compact('user'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        $roles = Role::all();
        return view('backend.pages.users.create', compact('roles'));
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'required|array',
            'profile_image' => 'nullable|image|max:2048',
        ]);
        
        $this->userService->storeUser($request->all());

        return redirect()->route('user.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('backend.pages.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'roles' => 'required|array',
            'profile_image' => 'nullable|image|max:2048',
        ]);
        
        $this->userService->updateUser($user, $request->all());

        return redirect()->route('user.index')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Toggle user status (Suspend/Activate).
     */
    public function status(User $user, Request $request)
    {
        $status = $request->input('status');
        $this->userService->toggleStatus($user, $status);

        return redirect()->route('user.index')
            ->with('success', 'User status updated to ' . $status);
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        if ($user->hasRole('Super Admin')) {
            return redirect()->back()->with('error', 'Super Admin cannot be deleted.');
        }

        $this->userService->deleteUser($user);

        return redirect()->route('user.index')
            ->with('success', 'User deleted successfully.');
    }
}
