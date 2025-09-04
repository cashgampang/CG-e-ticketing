<?php

use App\Http\Controllers\TeamController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/tickets');
});

Route::middleware('auth')->group(function () {
    Route::prefix('tickets')->name('tickets.')->group(function () {
        Route::get('/', [TicketController::class, 'index'])->name('index');
        Route::get('/create', [TicketController::class, 'create'])->name('create');
        Route::post('/', [TicketController::class, 'store'])->name('store');
        Route::get('/status/{status}', [TicketController::class, 'byStatus'])->name('byStatus');
        Route::get('/{id}', [TicketController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [TicketController::class, 'edit'])->name('edit');
        Route::put('/{id}', [TicketController::class, 'update'])->name('update');
        Route::delete('/{id}', [TicketController::class, 'destroy'])->name('destroy');
        Route::post('/{id}/assign', [TicketController::class, 'assign'])->name('assign');
    });

    Route::prefix('teams')->name('teams.')->group(function () {
        Route::get('/', [TeamController::class, 'index'])->name('index');
        Route::post('/', [TeamController::class, 'store'])->name('store');
        Route::get('/{id}/tickets', [TeamController::class, 'tickets'])->name('tickets');
    });

    // API Routes untuk AJAX calls dari Alpine.js
    Route::prefix('api')->name('api.')->group(function () {
        Route::get('/tickets', [TicketController::class, 'apiIndex'])->name('tickets.index');
        Route::get('/teams', [TeamController::class, 'apiIndex'])->name('teams.index');
        Route::post('/tickets/{id}/assign', [TicketController::class, 'apiAssign'])->name('tickets.assign');
    });
});

require __DIR__ . '/auth.php';
