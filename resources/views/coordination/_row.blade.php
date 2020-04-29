<tr>
    <th scope="row">{{ $coordination->id }}</th>
    <td>{{ $coordination->name }}</td>
    <td>{{ $coordination->description }}</td>
    <td >{{ $coordination->management->acronym }}</td>
    <td class="text-center">4</td>
    <td class="text-center">
        <span class="note-black">@lang('Activities')</span>
        <span class="note-black">80%</span>
    </td>
    <td class="form-inline justify-content-center">
        <a href="#" class="btn btn-outline-secondary btn-sm"><i class="fas fa-eye"></i></a>
        <a href="#" class="btn btn-outline-secondary btn-sm"><i class="fas fa-pencil-alt"></i></a>
        <a href="#" class="btn btn-outline-secondary btn-sm"><i class="fas fa-trash-alt"></i></a>
    </td>
</tr>