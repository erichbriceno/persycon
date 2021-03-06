<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>PerSyCon</title>

        <!-- Fonts -->
        <link href="{{ asset('css/fonts.css') }}" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">@lang('Home')</a>
                    @else
                        <a href="{{ route('login') }}">@lang('Login')</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    PerSyCon
                </div>

                <div class="links">
                    <a href="http://www.ex-cle.com">Ex-Cle</a>
                </div>
            </div>
        </div>
    </body>
</html>
