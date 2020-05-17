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
        <div class="progress">
            <div class="progress-bar progress-bar-striped bg-secondary" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
        </div>
    </td>
    <td class="text-center">
        @if(! $project->loadcategories) <a href="{{ route('category.edit', $project ) }}"> @endif
            <span class="text-secondary"><i class="fas fa-handshake{{ $project->loadcategories ? '' : '-slash' }}"></i></span> 
        @if(! $project->loadcategories) </a> @endif
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
        