<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <h1>Página inicial</h1>
    <a href="{{ route('usuarios.create') }}">Criar Novo Usuário</a><br><br>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @forelse ($usuarios as $usuario)
    ID: {{ $usuario->id }} <br><br>
    Nome: {{ $usuario->name }} <br><br>
    E-mail: {{ $usuario->email }} <br><br>
    <a href="{{ route('usuarios.show',['usuario' => $usuario->id]) }}">Ver Usuário</a><br><br>
    <a href="{{ route('usuarios.edit',['usuario' => $usuario->id]) }}">Editar Usuário</a><br><br>

    <hr>
    @empty
    <p>Nenhum usuário encontrado.</p>
    @endforelse


</body>

</html>