@extends('layouts.layout1')

@section('content')

<div class="container mt-5">

    @include('top_bar')

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1>
                <i class="fas fa-tags me-2"></i>
                Categorias
            </h1>

            <p class="text-muted mb-0">
                Gerencie as categorias dos jogos.
            </p>
        </div>

        <a
            href="{{ route('categorias.create') }}"
            class="btn btn-primary"
        >
            <i class="fas fa-plus me-2"></i>
            Nova Categoria
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


    @if ($categorias->count() > 0)

        <div class="table-responsive">

            <table class="table table-striped table-bordered align-middle">

                <thead class="table-dark">

                    <tr>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Faixa etária</th>
                        <th>Status</th>
                        <th>Jogos</th>
                        <th>Ações</th>
                    </tr>

                </thead>

                <tbody>

                    @foreach ($categorias as $categoria)

                        <tr>

                            <td>
                                <strong>{{ $categoria->nome }}</strong>
                            </td>

                            <td>
                                {{ $categoria->descricao }}
                            </td>

                            <td>
                                {{ $categoria->faixa_etaria }}
                            </td>

                            <td>
                                {{ $categoria->status }}
                            </td>

                            <td>

                                @if ($categoria->jogos->count() > 0)

                                    @foreach ($categoria->jogos as $jogo)

                                        {{ $jogo->nome }}

                                        @if (!$loop->last)
                                            ,
                                        @endif

                                    @endforeach

                                @else

                                    Nenhum jogo

                                @endif

                            </td>

                            <td>

                                <a
                                    href="{{ route('categorias.edit', $categoria->encrypted_id) }}"
                                    class="btn btn-warning btn-sm"
                                >
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form
                                    action="{{ route('categorias.destroy', $categoria->encrypted_id) }}"
                                    method="POST"
                                    class="d-inline"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Deseja realmente excluir esta categoria?')"
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

            Nenhuma categoria cadastrada.

        </div>

    @endif

</div>

@endsection