<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RandomNameController;
use App\Http\Controllers\AddName;
use App\Http\Controllers\login;

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

Route::get('/', function () {
    return view('Gatcha');
});
// Route tanpa autentikasi
Route::get('/addName', [AddName::class, 'index'])->name('addName.index');

// Route untuk login dan logout tanpa autentikasi
Route::get('/login', [Login::class, 'showLoginForm'])->name('login');
Route::post('/login', [Login::class, 'login'])->name('login-process');
Route::post('/logout', function () {
    auth()->logout();
    return redirect()->route('login');
})->name('logout');

// Route yang memerlukan autentikasi
Route::middleware('auth')->group(function () {
    Route::get('/random-names', [RandomNameController::class, 'index'])->name('random-names.index');
    Route::post('/random-names/store', [RandomNameController::class, 'store'])->name('random-names.store');
    Route::post('/random-names/upload', [RandomNameController::class, 'upload'])->name('random-names.upload');
    Route::post('/random-names/{id}', [RandomNameController::class, 'addToTarget'])->name('add-to-target');
    Route::delete('/random-names/{id}', [RandomNameController::class, 'deleteFromTarget'])->name('delete-from-target');
    Route::delete('/names/{id}', [RandomNameController::class, 'destroy'])->name('delete-name');
    Route::delete('/reset-names', [RandomNameController::class, 'resetNames'])->name('reset-names');
});
