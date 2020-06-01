<tr>
    <td>{{ $coordination->name }}</td>
    <td>{{ $coordination->description }}</td>
    <td class="text-center">{{ $coordination->management->acronym }}</td>
    <td class="text-center">{{ 4/3 }}</td>
    <td class="text-center">
        <span class="note-black">@lang('Activities')</span>
        <div class="progress">
            <div class="progress-bar progress-bar-striped bg-secondary" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">80%</div>
        </div>
    </td>
    <td class="form-inline justify-content-center">
        @includeWhen($coordination->trashed(), 'coordination._actionsTrash')
        @includeUnless($coordination->trashed(), 'coordination._actionsList')        
    </td>
</tr>