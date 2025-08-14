<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Usuário</title>
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

        .card {
            background: #1e1e1e;
            border: 1px solid #333;
            padding: 1rem;
            margin-bottom: 1rem;
            color: #fff;
        }

        .btn {
            background: #333;
            color: #fff;
            border: 1px solid #444;
            padding: 0.35rem 0.9rem;
            font-size: 0.9rem;
            width: auto;
            /* importante */
            text-decoration: none;
            display: inline-block;
            /* importante para não esticar */
        }


        .btn:hover {
            background: #444;
            color: #fff;
            text-decoration: none;
        }

        .btn-group {
            display: flex;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .card p {
            color: #fff;
            margin-bottom: 0.5rem;
        }
    </style>
</head>

<body>
    <h1 class="mb-4 text-white">Detalhes do Usuário</h1>

    <div class="card">
        <p><strong>ID:</strong> {{ $usuario->id }}</p>
        <p><strong>Nome:</strong> {{ $usuario->name }}</p>
        <p><strong>E-mail:</strong> {{ $usuario->email }}</p>
        <p><strong>Criado:</strong> {{ $usuario->created_at ? \Carbon\Carbon::parse($usuario->created_at)->format('d/m/Y H:i') : 'Nunca' }}</p>
        <p><strong>Editado:</strong> {{ $usuario->updated_at ? \Carbon\Carbon::parse($usuario->updated_at)->format('d/m/Y H:i') : 'Nunca' }}</p>
        <div>
            <form method="POST" action="{{ route('usuarios.destroy', ['usuario' => $usuario->id]) }}" style="display:inline-block; margin:0;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn">Deletar Usuário</button>
            </form>

            <a href="{{ route('usuarios.index') }}" class="btn ms-2">Voltar à página inicial</a>
        </div>
    </div>
</body>

</html>