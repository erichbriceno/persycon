<tr>
    <td>{{ $title->name }}
        @if(! $title->active)
        <span class="note-danger">
            <i class="fas fa-lock"></i>
        </span>
        @endif
    </td>
    <td>{{ $title->description }}</td>
    <td class="text-center">
        {{ $title->management->acronym }}
    </td>
    <td class="text-center">
        T1
    </td>
    <td class="text-center">
        {{ $title->salaryType->name }}
    </td>
    <td class="text-center">
        34.4
    </td>
    <td class="form-inline justify-content-center">
        @includeWhen($title->trashed(), 'title._actionsTrash')
        @includeUnless($title->trashed(), 'title._actionsList')
    </td>
</tr>