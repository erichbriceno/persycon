<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>



    <!-- Fonts -->
    <link href="//fonts.gstatic.com" rel="dns-prefetch" >
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fonts.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-datepicker.css') }}" rel="stylesheet">

 </head>
<body>
<header>
    <nav class="navbar navbar-expand-md navbar-light bg-white">
        <div class="container pl-0">
            <div class="col-10 form-inline pl-0">
                <div class="col-8">
                    <a class="navbar-brand logo" href="{{ url('/') }}">
                        PerSyCon
                    </a>
                </div>

                <div class="col-4">
                    <div class="form-inline justify-content-end">
                        {{ trans("titles.{$module}.{$view}") }}
                    </div>
                </div>

            </div>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">@lang('Login')</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} ({{ Auth::user()->id }})  <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    @lang('Logout')
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    @include('layouts.menu')

</header>

<main role="main" class="container p-0">
    <div class="row">
        <div class="col-10 mt-3">
            @yield('content')
        </div>
        <div class="col-2 mt-3">
            @include('layouts.works')
        </div>
    </div>
</main>

@include('layouts.footer')

<!-- Scripts -->
{{--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>--}}
{{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>--}}
{{--<script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/js/gijgo.min.js"></script>--}}

<script src="{{ asset('js/all.js') }}" ></script>
<script src="{{ asset('js/jquery.js') }}" ></script>
<script src="{{ asset('js/app.js') }}" ></script>
<script src="{{ asset('js/bootstrap.js') }}" ></script>
<script src="{{ asset('js/bootstrap-datepicker.js') }}" ></script>
<script>
    $('#from').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'dd/mm/yyyy'
    });
    $('#to').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'dd/mm/yyyy'
    });
</script>

</body>
</html>
