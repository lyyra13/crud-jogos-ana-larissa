@extends('layouts.layout1')

@section('content')

<div class="container mt-5">

    <div class="row justify-content-center">
        <div class="col">

            @include('top_bar')

            <div class="row mb-3">
                <div class="col">
                    <p class="display-6 mb-0">Jogos</p>
                </div>

            </div>


<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Jogos</h1>

        <a href="{{ route('jogos.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Novo Jogo
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($jogos->count() > 0)

        <div class="table-responsive">
            <table class="table table-striped table-bordered align-middle">

                <thead class="table-dark">
                    <tr>
                        <th>Nome</th>
                        <th>Desenvolvedora</th>
                        <th>Plataforma</th>
                        <th>Data de lançamento</th>
                        <th>Preço</th>
                        <th>Categoria</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($jogos as $jogo)
                        <tr>

                            <td>{{ $jogo->nome }}</td>

                            <td>{{ $jogo->desenvolvedora }}</td>

                            <td>{{ $jogo->plataforma }}</td>

                            <td>
                                {{ $jogo->data_lancamento ? $jogo->data_lancamento->format('d/m/Y') : '-' }}
                            </td>

                            <td>
                                R$ {{ number_format($jogo->preco, 2, ',', '.') }}
                            </td>

                            <td>
                                {{ $jogo->categoria->nome ?? 'Sem categoria' }}
                            </td>

                            <td>
                                <a href="{{ route('jogos.show', $jogo) }}"
                                   class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <a href="{{ route('jogos.edit', $jogo) }}"
                                   class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('jogos.destroy', $jogo) }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Deseja realmente excluir este jogo?')">
                                        <i class="fas fa-trash"></i>
                                    </button>

                                </form>
                            </td>

                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

    @else

        <div class="alert alert-info">
            Nenhum jogo cadastrado.
        </div>

    @endif

</div>

@endsection
