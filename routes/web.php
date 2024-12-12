<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReportController;
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
    
    // Halaman Login
    Route::get('/login', function() { 
        return view ('auth.form'); 
    })->name('login');
    
    Route::post('/login', [LoginController::class, 'loginAuth'])->name('login.auth');

    //logout
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

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

    Route::prefix('/report')->name('report.')->group(function() {
        Route::get('/create', [ReportController::class, 'create'])->name('create');
        Route::post('/store', [ReportController::class, 'store'])->name('store');
    });