<nav class="navbar navbar-expand-md bg-dark navbar-dark p-0">
    <div class="container p-0">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown active">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @lang('Administration')
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('users', ['state' => 'active']) }}">@lang('Users')</a>
                        <a class="dropdown-item" href="{{ route('projects') }}">@lang('Projects')</a>
                        <a class="dropdown-item" href="{{ route('managements') }}">@lang('Managements')</a>
                        <a class="dropdown-item" href="{{ route('coordinations') }}">@lang('Coordinations')</a>
                        <a class="dropdown-item" href="{{ route('groups') }}">@lang('Groups')</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">@lang('Statistics')</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @lang('Personnel')
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">@lang('Database')</a>
                        <a class="dropdown-item" href="#">@lang('List')</a>
                        <a class="dropdown-item" href="#">@lang('Bulk Load')</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @lang('Payroll')
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('categories') }}">@lang('Categories')</a>
                        <a class="dropdown-item" href="{{ route('titles') }}">@lang('Job titles')</a>
                        <a class="dropdown-item" href="#">@lang('Interval')</a>
                        <a class="dropdown-item" href="#">@lang('Processing')</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
