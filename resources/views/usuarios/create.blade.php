<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            background: #121212;
            color: #fff;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            flex: 1;
            padding: 2rem 1rem;
        }

        .form-control {
            background: #1e1e1e;
            border: 1px solid #333;
            color: #fff;
            /* cor do texto digitado */
            margin-bottom: 1rem;
        }

        .form-control::placeholder {
            color: #aaa;
            /* cor do placeholder, clara mas não vibrante */
        }

        .form-control:focus {
            background: #1e1e1e;
            border-color: #555;
            color: #fff;
            box-shadow: none;
        }


        .btn {
            background: #333;
            color: #fff;
            border: 1px solid #444;
            width: auto;
        }

        .btn:hover {
            background: #444;
        }

        .alert-danger {
            background: #a22;
            border-color: #a22;
            color: #fff;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>
    @include('layouts.header')

    <main class="container">
        <h1 class="mb-4">Criar Novo Usuário</h1>
        <a href="{{ route('usuarios.index') }}" class="btn btn-sm mb-4">Voltar à Página Inicial</a>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('usuarios.store') }}" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Digite o nome" class="form-control" required>
            <input type="email" name="email" placeholder="Digite o e-mail" class="form-control" required>
            <input type="password" name="password" placeholder="Digite a senha" class="form-control" required>

            <button type="submit" class="btn">Criar Usuário</button>
        </form>

    </main>

    @include('layouts.footer')
</body>

</html>