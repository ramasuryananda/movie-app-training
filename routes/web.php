<?php

use App\Http\Controllers\ActorsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\TvController;
use Illuminate\Support\Facades\Route;



Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/movies', [MoviesController::class, 'index'])->name('movies.index');
Route::get('/movies/{id}', [MoviesController::class, 'show'])->name('movies.show');

Route::get('/tvshows', [TvController::class, 'index'])->name('tv.index');
Route::get('/tvshows/{id}', [TvController::class, 'show'])->name('tv.show');


Route::get('/actors', [ActorsController::class, 'index'])->name('actors.index');
Route::get('/actors/page/{page?}', [ActorsController::class, 'index']);
Route::get('/actors/{id}', [ActorsController::class, 'show'])->name('actors.show');
