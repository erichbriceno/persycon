<tr>
    <th scope="row">{{ $project->id }}</th>
    <td>{{ $project->name }}
        @if(! $project->active)
        <span class="note-danger">
            <i class="fas fa-lock"></i>
        </span>
        @endif
    </td>
    <td>{{ $project->description }}</td>
    <td class="text-center">
        <span class="note-black">T1</span>
        <span class="note-black">10</span>
    </td>
    <td class="text-center">
        <span class="note-black">T2</span>
        <span class="note-black">30</span>
    </td>
    <td class="text-center">
        <span class="note-black">T3</span>
        <span class="note-black">100</span>
    </td>
    <td class="text-center">
        <span class="note-black">T4</span>
        <span class="note-black">1500</span>
    </td>
    <td>
        <span class="note-black">Inicio: {{ $project->start->format('d/m/Y') }}</span>
        <span class="note">Fin: {{ optional($project->ending)->format('d/m/Y') ?: '-' }}</span>
    </td>
    <td class="form-inline justify-content-center">
        @includeWhen($project->trashed(), 'project._actionsTrash')
        @includeUnless($project->trashed(), 'project._actionsList')
    </td>
</tr>
        