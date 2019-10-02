<tr>
    <th scope="row">{{ $user->id }}</th>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>{{ $user->role }}</td>
    <td class="text-center">
        <form action="#" method="POST">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <a href="{{ route('user.details', ['user' => $user->id]) }}" class="btn btn-link"><i class="fas fa-eye"></i></a>
            <a href="{{ route('user.details', ['user' => $user->id]) }}" class="btn btn-link"><i class="fas fa-pencil-alt"></i></a>
            <button type="submit" class="btn btn-link"><i class="fas fa-trash-alt"></i></button>
        </form>
    </td>
</tr>