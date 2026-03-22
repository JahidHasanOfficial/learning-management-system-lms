<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Define Permissions
        $permissions = [
            // Course Management
            'course.index', 'course.create', 'course.store', 'course.edit', 'course.update', 'course.destroy',
            'course.category', 'curriculum.manage',
            
            // Role Management
            'role.index', 'role.create', 'role.store', 'role.edit', 'role.update', 'role.destroy',
            
            // User Management
            'user.index', 'user.create', 'user.store', 'user.edit', 'user.show', 'user.update', 'user.destroy',
            
            // Live Class
            'live_class.index', 'live_class.create', 'live_class.store', 'live_class.show', 'live_class.edit', 'live_class.update', 'live_class.destroy',
            
            // Student Permissions
            'student.my-courses', 'student.player',
            
            // Profile
            'profile.edit', 'profile.update', 'profile.destroy',
        ];

        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission);
        }

        // Create Roles and Assign Permissions
        
        // Super Admin: All permissions
        $superAdminRole = Role::findOrCreate('Super Admin');
        $superAdminRole->syncPermissions(Permission::all());

        // Admin: Most permissions
        $adminRole = Role::findOrCreate('Admin');
        $adminRole->syncPermissions(Permission::all());

        // Instructor: Course and Live Class management
        $instructorRole = Role::findOrCreate('Instructor');
        $instructorRole->syncPermissions([
            'course.index', 'course.create', 'course.store', 'course.edit', 'course.update', 'course.destroy',
            'curriculum.manage',
            'live_class.index', 'live_class.create', 'live_class.store', 'live_class.show', 'live_class.edit', 'live_class.update', 'live_class.destroy',
            'profile.edit', 'profile.update',
        ]);

        // Student: Learning permissions
        $studentRole = Role::findOrCreate('Student');
        $studentRole->syncPermissions([
            'student.my-courses', 'student.player',
            'profile.edit', 'profile.update',
        ]);

        // Create Default Users
        
        // Super Admin
        $superAdmin = User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'phone' => '01700000000',
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );
        $superAdmin->assignRole($superAdminRole);

        // Seed 10 Instructors
        for ($i = 1; $i <= 10; $i++) {
            $instructor = User::updateOrCreate(
                ['email' => "instructor{$i}@gmail.com"],
                [
                    'name' => "Instructor " . $i,
                    'password' => Hash::make('password'),
                    'phone' => '018' . str_pad($i, 8, '0', STR_PAD_LEFT),
                    'status' => 'active',
                    'email_verified_at' => now(),
                ]
            );
            $instructor->assignRole($instructorRole);
        }

        // Seed 20 Students
        for ($i = 1; $i <= 20; $i++) {
            $student = User::updateOrCreate(
                ['email' => "student{$i}@gmail.com"],
                [
                    'name' => "Student " . $i,
                    'password' => Hash::make('password'),
                    'phone' => '019' . str_pad($i, 8, '0', STR_PAD_LEFT),
                    'status' => 'active',
                    'email_verified_at' => now(),
                ]
            );
            $student->assignRole($studentRole);
        }
    }
}
