<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\JogoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DesenvolvedoraController;
use App\Http\Controllers\PlataformaController;
use App\Http\Controllers\AvaliacaoController;

Route::get('/', [JogoController::class, 'index'])->name('home');

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

    Route::get('/jogos/{jogo}/edit', [JogoController::class, 'edit'])->name('jogos.edit');

    Route::put('/jogos/{jogo}', [JogoController::class, 'update'])->name('jogos.update');

    Route::delete('/jogos/{jogo}', [JogoController::class, 'destroy'])->name('jogos.destroy');

    // DESENVOLVEDORAS
Route::get('/desenvolvedoras', [DesenvolvedoraController::class, 'index'])->name('desenvolvedoras.index');
Route::get('/desenvolvedoras/create', [DesenvolvedoraController::class, 'create'])->name('desenvolvedoras.create');
Route::post('/desenvolvedoras', [DesenvolvedoraController::class, 'store'])->name('desenvolvedoras.store');
Route::get('/desenvolvedoras/{id}/edit', [DesenvolvedoraController::class, 'edit'])->name('desenvolvedoras.edit');
Route::put('/desenvolvedoras/{id}', [DesenvolvedoraController::class, 'update'])->name('desenvolvedoras.update');
Route::delete('/desenvolvedoras/{id}', [DesenvolvedoraController::class, 'destroy'])->name('desenvolvedoras.destroy');

// PLATAFORMAS
Route::get('/plataformas', [PlataformaController::class, 'index'])->name('plataformas.index');
Route::get('/plataformas/create', [PlataformaController::class, 'create'])->name('plataformas.create');
Route::post('/plataformas', [PlataformaController::class, 'store'])->name('plataformas.store');
Route::get('/plataformas/{id}/edit', [PlataformaController::class, 'edit'])->name('plataformas.edit');
Route::put('/plataformas/{id}', [PlataformaController::class, 'update'])->name('plataformas.update');
Route::delete('/plataformas/{id}', [PlataformaController::class, 'destroy'])->name('plataformas.destroy');


// AVALIAÇÕES

Route::get('/jogos/{id}/avaliacoes', [AvaliacaoController::class, 'index'])
    ->name('jogos.avaliacoes');

Route::post('/jogos/{id}/avaliacoes', [AvaliacaoController::class, 'store'])
    ->name('avaliacoes.store');
    
});