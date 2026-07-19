<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    private array $initialUsers = [
        [
            'first_name' => 'Amar',
            'last_name' => 'Hidić',
            'email' => 'office@hidicamar.com',
            'password' => 'password',
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->initialUsers as $key => $initalUser) {
            $userModel = User::query()
                ->updateOrcreate(
                    [
                        'email' => $initalUser['email'],
                    ],
                    [
                        'first_name' => $initalUser['first_name'],
                        'last_name' => $initalUser['last_name'],
                        'email' => $initalUser['email'],
                        'email_verified_at' => now(),
                        'password' => Hash::make($initalUser['password']),
                    ]
                );
        }
    }
}
