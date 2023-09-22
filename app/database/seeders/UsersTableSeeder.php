<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(User $user): void
    {
        $userData = [
            'username' => 'admin',
            'password' => Hash::make('admin')
        ];
        $user->create($userData);
    }
}
