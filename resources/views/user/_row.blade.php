<tr>
    <td>{{ $user->id }}</td>
    <td>
        {{ $user->name }}
        <span class="note">Nombre de Empresa</span>
    </td>
    <td>{{ $user->email }}</td>
    <td>{{ $user->role->description }}</td>
    <td>
        <span class="note">Registro: {{ $user->created_at->format('d/m/Y') }}</span>
        <span class="note">Último login: {{ $user->created_at->format('d/m/Y') }}</span>
    </td>
    <td class="form-inline justify-content-end">
        @if ($user->trashed())
            <form method="POST" action="{{ route('user.restore', $user) }}">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-outline-secondary btn-sm"><i class="fas fa-trash-restore"></i></button>
            </form>
            &nbsp;
            <form method="POST" action="{{ route('user.destory', $user) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-secondary btn-sm"><i class="fas fa-times-circle"></i></button>
            </form>
        @else
            <form method="POST" action="{{ route('user.trash', $user) }}">
                @csrf
                @method('PATCH')
                <a href="{{ route('user.details', $user ) }}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-eye"></i></a>
                <a href="{{ route('user.edit', $user ) }}"    class="btn btn-outline-secondary btn-sm"><i class="fas fa-pencil-alt"></i></a>
                <button type="submit" class="btn btn-outline-secondary btn-sm"><i class="fas fa-trash-alt"></i></button>
            </form>
        @endif
    </td>
</tr>