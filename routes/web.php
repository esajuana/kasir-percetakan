<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Master\CategoryController;
use App\Http\Controllers\Master\FinishingController;
use App\Http\Controllers\Master\ProductController;
use App\Http\Controllers\Master\ProductOptionController;
use App\Http\Controllers\Master\ProductPriceController;
use App\Http\Controllers\Master\ProductVariantController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */

    Route::prefix('profile')
        ->name('profile.')
        ->group(function () {

            Route::get('/', [ProfileController::class, 'edit'])
                ->name('edit');

            Route::patch('/', [ProfileController::class, 'update'])
                ->name('update');

            Route::delete('/', [ProfileController::class, 'destroy'])
                ->name('destroy');
        });

    /*
    |--------------------------------------------------------------------------
    | Master Data
    |--------------------------------------------------------------------------
    */

    Route::prefix('master')
        ->name('master.')
        ->group(function () {

            Route::resource('categories', CategoryController::class);
            Route::resource('products', ProductController::class);
            Route::resource('product-variants', ProductVariantController::class);
            Route::resource('product-prices', ProductPriceController::class);
            Route::resource('product-options', ProductOptionController::class);
            Route::resource('finishings', FinishingController::class);


            Route::post('product-options/ajax-store',[ProductOptionController::class, 'ajaxStore'])->name('product-options.ajax-store');
        });

});

require __DIR__.'/auth.php';