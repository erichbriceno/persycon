<tr>
    <td>{{ $user->cedule }}</td>
    <td>
        {{ $user->name }}
        <span class="note">@lang($user->role->name)

            @if($user->active)
                <i class="fas fa-user-check"></i>
            @else
                <i class="fas fa-user-lock"></i>
            @endif
        </span>
    </td>
    <td><span class="note-plus">{{ $user->email }}</span></td>
    <td><span class="note-plus">@lang($user->management->name)</span></td>
    <td>
        <span class="note">Registro: {{ $user->created_at->format('d/m/Y') }}</span>
        <span class="note">Último login: {{ optional($user->last_login_at)->format('d/m/Y h:ia') ?: 'N/A' }}</span>
    </td>
    <td class="form-inline justify-content-end">
        @if ($user->trashed())
            <form method="POST" action="{{ route('user.restore', $user) }}">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-outline-secondary btn-sm"><i class="fas fa-trash-restore"></i></button>
            </form>
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