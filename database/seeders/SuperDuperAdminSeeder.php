<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class SuperDuperAdminSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Admin::updateOrCreate([
            'first_name' => 'SuperDuperAdmin',
            'last_name' => 'SuperDuperAdmin',
            'email' => 'super-duper-admin@admin.com',
            'password' => Hash::make('admin'),
        ])
        ->roles()
        ->updateOrCreate([
            'name' => 'super-duper-admin',
        ])
        ->permissions()
        ->updateOrCreate([
            'name' => 'default',
            'comment' => 'Default permission',
        ]);

        // Role::updateOrCreate([
        //     'name' => 'admin',
        //     'guard_name' => 'admin'
        // ]);

        // Role::updateOrCreate([
        //     'name' => 'employee',
        //     'guard_name' => 'company'
        // ]);

        // Role::updateOrCreate([
        //     'name' => 'administrator',
        //     'guard_name' => 'company'
        // ]);
    }
}