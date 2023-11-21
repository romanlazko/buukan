<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function create($data, string $role): User
    {
        $user = User::updateOrCreate([
            'email' => $data['email'],
        ],
        $data);

        

        return $user;
    }
}