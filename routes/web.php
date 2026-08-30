<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\JogoController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});


// AUTENTICAÇÃO

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.authenticate');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ROTAS PROTEGIDAS

Route::middleware('auth')->group(function () {

    // CATEGORIAS

    Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');

    Route::get('/categorias/create', [CategoriaController::class, 'create'])->name('categorias.create');

    Route::post('/categorias', [CategoriaController::class, 'store'])->name('categorias.store');

    Route::get('/categorias/{id}/edit', [CategoriaController::class, 'edit'])->name('categorias.edit');

    Route::put('/categorias/{id}', [CategoriaController::class, 'update'])->name('categorias.update');

    Route::delete('/categorias/{id}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');


    // JOGOS

    Route::get('/jogos', [JogoController::class, 'index'])->name('jogos.index');

    Route::get('/jogos/create', [JogoController::class, 'create'])->name('jogos.create');

    Route::post('/jogos', [JogoController::class, 'store'])->name('jogos.store');

    Route::get('/jogos/{jogo}', [JogoController::class, 'show'])->name('jogos.show');

    Route::get('/jogos/{jogo}/edit', [JogoController::class, 'edit'])->name('jogos.edit');

    Route::put('/jogos/{jogo}', [JogoController::class, 'update'])->name('jogos.update');

    Route::delete('/jogos/{jogo}', [JogoController::class, 'destroy'])->name('jogos.destroy');

});