<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ParcelsController;
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
Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('parcels')->group(function () {
        Route::get('/', [ParcelsController::class, 'index'])->name('parcels.index');
        Route::get('/{id}', [ParcelsController::class, 'edit'])->name('parcels.edit');
        Route::put('/update', [ParcelsController::class, 'update'])->name('parcels.update');
        Route::post('/create', [ParcelsController::class, 'create'])->name('parcels.create');
    });
});
