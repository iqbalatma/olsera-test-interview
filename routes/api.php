<?php

use App\Http\Controllers\API\ItemController;
use App\Http\Controllers\Api\ItemPajakController;
use App\Http\Controllers\API\PajakController;
use App\Models\ItemPajak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::controller(PajakController::class)
    ->name('pajaks.')
    ->group(function () {
        Route::post('/pajaks', 'store')->name('create');
        Route::delete('/pajaks/{id}', 'destroy')->name('destroy');
        Route::put('/pajaks/{id}', 'update')->name('update');
    });



Route::controller(ItemController::class)
    ->name('items.')
    ->group(function () {
        Route::post('/items', 'store')->name('create');
        Route::delete('/items/{id}', 'destroy')->name('destroy');
        Route::put('/items/{id}', 'update')->name('update');
    });

Route::controller(ItemPajakController::class)
    ->name('items.')
    ->group(function () {
        Route::get('/items-pajaks', 'index')->name('index');
    });


Route::fallback(function () {
    return response()->json(['message' => 'Not Found.'], 404);
})->name('api.fallback.404');
