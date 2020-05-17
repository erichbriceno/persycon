<tr>
    <td>{{ $management->acronym }}
        @if(! $management->active)
        <span class="note-danger">
            <i class="fas fa-lock"></i>
        </span>
        @endif
    </td>
    <td>{{ $management->name }}</td>
    <td class="text-center">4</td>
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
    <td class="text-center">
        <span class="note-black">@lang('Hired')</span>
        <div class="progress">
            <div class="progress-bar progress-bar-striped bg-secondary" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
        </div>
    </td>
    <td class="text-center">
        <span class="note-black">@lang('Information')</span>
        <div class="progress">
            <div class="progress-bar progress-bar-striped bg-secondary" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">80%</div>
        </div>
    </td>
    <td class="text-center">
        <span class="note-black">@lang('Activities')</span>
        <div class="progress">
            <div class="progress-bar progress-bar-striped bg-secondary" role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100">35%</div>
        </div>
    </td>
    <td class="form-inline justify-content-center">
        @includeWhen($management->trashed(), 'management._actionsTrash')
        @includeUnless($management->trashed(), 'management._actionsList')
    </td>
</tr>