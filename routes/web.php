<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
    // Halaman Awal
    Route::get('/', function () {
        return view('welcome');
    });
    
    Route::get('/login', function() { 
        return view ('auth.form'); 
    })->name('login');
    
    Route::post('/login', [LoginController::class, 'loginAuth'])->name('login.auth');

    // Route::get('/register', function() { 
    //     return view ('auth.login'); 
    // })->name('register');
    // Route::post('/register', [LoginController::class, 'registerAuth'])->name('register.auth');


    // Halaman Headstaff
    Route::get('/headstaff.dashboard', function (){
        return view('headstaff.dashboard');
        })->name('headstaff.dashboard');
    // Halaman Staff
    Route::get('/staff.dashboard', function (){
        return view('staff.dashboard');
        })->name('staff.dashboard');

    // Halaman Guest
    Route::get('/guest.dashboard', function (){
        return view('guest.dashboard');
        })->name('guest.dashboard');