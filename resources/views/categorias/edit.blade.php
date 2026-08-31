@extends('layouts.layout1')

@section('content')

<div class="container py-5">

    @include('top_bar')

    <div class="row justify-content-center mt-4">

        <div class="col-md-8 col-lg-7">

            <div class="card shadow-sm border-0">

                <div class="card-body p-4 p-md-5">

                    <div class="text-center mb-4">

                        <i class="fas fa-tags fa-3x text-primary mb-3"></i>

                        <h1 class="fw-bold">
                            Editar Categoria
                        </h1>

                        <p class="text-muted">
                            Altere os dados da categoria.
                        </p>

                    </div>


                    <form action="{{ route('categorias.update', $categoria->encrypted_id) }}" method="POST">

                        @csrf
                        @method('PUT')


                        <div class="mb-3">

                            <label for="nome" class="form-label fw-semibold">
                                Nome
                            </label>

                            <input
                                type="text"
                                id="nome"
                                name="nome"
                                class="form-control"
                                value="{{ old('nome', $categoria->nome) }}"
                                placeholder="Digite o nome da categoria"
                            >

                            @error('nome')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        <div class="mb-3">

                            <label for="descricao" class="form-label fw-semibold">
                                Descrição
                            </label>

                            <textarea
                                id="descricao"
                                name="descricao"
                                class="form-control"
                                rows="4"
                                placeholder="Digite uma descrição para a categoria"
                            >{{ old('descricao', $categoria->descricao) }}</textarea>

                            @error('descricao')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        <div class="mb-3">

                            <label for="faixa_etaria" class="form-label fw-semibold">
                                Faixa etária
                            </label>

                            <input
                                type="text"
                                id="faixa_etaria"
                                name="faixa_etaria"
                                class="form-control"
                                value="{{ old('faixa_etaria', $categoria->faixa_etaria) }}"
                                placeholder="Ex.: Livre, 10+, 12+, 16+"
                            >

                            @error('faixa_etaria')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        <div class="mb-4">

                            <label for="status" class="form-label fw-semibold">
                                Status
                            </label>

                            <input
                                type="text"
                                id="status"
                                name="status"
                                class="form-control"
                                value="{{ old('status', $categoria->status) }}"
                                placeholder="Ex.: Ativo"
                            >

                            @error('status')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        <div class="d-flex justify-content-end gap-2">

                            <a
                                href="{{ route('categorias.index') }}"
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