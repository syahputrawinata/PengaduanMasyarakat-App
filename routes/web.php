<?php

// use App\Models\Report;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\headstaffController;
use App\Http\Controllers\ExportController;
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
//error permission
Route::get('/error.permission', function() {
    return view('error-permission');
})->name('error.permission');

    // Halaman Awal/////////////////////////////////////////////////////////////////////////////////
Route::middleware(['IsLanding'])->group(function(){ 
    Route::get('/', function () {
        return view('welcome');
    });
    
    // Halaman Login/////////////////////////////////////////////////////////////////////////////////
    Route::get('/login', function() { 
        return view ('auth.form'); 
    })->name('login');
    
    Route::post('/login', [LoginController::class, 'loginAuth'])->name('login.auth');
});

Route::middleware(['IsLogin'])->group(function(){ 
    //logout
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

/////headstaff////////////////////////////////////////////////
Route::middleware(['IsHeadstaff'])->group(function () {
    Route::prefix('/headstaff')->name('headstaff.')->group(function(){
        Route::get('/landing', [headstaffController::class, 'index'])->name('index');
    });

    Route::prefix('/user')->name('user.')->group(function(){
        Route::get('/', [headstaffController::class, 'userIndex'])->name('userIndex');
        Route::post('/store', [headstaffController::class, 'store'])->name('store');
        Route::post('/reset-password/{userId}', [headstaffController::class, 'resetPassword'])->name('resetPassword');
        Route::delete('/staff/{id}', [headstaffController::class, 'destroy'])->name('destroy');
    });
});

    // Halaman Staff///////////////////////////////////////////////////////////////////////////////
Route::middleware(['IsStaff'])->group(function () {
    Route::prefix('/staff')->name('staff.')->group(function(){
        Route::get('/landing', [StaffController::class, 'index'])->name('index');
        Route::get('/report/{id}/tanggapan', [StaffController::class, 'show'])->name('show'); //tanggapan 
        Route::patch('/report/{id}/status', [StaffController::class, 'createResponse'])->name('createResponse');
        Route::post('/report/{responseId}/progress', [StaffController::class, 'createProgress'])->name('createProgress');
        Route::patch('/report/{id}/reject', [StaffController::class, 'reject'])->name('reject'); 
        Route::patch('/report/{id}/done', [StaffController::class, 'completeResponse'])->name('completeResponse'); 
        Route::delete('/report/{id}/delete', [StaffController::class, 'deleteProgress'])->name('deleteProgress'); 
    });

    Route::prefix('/export')->name('export.')->group(function(){
        Route::get('/all', [ExportController::class, 'exportAllReports'])->name('exportAll');
        Route::get('/filter', [ExportController::class, 'exportFilteredReports'])->name('exportFiltered');
    });
});


    // Halaman Guest///////////////////////////////////////////////////////////////////////////
Route::middleware(['IsGuest'])->group(function () {
// Route::get('/guest.dashboard', function () {
//     $reports = Report::all(); // Ambil semua data laporan
//     return view('guest.dashboard', compact('reports')); // Kirim data ke view
// })->name('guest.dashboard');

    Route::prefix('/report')->name('report.')->group(function() {
        Route::get('/landing', [ReportController::class, 'index'])->name('index');
        Route::get('/create', [ReportController::class, 'create'])->name('create');
        Route::post('/store', [ReportController::class, 'store'])->name('store');
        Route::get('report/{id}', [ReportController::class, 'show'])->name('show'); ////tampilan detail report
        Route::get('/monitoring', [ReportController::class, 'showMonitoring'])->name('showMonitoring'); ////tampilan monitoring
        Route::delete('/reports/{id}', [ReportController::class, 'deleteMonitoring'])->name('deleteMonitoring');
        Route::post('report/{id}/voting', [ReportController::class, 'voting'])->name('voting');
        Route::post('/report/{id}/comment', [ReportController::class, 'comment'])->name('comment');
    });
});

});