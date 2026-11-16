
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Plataformas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        @include('top_bar')
        <h2>Plataformas</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('plataformas.create') }}" class="btn btn-primary mb-3">Cadastrar plataforma</a>

        <table class="table table-bordered table-striped bg-white">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Fabricante</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($plataformas as $plataforma)
                    <tr>
                        <td>{{ $plataforma->nome }}</td>
                        <td>{{ $plataforma->fabricante }}</td>
                        <td>{{ $plataforma->descricao }}</td>
                        <td>
                            <a href="{{ route('plataformas.edit', $plataforma->id) }}" class="btn btn-warning btn-sm">Editar</a>

                            <form action="{{ route('plataformas.destroy', $plataforma->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Deseja excluir?')">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Nenhuma plataforma cadastrada.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $plataformas->links('vendor.pagination.custom') }}
    </div>
</body>
</html>
