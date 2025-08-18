<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Editar Role</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Editar Role: {{ $role->name }}</h1>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('roles.updateroles', $role->id) }}" method="PUT">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nome da Role</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $role->name) }}" required>
            </div>

            <!-- Permissões de Usuários -->
            <div class="mb-3">
                <label class="form-label">Permissões de Usuários</label>
                <div class="row">
                    @php
                    $userPermissions = [
                    'usuarios.ver' => 'Ver',
                    'usuarios.criar' => 'Criar',
                    'usuarios.editar' => 'Editar',
                    'usuarios.deletar' => 'Deletar'
                    ];
                    @endphp

                    @foreach($userPermissions as $perm => $label)
                    <div class="col-md-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $perm }}" id="perm_{{ $perm }}"
                                {{ $role->hasPermissionTo($perm) ? 'checked' : '' }}>
                            <label class="form-check-label" for="perm_{{ $perm }}">
                                {{ $label }}
                            </label>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Permissões de Grupos (Exemplo) -->
            <div class="mb-3">
                <label class="form-label">Permissões de Grupos</label>
                <div class="row">
                    @php
                    $groupPermissions = [
                    'grupos.ver' => 'Ver Grupos',
                    'grupos.criar' => 'Criar Grupos',
                    'grupos.editar' => 'Editar Grupos',
                    'grupos.deletar' => 'Deletar Grupos'
                    ];
                    @endphp

                    @foreach($groupPermissions as $perm => $label)
                    <div class="col-md-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $perm }}" id="perm_{{ $perm }}"
                                {{ $role->hasPermissionTo($perm) ? 'checked' : '' }}>
                            <label class="form-check-label" for="perm_{{ $perm }}">
                                {{ $label }}
                            </label>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Atualizar Role</button>
            <a href="{{ route('viewrole') }}" class="btn btn-secondary">Voltar</a>
        </form>
    </div>
</body>

</html>