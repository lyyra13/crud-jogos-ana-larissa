@extends('layouts.layout1')

@section('content')

<div class="container mt-5">

    <div class="row justify-content-center">
        <div class="col">

            @include('top_bar')

            <form action="{{ route('jogos.store') }}" method="POST">

                @csrf

                <div class="mb-3 mt-3">
                    <label for="nome" class="form-label">Nome do jogo</label>
                    <input type="text" name="nome" id="nome" class="form-control bg-primary text-white" value="{{ old('nome') }}">

                    @error('nome')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="desenvolvedora" class="form-label">Desenvolvedora</label>
                    <input type="text" name="desenvolvedora" id="desenvolvedora" class="form-control bg-primary text-white" value="{{ old('desenvolvedora') }}">

                    @error('desenvolvedora')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="plataforma" class="form-label">Platforma</label>

                    <input type="text" name="plataforma" id="plataforma" class="form-control bg-primary text-white" value="{{ old('plataforma') }}">

                    @error('plataforma')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="data_lancamento" class="form-label">Data lançamento</label>

                    <input type="date" name="data_lancamento" id="data_lancamento" class="form-control bg-primary text-white" value="{{ old('data_lancamento') }}">

                    @error('data_lancamento')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="preco" class="form-label">Preço</label>

                    <input type="number" name="preco" id="preco" class="form-control bg-primary text-white" step="0.01" min="0" value="{{ old('preco') }}">

                    @error('preco')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="categoria_id" class="form-label">
                        Category
                    </label>

                    <select
                        name="categoria_id"
                        id="categoria_id"
                        class="form-select bg-primary text-white"
                    >
                        <option value="">Select a category</option>

                        @foreach($categorias as $categoria)

                            <option
                                value="{{ $categoria->id }}"
                                {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}
                            >
                                {{ $categoria->nome }}
                            </option>

                        @endforeach

                    </select>

                    @error('categoria_id')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="row mt-3">
                    <div class="col text-end">

                        <a
                            href="{{ route('jogos.index') }}"
                            class="btn btn-primary px-5"
                        >
                            <i class="fa-solid fa-ban me-2"></i>
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="btn btn-secondary px-5"
                        >
                            <i class="fa-regular fa-circle-check me-2"></i>
                            Save
                        </button>

                    </div>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection