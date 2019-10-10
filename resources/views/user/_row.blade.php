<tr>
    <th scope="row">{{ $user->id }}</th>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>{{ $user->role }}</td>
    <td class="text-right">
        <form method="POST" action="{{ route('user.destory', $user) }}">
            @csrf
            @method('DELETE')
            <a href="{{ route('user.details', $user ) }}" class="btn btn-link"><i class="fas fa-eye"></i></a>
            <a href="{{ route('user.edit', $user ) }}" class="btn btn-link"><i class="fas fa-pencil-alt"></i></a>
            <button type="submit" class="btn btn-link"><i class="fas fa-trash-alt"></i></button>
        </form>
    </td>
</tr>