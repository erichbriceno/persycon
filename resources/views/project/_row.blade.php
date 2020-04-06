<tr>
    <th scope="row">{{ $project->id }}</th>
    <td>{{ $project->name }}</td>
    <td>{{ $project->description }}</td>
    <td class="text-center">
        <span class="note-black">L1</span>
        <span class="note-black">10</span>
    </td>
    <td class="text-center">
        <span class="note-black">L2</span>
        <span class="note-black">30</span>
    </td>
    <td class="text-center">
        <span class="note-black">L3</span>
        <span class="note-black">100</span>
    </td>
    <td class="text-center">
        <span class="note-black">L4</span>
        <span class="note-black">1500</span>
    </td>
    <td>
        <span class="note-black">Inicio: {{ $project->start->format('d/m/Y') }}</span>
        <span class="note">Fin: {{ optional($project->ends)->format('d/m/Y h:ia') ?: '-' }}</span>
    </td>
    <td class="text-center">
        <a href="#" class="btn btn-outline-secondary btn-sm"><i class="fas fa-pencil-alt"></i></a>
        <a href="#" class="btn btn-outline-secondary btn-sm"><i class="fas fa-trash-alt"></i></a>             
    </td>
</tr>
        