
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar desenvolvedora</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    @include('top_bar')

    <div class="container mt-4">
        <h2>Editar desenvolvedora</h2>

        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $erro)
                    <p class="mb-0">{{ $erro }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('desenvolvedoras.update', $desenvolvedora->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nome</label>
                <input type="text" name="nome" class="form-control"
                    value="{{ old('nome', $desenvolvedora->nome) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">País</label>
                <input type="text" name="pais" class="form-control"
                    value="{{ old('pais', $desenvolvedora->pais) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Descrição</label>
                <textarea name="descricao" class="form-control">{{ old('descricao', $desenvolvedora->descricao) }}</textarea>
            </div>

            <button class="btn btn-success">Atualizar</button>
            <a href="{{ route('desenvolvedoras.index') }}" class="btn btn-secondary">Voltar</a>
        </form>
    </div>
</body>
</html>
