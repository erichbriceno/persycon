<tr>
    <th scope="row">{{ $user->id }}</th>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>{{ $user->role }}</td>
    <td>
        Botones
        <a href="{{ route('user.details', ['user' => $user->id]) }}"> Detalles</a>
    </td>
</tr>