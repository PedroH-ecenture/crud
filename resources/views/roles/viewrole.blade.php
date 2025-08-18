<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Roles Disponíveis</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Roles Disponíveis</h1>

        @if($roles->isEmpty())
        <p>Nenhuma role cadastrada.</p>
        @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome da Role</th>
                    <th>Permissões</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $role)
                <tr>
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->name }}</td>
                    <td>
                        @php
                        // Mapas de exibição das permissões
                        $userPermissionsMap = [
                        'usuarios.ver' => 'Ver',
                        'usuarios.criar' => 'Criar',
                        'usuarios.editar' => 'Editar',
                        'usuarios.deletar' => 'Deletar'
                        ];
                        $groupPermissionsMap = [
                        'grupos.ver' => 'Ver',
                        'grupos.criar' => 'Criar',
                        'grupos.editar' => 'Editar',
                        'grupos.deletar' => 'Deletar'
                        ];

                        $userPerms = $role->permissions->whereIn('name', array_keys($userPermissionsMap));
                        $groupPerms = $role->permissions->whereIn('name', array_keys($groupPermissionsMap));
                        @endphp

                        <!-- Permissões de Usuários (em linha) -->
                        @if($userPerms->isEmpty())
                        <span class="text-muted">Nenhuma</span>
                        @else
                        @foreach($userPerms as $perm)
                        <span class="badge text-white me-1" style="background-color: #0b3d91;">{{ $userPermissionsMap[$perm->name] }}</span>
                        @endforeach
                        @endif

                        <br>

                        <!-- Permissões de Grupos (embaixo, uma por linha) -->
                        @foreach($groupPerms as $perm)
                        <span class="badge text-white me-1" style="background-color: #8b0000;">{{ $groupPermissionsMap[$perm->name] }}</span>
                        @endforeach
                    </td>
                    <td class="align-middle">
                        @php $user = auth()->user(); @endphp

                        @if($user->can('grupos.editar'))
                        <a href="{{ route('roles.editroles', $role->id) }}" class="btn btn-warning btn-sm mb-1">Editar</a>
                        @endif

                        @if($user->can('grupos.deletar'))
                        <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm mb-1"
                                onclick="return confirm('Tem certeza que deseja deletar esta role?')">
                                Deletar
                            </button>
                        </form>
                        @endif
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
        @if(auth()->user()->can('grupos.criar'))
        <a href="{{ route('roles.createrole') }}" class="btn btn-primary btn-sm mb-1">Criar Nova Role</a>
        @endif

        <a href="{{ route('usuarios.index') }}" class="btn btn-secondary btn-sm mb-1">Voltar</a>
        @endif
    </div>
</body>

</html>