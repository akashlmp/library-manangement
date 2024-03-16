<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\Library\LibraryController;
use App\Http\Controllers\Library\SellerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/



Route::get("/", function (Request $request) {
    // dd();
    return view('welcome');
});

Route::group(['prefix' => 'library', 'as' => 'library.'], function () {

    Route::group(['middleware' => ['role:user']], function () {
        Route::get('/', [LibraryController::class, 'index'])->name('index');
    });

    Route::group(['prefix' => 'seller', 'as' => 'seller.', 'middleware' => [
        'auth:sanctum',
        config('jetstream.auth_session'),
        'verified', 'role:seller'
    ]], function () {
        Route::get('/', [SellerController::class, 'index'])->name('index');
        Route::post('/', [SellerController::class, 'create'])->name('store');
    });
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('welcome');
    })->name('dashboard');
});
