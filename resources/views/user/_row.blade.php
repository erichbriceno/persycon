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
        @includeWhen($user->trashed(), 'user._actionsTrash')
        @includeUnless($user->trashed(), 'user._actionsList')
    </td>
</tr>