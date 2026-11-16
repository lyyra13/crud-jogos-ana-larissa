
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Desenvolvedoras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        @include('top_bar')
        <h2>Desenvolvedoras</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <a href="{{ route('desenvolvedoras.create') }}" class="btn btn-primary mb-3">Cadastrar desenvolvedora</a>

        <table class="table table-bordered table-striped bg-white">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>País</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($desenvolvedoras as $desenvolvedora)
                    <tr>
                        <td>{{ $desenvolvedora->nome }}</td>
                        <td>{{ $desenvolvedora->pais }}</td>
                        <td>{{ $desenvolvedora->descricao }}</td>
                        <td>
                            <a href="{{ route('desenvolvedoras.edit', $desenvolvedora->id) }}" class="btn btn-warning btn-sm">Editar</a>

                            <form action="{{ route('desenvolvedoras.destroy', $desenvolvedora->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Deseja excluir?')">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Nenhuma desenvolvedora cadastrada.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $desenvolvedoras->links('vendor.pagination.custom') }}
    </div>
</body>
</html>
