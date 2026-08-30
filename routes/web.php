<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/categorias', [CategoriaController::class, 'index'])
    ->name('categorias.index');

Route::get('/categorias/create', [CategoriaController::class, 'create'])
    ->name('categorias.create');

Route::post('/categorias', [CategoriaController::class, 'store'])
    ->name('categorias.store');

Route::get('/categorias/{id}/edit', [CategoriaController::class, 'edit'])
    ->name('categorias.edit');

Route::put('/categorias/{id}', [CategoriaController::class, 'update'])
    ->name('categorias.update');

Route::delete('/categorias/{id}', [CategoriaController::class, 'destroy'])
    ->name('categorias.destroy');