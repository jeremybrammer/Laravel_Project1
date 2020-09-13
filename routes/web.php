<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes(['verify' => true]);

Route::middleware(['verified', 'auth'])->group(function(){
    Route::redirect('/', '/home');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


});

//Houses routes:
Route::get('/houses', [App\Http\Controllers\HouseController::class, 'index']);
Route::get('/houses/create', [App\Http\Controllers\HouseController::class, 'create']);
Route::post('/houses/create', [App\Http\Controllers\HouseController::class, 'store']);
Route::get('/houses/edit', [App\Http\Controllers\HouseController::class, 'edit']);
