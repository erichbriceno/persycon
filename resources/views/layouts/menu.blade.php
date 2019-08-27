<nav class="navbar navbar-expand-md bg-dark navbar-dark p-0">
    <div class="container p-0">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown active">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @lang('Administration')
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('projects') }}">@lang('Projects')</a>
                        <a class="dropdown-item" href="{{ route('managements') }}">@lang('Managements')</a>
                        <a class="dropdown-item" href="{{ route('groups') }}">@lang('Groups')</a>
                        <a class="dropdown-item" href="{{ route('users') }}">@lang('Users')</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">@lang('Statistics')</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @lang('Personnel')
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">@lang('Bulk Load')</a>
                        <a class="dropdown-item" href="#">@lang('List')</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @lang('Payroll')
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">@lang('Interval')</a>
                        <a class="dropdown-item" href="#">@lang('Processing')</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
