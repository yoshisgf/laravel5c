<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;

Route::get('/', [RecipeController::class, 'index']);
Route::get('/resep/create', [RecipeController::class, 'create'])->name('resep.create');
Route::post('/resep', [RecipeController::class, 'store'])->name('resep.store');

Route::get('/resep/{recipe}/edit', [RecipeController::class, 'edit']);
Route::put('/resep/{recipe}', [RecipeController::class, 'update']);
Route::delete('/resep/{recipe}', [RecipeController::class, 'destroy']);