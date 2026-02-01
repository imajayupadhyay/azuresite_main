<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Ajay Upadhyay',
            'email' => 'ajayupadhyayadevops@gmail.co',
            'password' => Hash::make('Ajay@99N#'),
            'email_verified_at' => now(),
        ]);
    }
}
