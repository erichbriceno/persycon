<tr>
    <th scope="row">{{ $management->id }}</th>
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
        <span class="note-black">89%</span>
    </td>
    <td class="text-center">
        <span class="note-black">@lang('Activities')</span>
        <span class="note-black">80%</span>
    </td>
    <td class="text-center">
        <span class="note-black">@lang('Data')</span>
        <span class="note-black">60%</span>
    </td>
    <td class="form-inline justify-content-center">
        @includeWhen($management->trashed(), 'management._actionsTrash')
        @includeUnless($management->trashed(), 'management._actionsList')
    </td>
</tr>