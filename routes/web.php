<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RandomNameController;

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

Route::get('/get-names', 'NameController@getNames');
Route::get('/random-names', [RandomNameController::class, 'index'])->name('random-names.index');
Route::post('/random-names/store', [RandomNameController::class, 'store'])->name('random-names.store');
Route::post('/random-names/choice', [RandomNameController::class, 'choice'])->name('random-names.choice');
Route::post('/random-names/upload', [RandomNameController::class, 'upload'])->name('random-names.upload');
Route::post('/random-names/{id}', [RandomNameController::class, 'addToTarget'])->name('add-to-target');
Route::delete('/random-names/{id}', [RandomNameController::class, 'deleteFromTarget'])->name('delete-from-target');
Route::delete('/names/{id}', [RandomNameController::class, 'destroy'])->name('delete-name');



