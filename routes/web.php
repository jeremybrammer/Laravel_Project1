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

Route::redirect('/', '/home');

Route::middleware(['verified'])->group(function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //Show all listings:
    Route::get('/houses/all', [App\Http\Controllers\HouseController::class, 'allListings'])->name('house.all-listings');

    //AJAX routes:
    //Return all listings as JSON:
    Route::get('/houses/allAsAjax', [App\Http\Controllers\HouseController::class, 'allListingsAjax'])->name('house.all-listings-ajax');
    //Get listings by zip code.
    Route::get('/houses/getListingsByZipCodeAjax/{zipCode}', [App\Http\Controllers\HouseController::class, 'getListingsByZipCodeAjax'])->name('house.get-by-zip-ajax');
    //Get listings by upper case two-letter state.
    Route::get('/houses/getListingsByStateAjax/{twoLetterState}', [App\Http\Controllers\HouseController::class, 'getListingsByStateAjax'])->name('house.get-by-state-ajax');

    //Houses resource controller route:
    Route::resource('/houses', App\Http\Controllers\HouseController::class);
});

// Route::get('/houses', [App\Http\Controllers\HouseController::class, 'index'])->name('houses.index');
// Route::get('/houses/create', [App\Http\Controllers\HouseController::class, 'create'])->name('houses.create');
// Route::post('/houses/create', [App\Http\Controllers\HouseController::class, 'store'])->name('houses.store');
// Route::get('/houses/{house}/edit', [App\Http\Controllers\HouseController::class, 'edit'])->name('houses.edit');
// Route::patch('/houses/{house}/update', [App\Http\Controllers\HouseController::class, 'update'])->name('houses.update');
// Route::delete('/houses/{house}/destroy', [App\Http\Controllers\HouseController::class, 'destroy'])->name('houses.destroy');
