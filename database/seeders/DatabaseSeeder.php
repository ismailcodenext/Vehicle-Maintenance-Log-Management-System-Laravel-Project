<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            'firstName' => 'super',
            'lastName' => 'admin',
            'email' => 'admin@vmlms.com',
            'password' => Hash::make('password'),
            'img_url' => 'images/default.jpg',
            'mobile' => '1234567890',
            'status' => 'approved',

        ]);
    }
}
