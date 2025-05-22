<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PDFController;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactsPDFMail;

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
        // CRUD
        Route::resource('contacts', ContactController::class);

        // Soft delete
        Route::get('contacts-deleted', [ContactController::class, 'trashed'])->name('contacts.trashed');
        Route::post('contacts/{id}/restore', [ContactController::class, 'restore'])->name('contacts.restore');
        Route::delete('contacts/{id}/force-delete', [ContactController::class, 'forceDelete'])->name('contacts.forceDelete');

        // Email (vienam kontaktui)
        Route::post('contacts/{contact}/send-email', [ContactController::class, 'sendEmail'])->name('contacts.sendEmail');
    });

    // PDF WEB
    Route::get('/generate-pdf', [PDFController::class, 'generatePDF'])->name('pdf.generate');

    // SEND PDF
    Route::get('/send-pdf', function () {
        Mail::to('test@example.com')->send(new ContactsPDFMail());
        return redirect()->route('contacts.index')->with('success', 'PDF su kontaktų sąrašu išsiųstas el. paštu!');
    })->name('pdf.send');
});
