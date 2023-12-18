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
        Admin::create([
            'first_name' => 'SuperDuperAdmin',
            'last_name' => 'SuperDuperAdmin',
            'email' => 'super-duper-admin@admin.com',
            'password' => Hash::make('admin'),
        ])
        ->roles()
        ->create([
            'name' => 'super-duper-admin',
        ])
        ->permissions()
        ->create([
            'name' => 'default',
            'comment' => 'Default permission',
        ]);

        Role::create([
            'name' => 'admin',
            'guard_name' => 'admin'
        ]);

        Role::create([
            'name' => 'employee',
            'guard_name' => 'company'
        ]);

        Role::create([
            'name' => 'administrator',
            'guard_name' => 'company'
        ]);
    }
}