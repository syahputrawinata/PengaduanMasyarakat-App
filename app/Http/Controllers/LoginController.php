<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function loginAuth (Request $request)
    {
        // Cek tombol mana yang ditekan
        if ($request->has('login')) {
            // Proses Login
            $credentials = $request->validate([
                'email' => 'required|email:dns',
                'password' => 'required|min:8',
            ]);

            if (Auth::attempt($credentials)) {
                // Ambil user yang login
                $users = Auth::User();

                // Cek role dan arahkan ke halaman yang sesuai
                if ($users->role === 'head_staff') {
                    return redirect()->route('headstaff.dashboard')->with('success', 'Anda telah login sebagai Head Staff!');
                } elseif ($users->role === 'staff') {
                    return redirect()->route('staff.dashboard')->with('success', 'Anda telah login sebagai Staff!');
                } elseif ($users->role === 'guest') {
                    return redirect()->route('guest.dashboard')->with('success', 'Anda telah login sebagai Guest!');
                }
            }

            return redirect()->back()->with('failed', 'Email atau password salah.'); // Jika login gagal
        }

        if ($request->has('register')) {
            // Proses Register
            $data = $request->validate([
                'email' => 'required|email:dns|unique:users,email',
                'password' => 'required|string|min:8',
                // 'role' => 'required|in:head_staff,staff,guest', // Pastikan role disertakan
            ]);

            // Buat user baru
            $users = User::create([
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                // 'role' => $data['role'], // Tentukan role
            ]);

            // Login user setelah registrasi
            Auth::login($users);

            return redirect()->route('guest.dashboard')->with('success', 'Akun terbuat!Anda telah login!');
        }

        return redirect()->back()->with('failregis', 'Email sudah terdaftaf');
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('logout', 'Anda telah logout!');
    }
}
