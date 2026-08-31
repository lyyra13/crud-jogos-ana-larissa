@extends('layouts.layout1')

@section('content')

<div class="container mt-5">

    @include('top_bar')

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1>
                <i class="fas fa-gamepad me-2"></i>
                Jogos
            </h1>

            <p class="text-muted mb-0">
                Gerencie os jogos cadastrados no sistema.
            </p>
        </div>

        <a
            href="{{ route('jogos.create') }}"
            class="btn btn-primary"
        >
            <i class="fas fa-plus me-2"></i>
            Novo Jogo
        </a>

    </div>


    @if (session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif


    @if (session('error'))

        <div class="alert alert-danger">
            {{ session('error') }}
        </div>

    @endif


    @if ($jogos->count() > 0)

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

                    @foreach ($jogos as $jogo)

                        <tr>

                            <td>
                                <strong>{{ $jogo->nome }}</strong>
                            </td>

                            <td>
                                {{ $jogo->desenvolvedora }}
                            </td>

                            <td>
                                {{ $jogo->plataforma }}
                            </td>

                            <td>
                                {{ date('d/m/Y', strtotime($jogo->data_lancamento)) }}
                            </td>

                            <td>
                                R$ {{ number_format($jogo->preco, 2, ',', '.') }}
                            </td>

                            <td>
                                {{ $jogo->categoria->nome ?? 'Sem categoria' }}
                            </td>

                            <td>

                                <a
                                    href="{{ route('jogos.edit', $jogo->encrypted_id) }}"
                                    class="btn btn-warning btn-sm"
                                >
                                    <i class="fas fa-edit"></i>
                                </a>


                                <form
                                    action="{{ route('jogos.destroy', $jogo->encrypted_id) }}"
                                    method="POST"
                                    class="d-inline"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Deseja realmente excluir este jogo?')"
                                    >
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

        <div class="alert alert-info text-center">

            <i class="fas fa-info-circle me-2"></i>

            Nenhum jogo cadastrado.

        </div>

    @endif

</div>

@endsection