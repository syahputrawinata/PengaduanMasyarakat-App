<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'name' => 'Headstaff',
            'email' => 'Headstaff@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'head_staff',
        ]);

        User::create([
            'name' => 'Staff',
            'email' => 'Staff@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'staff',
        ]);

        User::create([
            'name' => 'Guest',
            'email' => 'Guest@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'Guest',
        ]);
    }
}
