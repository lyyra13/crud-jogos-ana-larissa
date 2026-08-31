<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Categoria</title>
</head>
<body>

    <h1>Editar Categoria</h1>

    <form action="{{ route('categorias.update', $categoria->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="{{ old('nome', $categoria->nome) }}">

        @error('nome')
            <p>{{ $message }}</p>
        @enderror

        <br><br>

        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao">{{ old('descricao', $categoria->descricao) }}</textarea>

        @error('descricao')
            <p>{{ $message }}</p>
        @enderror

        <br><br>

        <label for="faixa_etaria">Faixa etária:</label>
        <input type="text" id="faixa_etaria" name="faixa_etaria"
               value="{{ old('faixa_etaria', $categoria->faixa_etaria) }}">

        @error('faixa_etaria')
            <p>{{ $message }}</p>
        @enderror

        <br><br>

        <label for="status">Status:</label>
        <input type="text" id="status" name="status"
               value="{{ old('status', $categoria->status) }}">

        @error('status')
            <p>{{ $message }}</p>
        @enderror

        <br><br>

        <button type="submit">Salvar alterações</button>
    </form>

    <br>

    <a href="{{ route('categorias.index') }}">Voltar</a>

</body>
</html>