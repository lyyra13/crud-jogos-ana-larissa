<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorias - Jogos</title>
</head>
<body>

    <h1>Categorias de Jogos</h1>

    <a href="{{ route('categorias.create') }}">Cadastrar nova categoria</a>

    <br><br>

    @if ($categorias->count() > 0)

        <ul>
            @foreach ($categorias as $categoria)
                <li>
                    <strong>{{ $categoria->nome }}</strong>
                    - {{ $categoria->descricao }}

                    <a href="{{ route('categorias.edit', $categoria->id) }}">
                        Editar
                    </a>
            <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')

            <button type="submit">Excluir</button>
</form>
                </li>
            @endforeach
        </ul>

    @else

        <p>Nenhuma categoria cadastrada.</p>

    @endif

</body>
</html>