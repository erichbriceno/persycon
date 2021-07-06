<tr>
    <td>
        {{ $people->name }}
        <span class="note">
            {{ $people->cedule }}
        </span>
    </td>
    <td class="text-center">{{ $people->gender }}</td>
    <td class="text-center">{{ $people->age }}</td>
    <td>erichbriceno@gmail.com</td>
    <td class="form-inline justify-content-center">
        <form method="POST" action="{{ route('people.blacklist', $people) }}">
            @csrf
            @method('PATCH')
            <a href="#" class="btn btn-outline-secondary btn-sm"><i class="fas fa-eye"></i></a>
            <a href="#"    class="btn btn-outline-secondary btn-sm"><i class="fas fa-pencil-alt"></i></a>
            <button type="submit" class="btn btn-outline-secondary btn-sm"><i class="fas fa-trash-alt"></i></button>
        </form>
    </td>
</tr>