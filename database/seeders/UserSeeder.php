<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    private array $initialUsers = [
        [
            'name' => 'Amar Hidić',
            'email' => 'office@hidicamar.com',
            'password' => 'password',
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->initialUsers as $initialUser) {
            User::query()->updateOrCreate(
                [
                    'email' => $initialUser['email'],
                ],
                [
                    'name' => $initialUser['name'],
                    'email_verified_at' => now(),
                    'password' => Hash::make($initialUser['password']),
                ]
            );
        }
    }
}
