<?php

use App\Http\Controllers\Api\V1\CustomerController;
use App\Http\Controllers\Api\V1\InvoiceController;
use App\Http\Controllers\Api\V1\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1'], function () {
    Route::group(['middleware' => 'auth:sanctum', 'controller' => CustomerController::class], function () {
        Route::prefix('customers')->name('customers.')->group(function () {
            Route::get('/', 'list')
                ->name('list')
                ->withoutMiddleware('auth:sanctum');

            Route::get('/{id}', 'show')
                ->name('show')
                ->withoutMiddleware('auth:sanctum');

            Route::post('/', 'store')->name('store');
            Route::put('/', 'update')->name('update');
            Route::patch('/', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('destroy');
        });
    });

    Route::apiResource('invoices', InvoiceController::class);
    Route::post('invoices/bulk', [InvoiceController::class, 'bulk']);

    Route::post('auth/register', [AuthController::class, 'register'])->name('register');
    Route::post('auth/login', [AuthController::class, 'login'])->name('login');
});
