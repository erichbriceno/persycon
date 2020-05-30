<tr>
    <td>{{ $project->namew }}
        @if(! $project->active)
        <span class="note-danger">
            <i class="fas fa-lock"></i>
        </span>
        @endif
    </td>
    <td>{{ $project->description }}</td>
    <td class="text-center">
        CNS
    </td>
    <td class="text-center">
        T1
    </td>
    <td class="text-center">
        Diario
    </td>
    <td class="text-center">
        34.4
    </td>
    <td class="form-inline justify-content-center">
        @includeWhen($project->trashed(), 'project._actionsTrash')
        @includeUnless($project->trashed(), 'project._actionsList')
    </td>
</tr>