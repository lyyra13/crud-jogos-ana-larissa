
@extends('layouts.layout1')

@section('content')

<div class="container mt-5">

    @include('top_bar')

    <div class="mb-4">
        <a href="{{ route('jogos.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left me-1"></i> Voltar aos jogos
        </a>
    </div>

    <h1>
        <i class="fas fa-star me-2"></i>
        Avaliações
    </h1>

    <h4 class="text-muted mb-3">{{ $jogo->nome }}</h4>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $erro)
                <p class="mb-0">{{ $erro }}</p>
            @endforeach
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-body">
            <h5>
                Nota média:
                @if ($media)
                    {{ number_format($media, 1, ',', '.') }} / 5
                @else
                    Ainda sem avaliações
                @endif
            </h5>

            <p class="text-muted mb-0">
                {{ $avaliacoes->count() }}
                {{ $avaliacoes->count() == 1 ? 'avaliação cadastrada' : 'avaliações cadastradas' }}
            </p>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header bg-dark text-white">
            {{ $minhaAvaliacao ? 'Atualizar minha avaliação' : 'Deixe sua avaliação' }}
        </div>

        <div class="card-body">
            <form action="{{ route('avaliacoes.store', \App\Services\Operations::encryptId($jogo->id)) }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="nota" class="form-label">Sua nota</label>

                    <select name="nota" id="nota" class="form-select" required>
                        <option value="">Selecione uma nota</option>

                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}"
                                {{ old('nota', $minhaAvaliacao->nota ?? '') == $i ? 'selected' : '' }}>
                                {{ $i }} {{ $i == 1 ? 'estrela' : 'estrelas' }}
                            </option>
                        @endfor
                    </select>
                </div>

                <div class="mb-3">
                    <label for="comentario" class="form-label">Comentário</label>

                    <textarea
                        name="comentario"
                        id="comentario"
                        class="form-control"
                        rows="3"
                        maxlength="1000"
                        placeholder="O que você achou desse jogo?"
                    >{{ old('comentario', $minhaAvaliacao->comentario ?? '') }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i>
                    Salvar avaliação
                </button>
            </form>
        </div>
    </div>

    <h4 class="mb-3">Avaliações dos usuários</h4>

    @forelse ($avaliacoes as $avaliacao)
        <div class="card mb-3">
            <div class="card-body">
                <h6 class="mb-1">
                    {{ $avaliacao->usuario->name ?? 'Usuário' }}
                </h6>

                <p class="text-warning mb-2">
                    {{ str_repeat('★', $avaliacao->nota) }}{{ str_repeat('☆', 5 - $avaliacao->nota) }}
                    <span class="text-muted">({{ $avaliacao->nota }}/5)</span>
                </p>

                <p class="mb-1">
                    {{ $avaliacao->comentario ?: 'Nenhum comentário.' }}
                </p>

                <small class="text-muted">
                    {{ $avaliacao->created_at->format('d/m/Y') }}
                </small>
            </div>
        </div>
    @empty
        <div class="alert alert-info">
            Esse jogo ainda não recebeu avaliações.
        </div>
    @endforelse

</div>

@endsection
