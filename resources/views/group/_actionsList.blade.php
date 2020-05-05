<form method="POST" action="{{ route('group.trash', $group) }}">
    @csrf
    @method('PATCH')
    <a href="{{ route('groups') }}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-eye"></i></a>
    <a href="#"    class="btn btn-outline-secondary btn-sm"><i class="fas fa-pencil-alt"></i></a>
    <button type="submit" class="btn btn-outline-secondary btn-sm"><i class="fas fa-trash-alt"></i></button>
</form>