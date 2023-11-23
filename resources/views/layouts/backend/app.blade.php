<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>@yield('title') | {{ setting('site_title', 'Patthokrom') }}</title> --}}
    <title>@yield('title') | {{ 'Patthokrom' }}</title>

    {{-- <link rel="icon"  href="{{ setting('site_favicon') != null ? Storage::disk('public')->url(setting('site_favicon')) : '' }}"/> --}}
    <link rel="icon" href="#" />
    <!-- Styles -->
    <link href="{{ asset('backend/css/backend.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/iziToast.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
    @stack('css')
</head>

<body>
    <div id="app" class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        @include('layouts.backend.partials.header')
        <div class="app-main">
            @if(auth()->guard('admin')->check())
            @include('layouts.backend.partials.sidebar')
            @elseif(auth()->guard('student')->check())
            @include('layouts.backend.partials.sidebar_student')
            @elseif(auth()->guard('teacher')->check())
            @include('layouts.backend.partials.sidebar_teacher')
            @endif
            <div class="app-main__outer">
                <div class="app-main__inner">
                    @yield('content')
                </div>
                @include('layouts.backend.partials.footer')
            </div>
        </div>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('backend/js/backend.js') }}"></script>
    <script src="{{ asset('backend/js/app.js') }}"></script>
    <script src="{{ asset('backend/js/script.js') }}"></script>
    <script src="{{ asset('js/iziToast.js') }}"></script>
    @stack('js')
    @include('vendor.lara-izitoast.toast')
</body>

</html>
