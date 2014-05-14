<?php use Bono\Helper\URL; ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Viper')</title>

    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />

    <link type="image/x-icon" href="{{ Theme::base('img/favicon.ico') }}" rel="Shortcut icon" />

    <link rel="stylesheet" href="{{ Theme::base('css/naked.css') }}">
    <link rel="stylesheet" href="{{ Theme::base('css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ Theme::base('css/font/montserrat/stylesheet.css') }}">
    <link rel="stylesheet" href="{{ Theme::base('css/font/open_sans/stylesheet.css') }}">
    <link rel="stylesheet" href="{{ Theme::base('css/style.css') }}">

    <!-- PAGE LEVEL STYLING -->
    @yield('styler')
</head>

<body>
    <!-- NAVBAR -->
    @include('components.navbar')

    <div class="le-content">
        <div class="row alert-row">
            @if(isset($flash['error']))
                <div class="alert error">
                    <button type="button" class="close">×</button>
                    {{ $flash['error'] }}
                </div>
            @endif
            @if(isset($flash['info']))
                <div class="alert success">
                    <button type="button" class="close">×</button>
                    {{ $flash['info'] }}
                </div>
            @endif
        </div>

        <!-- PAGE CONTENT -->
        @yield('content')
    </div>

    <script type="text/javascript" charset="utf-8" src="{{ Theme::base('js/vendor/jquery.js') }}"></script>
    <script type="text/javascript" charset="utf-8" src="{{ Theme::base('js/vendor/underscore.js') }}"></script>
    <script type="text/javascript" charset="utf-8" src="{{ Theme::base('js/vendor/moment.js') }}"></script>
    <script type="text/javascript" charset="utf-8">
    (function(){
        var URL_SITE = window.URL_SITE = '{{ URL::site() }}',
            URL_BASE = window.URL_BASE = '{{ URL::base() }}';}
    )();
    </script>

    <!-- PAGE LEVEL SCRIPT -->
    @yield('injector')
</body>
</html>
