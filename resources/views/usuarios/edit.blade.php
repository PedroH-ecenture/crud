<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
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
            padding: 2rem;
        }

        h1 {
            margin-bottom: 1.5rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #333;
            border-radius: 4px;
            background: #1e1e1e;
            color: #fff;
        }

        input::placeholder {
            color: #888;
        }

        .btn {
            background: #333;
            color: #fff;
            border: 1px solid #444;
            padding: 0.35rem 0.9rem;
            font-size: 0.9rem;
            text-decoration: none;
            display: inline-block;
            width: auto;
        }

        .btn:hover {
            background: #444;
            color: #fff;
            text-decoration: none;
        }

        .alert-danger {
            background: #5a1e1e;
            border-color: #7a2a2a;
            color: #fff;
            padding: 0.75rem 1rem;
            margin-bottom: 1rem;
        }

        a.back-link {
            display: inline-block;
            margin-bottom: 1rem;
            color: #aaa;
            text-decoration: none;
        }

        a.back-link:hover {
            color: #fff;
        }
    </style>
</head>

<body>
    <h1>Editar Usuário</h1>

    <a href="{{ route('usuarios.index') }}" class="back-link">Voltar à página inicial</a>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('usuarios.update', ['usuario' => $usuario->id]) }}" method="PUT">
        @csrf
        <div class="form-group">
            <label for="name">Nome:</label>
            <input type="text" id="name" name="name" value="{{ old('name', $usuario->name) }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email', $usuario->email) }}" required>
        </div>

        <div class="form-group">
            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" value="{{ old('password', $usuario->password) }}" required>
        </div>


        <div class="form-group">
            <label for="password_confirmation">Confirme a senha:</label>
            <input type="password" name="password_confirmation" value="{{ old('password', $usuario->password) }}" required>
        </div>

        <button type="submit" class="btn">Atualizar Usuário</button>
    </form>
</body>

</html>