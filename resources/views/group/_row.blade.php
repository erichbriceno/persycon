<tr>
    <th scope="row">{{ $group->id }}</th>
    <td>{{ $group->name }}</td>
    <td>{{ $group->description }}</td>
    <td>{{ $group->created_at }}</td>
    <td class="form-inline justify-content-center">
        @includeWhen($group->trashed(), 'group._actionsTrash')
        @includeUnless($group->trashed(), 'group._actionsList')
    </td>
</tr>