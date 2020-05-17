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
        <span class="font-weight-bold text-secondary">
            3
        </span>
     </td>
    <td class="text-center">
        <span class="text-secondary">
            <i class="fas fa-battery-empty"></i>
        </span>
    </td>
    <td class="text-center">
        <a href="#" class="text-secondary">
            <i class="fas fa-handshake{{ $project->loadcategories ? '' : '-slash' }}"></i>
        </a>
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
        