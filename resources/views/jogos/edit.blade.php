@extends('layouts.layout1')

@section('content')

<div class="container py-5">

    @include('top_bar')

    <div class="row justify-content-center mt-4">

        <div class="col-md-8 col-lg-7">

            <div class="card shadow-sm border-0">

                <div class="card-body p-4 p-md-5">

                    <div class="text-center mb-4">

                        <i class="fas fa-gamepad fa-3x text-primary mb-3"></i>

                        <h1 class="fw-bold">
                            Editar Jogo
                        </h1>

                        <p class="text-muted">
                            Altere os dados do jogo.
                        </p>

                    </div>


                    <form
                        action="{{ route('jogos.update', $jogo->encrypted_id) }}"
                        method="POST"
                    >

                        @csrf
                        @method('PUT')


                        <div class="mb-3">

                            <label for="nome" class="form-label fw-semibold">
                                Nome
                            </label>

                            <input
                                type="text"
                                id="nome"
                                name="nome"
                                class="form-control"
                                value="{{ old('nome', $jogo->nome) }}"
                                placeholder="Digite o nome do jogo"
                            >

                            @error('nome')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        <div class="mb-3">

                            <label for="desenvolvedora" class="form-label fw-semibold">
                                Desenvolvedora
                            </label>

                            <input
                                type="text"
                                id="desenvolvedora"
                                name="desenvolvedora"
                                class="form-control"
                                value="{{ old('desenvolvedora', $jogo->desenvolvedora) }}"
                                placeholder="Digite a desenvolvedora"
                            >

                            @error('desenvolvedora')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        <div class="mb-3">

                            <label for="plataforma" class="form-label fw-semibold">
                                Plataforma
                            </label>

                            <input
                                type="text"
                                id="plataforma"
                                name="plataforma"
                                class="form-control"
                                value="{{ old('plataforma', $jogo->plataforma) }}"
                                placeholder="Ex.: PC, PlayStation, Xbox"
                            >

                            @error('plataforma')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        <div class="mb-3">

                            <label for="data_lancamento" class="form-label fw-semibold">
                                Data de lançamento
                            </label>

                            <input
                                type="date"
                                id="data_lancamento"
                                name="data_lancamento"
                                class="form-control"
                                value="{{ old('data_lancamento', $jogo->data_lancamento) }}"
                            >

                            @error('data_lancamento')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        <div class="mb-3">

                            <label for="preco" class="form-label fw-semibold">
                                Preço
                            </label>

                            <input
                                type="number"
                                id="preco"
                                name="preco"
                                class="form-control"
                                value="{{ old('preco', $jogo->preco) }}"
                                step="0.01"
                                min="0"
                                placeholder="Digite o preço"
                            >

                            @error('preco')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        <div class="mb-4">

                            <label for="categoria_id" class="form-label fw-semibold">
                                Categoria
                            </label>

                            <select
                                id="categoria_id"
                                name="categoria_id"
                                class="form-select"
                            >

                                <option value="">
                                    Selecione uma categoria
                                </option>

                                @foreach ($categorias as $categoria)

                                    <option
                                        value="{{ $categoria->id }}"
                                        {{ old('categoria_id', $jogo->categoria_id) == $categoria->id ? 'selected' : '' }}
                                    >
                                        {{ $categoria->nome }}
                                    </option>

                                @endforeach

                            </select>

                            @error('categoria_id')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        <div class="d-flex justify-content-end gap-2">

                            <a
                                href="{{ route('jogos.index') }}"
                                class="btn btn-outline-secondary"
                            >
                                <i class="fas fa-arrow-left me-2"></i>
                                Voltar
                            </a>

                            <button
                                type="submit"
                                class="btn btn-primary"
                            >
                                <i class="fas fa-check me-2"></i>
                                Salvar alterações
                            </button>

                        </div>
                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection