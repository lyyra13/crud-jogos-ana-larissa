
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar plataforma</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    @include('top_bar')

    <div class="container mt-4">
        <h2>Editar plataforma</h2>

        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $erro)
                    <p class="mb-0">{{ $erro }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('plataformas.update', $plataforma->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nome</label>
                <input type="text" name="nome" class="form-control"
                    value="{{ old('nome', $plataforma->nome) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Fabricante</label>
                <input type="text" name="fabricante" class="form-control"
                    value="{{ old('fabricante', $plataforma->fabricante) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Descrição</label>
                <textarea name="descricao" class="form-control">{{ old('descricao', $plataforma->descricao) }}</textarea>
            </div>

            <button class="btn btn-success">Atualizar</button>
            <a href="{{ route('plataformas.index') }}" class="btn btn-secondary">Voltar</a>
        </form>
    </div>
</body>
</html>
