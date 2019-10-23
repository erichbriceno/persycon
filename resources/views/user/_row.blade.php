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
    <td class="text-right">
        <form method="POST" action="{{ route('user.destory', $user) }}">
            @csrf
            @method('DELETE')
            <a href="{{ route('user.details', $user ) }}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-eye"></i></a>
            <a href="{{ route('user.edit', $user ) }}"    class="btn btn-outline-secondary btn-sm"><i class="fas fa-pencil-alt"></i></a>
            <button type="submit" class="btn btn-outline-secondary btn-sm"><i class="fas fa-trash-alt"></i></button>
        </form>
    </td>
</tr>