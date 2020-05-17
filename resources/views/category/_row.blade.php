<tr>
    <td>{{ $project->name }}
        @if(! $project->active)
        <span class="note-danger">
            <i class="fas fa-lock"></i>
        </span>
        @endif
    </td>
    <td class="text-center">
        <span class="note-black">@lang('Category') 1</span>
        <span class="note-black">{{ $project->cat1->minimum }} / {{ $project->cat1->maximum }}</span>
    </td>
    <td class="text-center">
        <span class="note-black">@lang('Category') 2</span>
        <span class="note-black">{{ $project->cat2->minimum }} / {{ $project->cat2->maximum }}</span>
    </td>
    <td class="text-center">
        <span class="note-black">@lang('Category') 3</span>
        <span class="note-black">{{ $project->cat3->minimum }} / {{ $project->cat3->maximum }}</span>
    </td>
    <td class="text-center">
        <span class="note-black">@lang('Category') 4</span>
        <span class="note-black">{{ $project->cat4->minimum }} / {{ $project->cat4->maximum }}</span>
    </td>
    <td class="form-inline justify-content-center">
        <a href="#" class="btn btn-outline-secondary btn-sm"><i class="fas fa-eye"></i></a>
        <a href="{{ route('category.edit', $project ) }}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-pencil-alt"></i></a>
    </td>
</tr>
        