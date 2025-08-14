<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #121212;
            color: #fff;
            padding: 2rem;
            min-height: 100vh;
        }

        h1 {
            margin-bottom: 1.5rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-control {
            background: #1e1e1e;
            border: 1px solid #333;
            color: #fff;
        }

        .form-control::placeholder {
            color: #888;
        }

        .btn {
            background: #333;
            color: #fff;
            border: 1px solid #444;
            padding: 0.35rem 0.9rem;
            font-size: 0.9rem;
        }

        .btn:hover {
            background: #444;
        }

        .alert-danger {
            background: #5a1e1e;
            border-color: #7a2a2a;
            color: #fff;
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

        /* Ícone olho proporcional ao input */
        .input-group-text {
            background: #1e1e1e;
            border: 1px solid #333;
            border-left: none;
            cursor: pointer;
            color: #888;
        }

        .input-group-text:hover {
            color: #fff;
        }
    </style>
</head>

<body>
    <h1>Editar Usuário</h1>

    <a href="{{ route('usuarios.index') }}" class="btn mb-3">Voltar à página inicial</a>

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
            <input type="text" id="name" name="name" value="{{ old('name', $usuario->name) }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email', $usuario->email) }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="password">Senha:</label>
            <div class="input-group">
                <input type="password" id="password" name="password" value="{{ old('password', $usuario->password) }}" class="form-control" required>
                <span class="input-group-text" onclick="togglePassword('password', this)">
                    <i class="bi bi-eye"></i>
                </span>
            </div>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirme a senha:</label>
            <div class="input-group">
                <input type="password" id="password_confirmation" name="password_confirmation" value="{{ old('password', $usuario->password) }}" class="form-control" required>
                <span class="input-group-text" onclick="togglePassword('password_confirmation', this)">
                    <i class="bi bi-eye"></i>
                </span>
            </div>
        </div>

        <button type="submit" class="btn">Atualizar Usuário</button>
    </form>

    <script>
        function togglePassword(fieldId, el) {
            const field = document.getElementById(fieldId);
            const icon = el.querySelector('i');
            if (field.type === "password") {
                field.type = "text";
                icon.classList.replace("bi-eye", "bi-eye-slash");
            } else {
                field.type = "password";
                icon.classList.replace("bi-eye-slash", "bi-eye");
            }
        }
    </script>

</body>

</html>