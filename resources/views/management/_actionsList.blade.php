<form method="POST" action="{{ route('management.trash', $management) }}">
    @csrf
    @method('PATCH')
    <a href="{{ route('managements') }}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-eye"></i></a>
    <a href="{{ route('management.edit', $management ) }}"    class="btn btn-outline-secondary btn-sm"><i class="fas fa-pencil-alt"></i></a>
    <button type="submit" class="btn btn-outline-secondary btn-sm"><i class="fas fa-trash-alt"></i></button>
</form>