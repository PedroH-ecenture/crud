<div>
    <!-- An unexamined life is not worth living. - Socrates -->
</div>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Lista de Usuários</h1>

    ID: {{ $usuario->id }} <br><br>
    Nome: {{ $usuario->name }} <br><br>
    E-mail: {{ $usuario->email }} <br><br>
    Cadastrado: {{ \Carbon\Carbon::parse($usuario->created_at)->format('d/m/Y H:i') }} <br><br>
    Editado: {{ \Carbon\Carbon::parse($usuario->updated_at)->format('d/m/Y H:i') }} <br><br>
    <form method="POST" action="{{ route('usuarios.destroy', ['usuario' => $usuario->id]) }}">
        @csrf
        @method('DELETE')
        <button type="submit">Deletar Usuário</button>
    </form>
    <hr>

    <a href="{{ route('usuarios.index') }}">Voltar a página inicial</a>



</body>

</html>