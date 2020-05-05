<tr>
    <td>{{ $group->name }}</td>
    <td>
        <span class="note-black">{{ $group->description }}</span>
    </td>
    <td>{{ $group->coordination->name }}</td>
    <td class="text-center">
        <span class="note-black">Req / Con</span>
        <span class="note-black">45 / 03</span>
    </td>
    <td class="text-center">
        <span class="note-black">@lang('Activities')</span>
        <span class="note-black">80%</span>
    </td>
    <td class="form-inline justify-content-center">
        @includeWhen($group->trashed(), 'group._actionsTrash')
        @includeUnless($group->trashed(), 'group._actionsList')
    </td>
</tr>