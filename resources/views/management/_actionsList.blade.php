<form method="POST" action="{{ route('user.trash', $management) }}">
    @csrf
    @method('PATCH')
    <a href="{{ route('user.details', $management ) }}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-eye"></i></a>
    <a href="{{ route('user.edit', $management ) }}"    class="btn btn-outline-secondary btn-sm"><i class="fas fa-pencil-alt"></i></a>
    <button type="submit" class="btn btn-outline-secondary btn-sm"><i class="fas fa-trash-alt"></i></button>
</form>