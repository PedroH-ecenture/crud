<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial</title>
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
        }

        .card {
            background: #1e1e1e;
            border: 1px solid #333;
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

        .alert-success {
            background: #2d2;
            border-color: #2d2;
            color: #fff;
        }
    </style>
</head>

<body>
    @include('layouts.header')

    <main class="container py-5">
        <h1 class="mb-4">Página Inicial</h1>
        <a href="{{ route('usuarios.create') }}" class="btn btn-sm mb-4">Criar Novo Usuário</a>

        @if(session('success'))
        <div class="alert alert-success" id="success-alert">
            {{ session('success') }}
        </div>
        <script>
            setTimeout(() => {
                const alert = document.getElementById('success-alert');
                if (alert) {
                    alert.style.transition = 'opacity 0.5s';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                }
            }, 3000); // desaparece após 3 segundos
        </script>
        @endif

        @forelse($usuarios as $usuario)
        <div class="card mb-3 p-3">
            <h5 class="text-white">ID: {{ $usuario->id }} - {{ $usuario->name }}</h5>
            <p class="text-white">E-mail: {{ $usuario->email }}</p>
            <div>
                <a href="{{ route('usuarios.show',['usuario'=>$usuario->id]) }}" class="btn btn-sm me-2">Ver</a>
                <a href="{{ route('usuarios.edit',['usuario'=>$usuario->id]) }}" class="btn btn-sm">Editar</a>
            </div>
        </div>
        @empty
        <p class="text-muted">Nenhum usuário encontrado.</p>
        @endforelse
    </main>

    @include('layouts.footer')
</body>

</html>