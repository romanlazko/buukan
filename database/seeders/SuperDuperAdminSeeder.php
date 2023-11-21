<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
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
        User::create([
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