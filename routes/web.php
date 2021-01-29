<?php

use App\Http\Controllers\ApiBooksController;
use App\Http\Controllers\BooksController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function (){
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::post('/api/books', ApiBooksController::class)->name('api.books.fetch');

    Route::post('/books', [BooksController::class, 'store'])->name('books.store');

    Route::get('/books', [BooksController::class, 'index'])->name('books.index');

    Route::get('/books/{book}', [BooksController::class, 'show'])->name('books.show');
});


require __DIR__.'/auth.php';
