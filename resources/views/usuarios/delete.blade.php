<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Lista de Usuários</h1>
    <a href="{{ route('usuarios.index') }}">Voltar a página inicial</a><br><br>

    @if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </div>
    @endif

    <form action="{{ route('usuarios.update', ['usuario' => $usuario->id]) }}" method="DELETE">
        @csrf
        <label for="name">Nome:</label>
        <input type="text" id="name" name="name" value="{{ old('name', $usuario->name) }}" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ old('email', $usuario->email) }}" required>

        <label for="password">Senha:</label>
        <input type="password" id="password" name="password" value="{{ old('password', $usuario->password) }}" required>

        <button type="submit">Deletar Usuário</button>
</body>

</html>