<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/movies/filter/{genre?}', function ($genre = null) {
    if ($genre === null) {
        return redirect()->route('movies.index');
    }

    return redirect()->route('movies.index', [
        'genre' => $genre
    ]);
})->name('movies.filter');

Route::get('/movies/featured', [MovieController::class, 'featured'])
    ->name('movies.featured');

Route::resource('movies', MovieController::class);
