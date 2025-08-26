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

        .alert-error {
            background: rgba(221, 34, 34, 1);
            border-color: rgba(221, 34, 34, 1);
            color: #000000ff;
        }
    </style>
</head>

<body>
    @include('layouts.header')

    <main class="container py-5">
        <h1 class="mb-4">Home</h1>

        {{-- Botão Criar Usuário --}}
        @can('usuarios.criar')
        <a href="{{ route('usuarios.create') }}" class="btn btn-sm mb-4">Criar Novo Usuário</a>
        @endcan

        @auth
        @php
        $user = auth()->user();
        $roles = Spatie\Permission\Models\Role::all(); // pega todas as roles
        @endphp

        @if($user->can('grupos.ver'))
        <div class="d-flex align-items-center mb-4">
            <a href="{{ route('viewrole') }}" class="btn btn-sm me-3">Ver roles existentes</a>

            @if($user->can('grupos.criar'))
            <a href="{{ route('roles.createrole') }}" class="btn btn-sm me-3">Criar role</a>
            @endif
        </div>
        @endif
        @endauth

        <form method="GET" action="{{ route('usuarios.index') }}">
            <select name="role_filter" class="form-select form-select-sm d-inline-block"
                style="width:auto; display:inline; background-color:#000; color:#fff; border-color:#444;">
                <option value="">Filtrar por Role</option>
                @foreach($roles as $role)
                <option value="{{ $role->name }}" {{ request('role_filter') == $role->name ? 'selected' : '' }}>
                    {{ $role->name }}
                </option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-sm btn-secondary">Filtrar</button><br><br>
        </form>

        {{-- Mensagens de sucesso/erro --}}
        @if(session('success'))
        <div class="alert alert-success" id="success-alert">{{ session('success') }}</div>
        <script>
            setTimeout(() => {
                const alert = document.getElementById('success-alert');
                if (alert) {
                    alert.style.transition = 'opacity 0.5s';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                }
            }, 3000);
        </script>
        @endif

        @if(session('error'))
        <div class="alert alert-error" id="error-alert">{{ session('error') }}</div>
        <script>
            setTimeout(() => {
                const alert = document.getElementById('error-alert');
                if (alert) {
                    alert.style.transition = 'opacity 0.5s';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                }
            }, 3000);
        </script>
        @endif

        {{-- Lista de usuários --}}
        @forelse($usuarios as $usuario)
        <div class="card mb-3 p-3">
            <h5 class="text-white">ID: {{ $usuario->id }} - {{ $usuario->name }}</h5>
            <p class="text-white">E-mail: {{ $usuario->email }}</p>

            @if ($usuario->id !== 1)
            <div>
                {{-- Botão Ver --}}
                @can('usuarios.ver')
                <a href="{{ route('usuarios.show',['usuario'=>$usuario->id]) }}" class="btn btn-sm">Ver</a>
                @endcan

                {{-- Botão Editar --}}
                @can('usuarios.editar')
                <a href="{{ route('usuarios.edit',['usuario'=>$usuario->id]) }}" class="btn btn-sm">Editar</a>
                @endcan

                {{-- Botão Deletar (opcional) --}}
                @can('usuarios.deletar')
                <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Deletar</button>
                </form>
                @endcan
            </div>
            @endif
        </div>
        @empty
        <p class="text-white">Nenhum usuário encontrado.</p>
        @endforelse
    </main>


    @include('layouts.footer')
</body>

</html>