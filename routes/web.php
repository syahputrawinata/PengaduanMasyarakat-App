<?php

// use App\Models\Report;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\headstaffController;
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

    Route::get('/monitoring', function () {
        return view('guest.report.monitoring');
    });
    
    // Halaman Login
    Route::get('/login', function() { 
        return view ('auth.form'); 
    })->name('login');
    
    Route::post('/login', [LoginController::class, 'loginAuth'])->name('login.auth');

    //logout
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    // Halaman Headstaff
    // Route::get('/headstaff.dashboard', function (){
    //     return view('headstaff.dashboard');
    //     })->name('headstaff.dashboard');

    Route::prefix('/headstaff')->name('headstaff.')->group(function(){
        Route::get('/landing', [headstaffController::class, 'index'])->name('index');
    });

    Route::prefix('/user')->name('user.')->group(function(){
        Route::get('/', [headstaffController::class, 'userIndex'])->name('userIndex');
    });

    // Halaman Staff

    Route::prefix('/staff')->name('staff.')->group(function(){
        Route::get('/landing', [StaffController::class, 'index'])->name('index');
    });

    // Halaman Guest
// Route::get('/guest.dashboard', function () {
//     $reports = Report::all(); // Ambil semua data laporan
//     return view('guest.dashboard', compact('reports')); // Kirim data ke view
// })->name('guest.dashboard');

    Route::prefix('/report')->name('report.')->group(function() {
        Route::get('/landing', [ReportController::class, 'index'])->name('index');
        Route::get('/create', [ReportController::class, 'create'])->name('create');
        Route::post('/store', [ReportController::class, 'store'])->name('store');
        Route::get('report/{id}', [ReportController::class, 'show'])->name('show');
        Route::post('report/{id}/voting', [ReportController::class, 'voting'])->name('voting');
        Route::post('/report/{id}/comment', [ReportController::class, 'comment'])->name('comment');
    });