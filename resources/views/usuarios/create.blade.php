<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

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
            margin-bottom: 1rem;
        }

        .form-control::placeholder {
            color: #aaa;
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

        /* --- Ajuste do "olho" de senha: tamanho e alinhamento --- */
        .input-group .form-control {
            height: calc(2.5rem + 2px) !important;
            /* iguala altura dos dois lados */
            line-height: 1.25 !important;
        }

        .input-group .input-group-text {
            height: calc(2.5rem + 2px) !important;
            /* mesma altura do input */
            padding: 0.375rem 0.6rem !important;
            /* reduz a “caixa” do olho */
            font-size: .875rem !important;
            /* deixa a caixa mais “miúda” */
            display: flex !important;
            /* centraliza verticalmente o ícone */
            align-items: center !important;
            background: #1e1e1e !important;
            /* combina com teu tema escuro */
            border: 1px solid #333 !important;
            color: #aaa !important;
        }

        .input-group .input-group-text i {
            font-size: 1rem !important;
            /* tamanho do ícone */
            line-height: 1 !important;
        }
    </style>
</head>

<body>


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

            <div class="input-group">
                <input type="password" name="password" placeholder="Digite a senha" id="password" class="form-control" required>
                <span class="input-group-text" role="button" onclick="togglePassword('password', this)">
                    <i class="bi bi-eye"></i>
                </span>
            </div>

            <div class="input-group">
                <input type="password" name="password_confirmation" placeholder="Confirme a senha" id="password_confirmation" class="form-control" required>
                <span class="input-group-text" role="button" onclick="togglePassword('password_confirmation', this)">
                    <i class="bi bi-eye"></i>
                </span>
            </div>

            <button type="submit" class="btn">Criar Usuário</button>
        </form>
    </main>

    <script>
        function togglePassword(fieldId, toggleIcon) {
            const field = document.getElementById(fieldId);
            if (!field) return;
            const icon = toggleIcon.querySelector('i');

            const isPwd = field.type === 'password';
            field.type = isPwd ? 'text' : 'password';

            icon.classList.toggle('bi-eye', !isPwd);
            icon.classList.toggle('bi-eye-slash', isPwd);
        }
    </script>


</body>

</html>