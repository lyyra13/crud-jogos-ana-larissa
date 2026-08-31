<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Jogos</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

</head>

<body class="bg-light">

    <div class="container">

        <div class="row justify-content-center align-items-center min-vh-100">

            <div class="col-md-6 col-lg-4">

                <div class="card shadow border-0 rounded-4">

                    <div class="card-body p-5">

                        <div class="text-center mb-4">

                            <div class="mb-3">
                                <span style="font-size: 50px;">🎮</span>
                            </div>

                            <h1 class="fw-bold">
                                Jogos
                            </h1>

                            <p class="text-muted">
                                Entre na sua conta
                            </p>

                        </div>

                        @if ($errors->any())

                            <div class="alert alert-danger">
                                {{ $errors->first() }}
                            </div>

                        @endif

                        <form
                            action="{{ route('login.authenticate') }}"
                            method="POST"
                        >

                            @csrf

                            <div class="mb-3">

                                <label
                                    for="email"
                                    class="form-label"
                                >
                                    E-mail
                                </label>

                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    class="form-control"
                                    value="{{ old('email') }}"
                                    placeholder="Digite seu e-mail"
                                    required
                                >

                            </div>

                            <div class="mb-4">

                                <label
                                    for="password"
                                    class="form-label"
                                >
                                    Senha
                                </label>

                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    class="form-control"
                                    placeholder="Digite sua senha"
                                    required
                                >

                            </div>

                            <div class="d-grid">

                                <button
                                    type="submit"
                                    class="btn btn-primary btn-lg rounded-3"
                                >
                                    Entrar
                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>

</body>

</html>