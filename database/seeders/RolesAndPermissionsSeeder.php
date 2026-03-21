<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Define ALL granular permissions
        $permissions = [
            'dashboard access',

            // User Management 
            'user.index', 'user.create', 'user.store', 'user.show', 'user.edit', 'user.update', 'user.destroy',

            // Role Management
            'role.index', 'role.create', 'role.store', 'role.show', 'role.edit', 'role.update', 'role.destroy',

            // Course Management
            'course.index', 'course.create', 'course.store', 'course.show', 'course.edit', 'course.update', 'course.destroy',
            'course.category', 'course.enroll',

            // Subscription Management
            'subscription.index', 'subscription.create', 'subscription.store', 'subscription.show', 'subscription.edit', 'subscription.update', 'subscription.destroy',

            // Student Management
            'student.index', 'student.show', 'student.progress',

            // Job Placement
            'job.index', 'job.create', 'job.store', 'job.show', 'job.edit', 'job.update', 'job.destroy',
        ];

        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission);
        }

        // create roles and assign existing permissions
        $roleSuperAdmin = Role::findOrCreate('Super Admin');
        $roleAdmin = Role::findOrCreate('Admin');
        $roleInstructor = Role::findOrCreate('Instructor');
        $roleStudent = Role::findOrCreate('Student');

        $roleSuperAdmin->givePermissionTo(Permission::all());

        $roleAdmin->givePermissionTo([
            'dashboard access',
            'user.index', 'user.show',
            'course.index', 'course.show',
            'subscription.index', 'subscription.show',
            'student.index', 'student.show',
            'job.index', 'job.show',
        ]);

        $roleInstructor->givePermissionTo([
            'dashboard access',
            'course.index', 'course.create', 'course.store', 'course.edit', 'course.update',
            'student.index', 'student.show',
        ]);

        $roleStudent->givePermissionTo([
            'dashboard access',
            'course.index', 'course.show', 'course.enroll',
            'student.progress',
        ]);

        // Create a default super admin user if not exists
        $admin = User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'status' => 'active',
            ]
        );
        $admin->assignRole($roleSuperAdmin);

        // Create a default instructor user
        $instructor = User::updateOrCreate(
            ['email' => 'instructor@gmail.com'],
            [
                'name' => 'Jahid Instructor',
                'password' => Hash::make('password'),
                'status' => 'active',
            ]
        );
        $instructor->assignRole($roleInstructor);

        // Create a default student user
        $student = User::updateOrCreate(
            ['email' => 'student@gmail.com'],
            [
                'name' => 'Hasan Student',
                'password' => Hash::make('password'),
                'status' => 'active',
            ]
        );
        $student->assignRole($roleStudent);
    }
}
