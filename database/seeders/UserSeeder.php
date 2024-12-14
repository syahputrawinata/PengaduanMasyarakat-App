<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\StaffProvince;
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
         // Membuat akun Staff
         $staff = User::create([
            'email' => 'staff@provinsi.com',
            'password' => Hash::make('12345678'),  // Gantilah dengan password yang aman
            'role' => 'staff', // Role staff
        ]);

        // Menghubungkan staff dengan provinsi
        StaffProvince::create([
            'user_id' => $staff->id, // ID user staff
            'province' => '32',  // Provinsi yang ditugaskan
        ]);

        // Membuat akun Headstaff
        $headstaff = User::create([
            'email' => 'headstaff@provinsi.com',
            'password' => Hash::make('12345678'),  // Gantilah dengan password yang aman
            'role' => 'head_staff', // Role headstaff
        ]);

        // Menghubungkan headstaff dengan provinsi
        StaffProvince::create([
            'user_id' => $headstaff->id, // ID user headstaff
            'province' => '32',  // Provinsi yang ditugaskan
        ]);
    }
}
