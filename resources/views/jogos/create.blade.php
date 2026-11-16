
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
                        <h1 class="fw-bold">Cadastrar Jogo</h1>
                        <p class="text-muted">Preencha os dados do novo jogo.</p>
                    </div>

                    <form action="{{ route('jogos.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="nome" class="form-label fw-semibold">
                                Nome do jogo
                            </label>

                            <input
                                type="text"
                                name="nome"
                                id="nome"
                                class="form-control"
                                value="{{ old('nome') }}"
                                placeholder="Digite o nome do jogo"
                                required
                            >

                            @error('nome')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="desenvolvedora_id" class="form-label fw-semibold">
                                Desenvolvedora
                            </label>

                            <select
                                name="desenvolvedora_id"
                                id="desenvolvedora_id"
                                class="form-select"
                                required
                            >
                                <option value="">Selecione uma desenvolvedora</option>

                                @foreach($desenvolvedoras as $desenvolvedora)
                                    <option
                                        value="{{ $desenvolvedora->id }}"
                                        {{ old('desenvolvedora_id') == $desenvolvedora->id ? 'selected' : '' }}
                                    >
                                        {{ $desenvolvedora->nome }}
                                    </option>
                                @endforeach
                            </select>

                            @error('desenvolvedora_id')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror

                            @if($desenvolvedoras->isEmpty())
                                <small class="text-danger">
                                    Cadastre uma desenvolvedora antes de cadastrar um jogo.
                                </small>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Plataformas disponíveis
                            </label>

                            <div class="border rounded p-3">
                                @forelse($plataformas as $plataforma)
                                    <div class="form-check mb-2">
                                        <input
                                            type="checkbox"
                                            class="form-check-input"
                                            name="plataformas[]"
                                            id="plataforma_{{ $plataforma->id }}"
                                            value="{{ $plataforma->id }}"
                                            {{ in_array($plataforma->id, old('plataformas', [])) ? 'checked' : '' }}
                                        >

                                        <label
                                            class="form-check-label"
                                            for="plataforma_{{ $plataforma->id }}"
                                        >
                                            {{ $plataforma->nome }}
                                        </label>
                                    </div>
                                @empty
                                    <p class="text-danger mb-0">
                                        Cadastre uma plataforma antes de cadastrar um jogo.
                                    </p>
                                @endforelse
                            </div>

                            @error('plataformas')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror

                            @error('plataformas.*')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="data_lancamento" class="form-label fw-semibold">
                                Data de lançamento
                            </label>

                            <input
                                type="date"
                                name="data_lancamento"
                                id="data_lancamento"
                                class="form-control"
                                value="{{ old('data_lancamento') }}"
                                required
                            >

                            @error('data_lancamento')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="preco" class="form-label fw-semibold">
                                Preço
                            </label>

                            <div class="input-group">
                                <span class="input-group-text">R$</span>

                                <input
                                    type="number"
                                    name="preco"
                                    id="preco"
                                    class="form-control"
                                    step="0.01"
                                    min="0"
                                    value="{{ old('preco') }}"
                                    placeholder="0,00"
                                    required
                                >
                            </div>

                            @error('preco')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="categoria_id" class="form-label fw-semibold">
                                Categoria
                            </label>

                            <select
                                name="categoria_id"
                                id="categoria_id"
                                class="form-select"
                                required
                            >
                                <option value="">Selecione uma categoria</option>

                                @foreach($categorias as $categoria)
                                    <option
                                        value="{{ $categoria->id }}"
                                        {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}
                                    >
                                        {{ $categoria->nome }}
                                    </option>
                                @endforeach
                            </select>

                            @error('categoria_id')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a
                                href="{{ route('jogos.index') }}"
                                class="btn btn-outline-secondary"
                            >
                                <i class="fas fa-ban me-2"></i>
                                Cancelar
                            </a>

                            <button
                                type="submit"
                                class="btn btn-primary"
                            >
                                <i class="fas fa-check me-2"></i>
                                Cadastrar jogo
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>

@endsection
