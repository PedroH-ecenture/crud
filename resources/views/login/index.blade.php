<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            background: #121212;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }

        .login-container {
            background: #1e1e1e;
            padding: 2rem;
            border-radius: 8px;
            width: 100%;
            max-width: 400px;
        }

        h1 {
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-control {
            background: #1e1e1e;
            border: 1px solid #333;
            color: #fff;
            padding: 0.5rem;
        }

        input::placeholder {
            color: #888;
        }

        .btn {
            background: #333;
            color: #fff;
            border: 1px solid #444;
            width: 100%;
            padding: 0.5rem;
        }

        .btn:hover {
            background: #444;
        }

        .alert-danger {
            background: #5a1e1e;
            border-color: #7a2a2a;
            color: #fff;
            padding: 0.75rem 1rem;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>

    <div class="login-container">
        <h1>Login</h1>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="m-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('login.proccess') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="email">Usuário:</label>
                <input type="email" name="email" placeholder="Seu e-mail" required>
            </div>

            <div class="form-group">
                <label for="password">Senha:</label>
                <div class="input-group">
                    <input type="password" id="password" name="password" class="form-control" placeholder="Digite sua senha" required>
                    <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password', this)">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn mt-3">Entrar</button>
        </form>
    </div>

    <script>
        function togglePassword(fieldId, toggleIcon) {
            const field = document.getElementById(fieldId);
            const icon = toggleIcon.querySelector('i');
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