<tr>
    <td>{{ $coordination->name }}</td>
    <td>{{ $coordination->description }}</td>
    <td>
        <span class="note-black">{{ $coordination->management->name }}</span>
    </td>
    <td class="text-center">4</td>
    <td class="text-center">
        <span class="note-black">@lang('Activities')</span>
        <span class="note-black">80%</span>
    </td>
    <td class="form-inline justify-content-center">
        @includeWhen($coordination->trashed(), 'coordination._actionsTrash')
        @includeUnless($coordination->trashed(), 'coordination._actionsList')        
    </td>
</tr>