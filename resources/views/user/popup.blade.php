<button type="button" class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#ModalCenter">
    @if ($user->trashed())
        <i class="fas fa-times-circle"></i>
    @else
        <i class="fas fa-trash-alt"></i>{{ $user->id }}
    @endif
</button>

<div class="modal fade" id="ModalCenter" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalCenterTitle">@lang('Confirm delete')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if ($user->trashed())
                    @lang('Are you really sure to delete the user?. This action cannot be reversed.')
                @else
                    @lang('Are you sure to delete the user?') {{ $user->id }}
                @endif
            </div>
            <form method="POST" action="{{ route('user.trash', $user) }}">
                @csrf
                @method('PATCH')
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn btn-primary">@lang('Delete')</button>
                </div>
            </form>
        </div>
    </div>
</div>
