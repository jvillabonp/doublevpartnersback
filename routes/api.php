<?php

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

Route::prefix('ticket')->group(function () {
    Route::get('', [App\Http\Controllers\Api\TicketController::class, 'index'])->name('ticket.index');
    Route::post('', [App\Http\Controllers\Api\TicketController::class, 'store'])->name('ticket.store');
    Route::get('{ticket}', [App\Http\Controllers\Api\TicketController::class, 'show'])->name('ticket.show');
    Route::put('{ticket}', [App\Http\Controllers\Api\TicketController::class, 'update'])->name('ticket.update');
    Route::delete('{ticket}', [App\Http\Controllers\Api\TicketController::class, 'destroy'])->name('ticket.delete');
    Route::put('restore/{ticket}', [App\Http\Controllers\Api\TicketController::class, 'restore'])->name('ticket.restore');
});

Route::prefix('users')->group(function () {
    Route::get('', [App\Http\Controllers\Api\UserController::class, 'index'])->name('users.index');
    Route::post('', [App\Http\Controllers\Api\UserController::class, 'store'])->name('users.store');
    Route::get('{user}', [App\Http\Controllers\Api\UserController::class, 'show'])->name('users.show');
});
