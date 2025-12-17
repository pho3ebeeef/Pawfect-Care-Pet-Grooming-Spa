<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Client;

class ClientSeeder extends Seeder
{
    public function run(): void
    {
        // Loop through all users and ensure they have a client record
        User::all()->each(function ($user) {
            Client::firstOrCreate(
                ['id' => $user->id], // match user ID
                [
                    'id'        => $user->id,
                    'user_id'   => $user->id,
                    'full_name' => $user->name,
                    'email'     => $user->email,
                ]
            );
        });
    }
}