<form method="POST" action="{{ route('user.restore', $user) }}">
    @csrf
    @method('PATCH')
    <button type="submit" class="btn btn-outline-secondary btn-sm"><i class="fas fa-trash-restore"></i></button>
</form>
<form method="POST" action="{{ route('user.destory', $user) }}">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-outline-secondary btn-sm"><i class="fas fa-times-circle"></i></button>
</form>