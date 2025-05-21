<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');

    Route::prefix('c')->group(function () {
        Route::resource('contacts', ContactController::class);
        Route::get('contacts-deleted', [ContactController::class, 'trashed'])->name('contacts.trashed');
        Route::post('contacts/{id}/restore', [ContactController::class, 'restore'])->name('contacts.restore');
        Route::delete('contacts/{id}/force-delete', [ContactController::class, 'forceDelete'])->name('contacts.forceDelete');
    });
});
