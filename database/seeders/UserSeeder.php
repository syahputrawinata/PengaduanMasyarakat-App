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

        $headstaff = User::create([
            'email' => 'haceh@provinsi.com',
            'password' => Hash::make('12345678'),  // Gantilah dengan password yang aman
            'role' => 'head_staff', // Role headstaff
        ]);

        // Menghubungkan headstaff dengan provinsi
        StaffProvince::create([
            'user_id' => $headstaff->id, // ID user headstaff
            'province' => '11',  // Provinsi yang ditugaskan
        ]);
    }
}
