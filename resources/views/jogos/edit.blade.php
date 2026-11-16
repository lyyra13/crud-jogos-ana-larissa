
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
                        <h1 class="fw-bold">Editar Jogo</h1>
                        <p class="text-muted">Altere os dados do jogo.</p>
                    </div>

                    <form
                        action="{{ route('jogos.update', $jogo->encrypted_id) }}"
                        method="POST"
                    >
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nome" class="form-label fw-semibold">
                                Nome do jogo
                            </label>

                            <input
                                type="text"
                                id="nome"
                                name="nome"
                                class="form-control"
                                value="{{ old('nome', $jogo->nome) }}"
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
                                id="desenvolvedora_id"
                                name="desenvolvedora_id"
                                class="form-select"
                                required
                            >
                                <option value="">Selecione uma desenvolvedora</option>

                                @foreach($desenvolvedoras as $desenvolvedora)
                                    <option
                                        value="{{ $desenvolvedora->id }}"
                                        {{ old('desenvolvedora_id', $jogo->desenvolvedora_id) == $desenvolvedora->id ? 'selected' : '' }}
                                    >
                                        {{ $desenvolvedora->nome }}
                                    </option>
                                @endforeach
                            </select>

                            @error('desenvolvedora_id')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
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
                                            {{ in_array($plataforma->id, old('plataformas', $jogo->plataformas->pluck('id')->toArray())) ? 'checked' : '' }}
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
                                        Nenhuma plataforma cadastrada.
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
                                id="data_lancamento"
                                name="data_lancamento"
                                class="form-control"
                                value="{{ old('data_lancamento', $jogo->data_lancamento ? $jogo->data_lancamento->format('Y-m-d') : '') }}"
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
                                    id="preco"
                                    name="preco"
                                    class="form-control"
                                    value="{{ old('preco', $jogo->preco) }}"
                                    step="0.01"
                                    min="0"
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
                                id="categoria_id"
                                name="categoria_id"
                                class="form-select"
                                required
                            >
                                <option value="">Selecione uma categoria</option>

                                @foreach($categorias as $categoria)
                                    <option
                                        value="{{ $categoria->id }}"
                                        {{ old('categoria_id', $jogo->categoria_id) == $categoria->id ? 'selected' : '' }}
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
