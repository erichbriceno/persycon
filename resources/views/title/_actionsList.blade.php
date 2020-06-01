<form method="POST" action="{{ route('project.trash', $title) }}">
    @csrf
    @method('PATCH')
    <a href="{{ route('project.edit', $title ) }}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-pencil-alt"></i></a>
    <button type="submit" class="btn btn-outline-secondary btn-sm"><i class="fas fa-trash-alt"></i></button>
</form>