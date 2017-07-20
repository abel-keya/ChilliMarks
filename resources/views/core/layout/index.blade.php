<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}>
    <head>
        <meta charset="utf-8" />
        <meta name="format-detection" content="telephone=no" />
        <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height" />
        <link rel="icon" href="{{ asset('chealth.ico') }}" type="image/x-icon" />

        <title>ChilliApp - Using Data Science to foster learners' academic growth</title>

        <link rel="stylesheet" href="{{ asset('css/phonon.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/components/side-panels.css') }}">
        <link rel="stylesheet" href="{{ asset('css/components/forms.css') }}">
        <link rel="stylesheet" href="{{ asset('css/components/lists.css') }}">
        <link rel="stylesheet" href="{{ asset('css/theme.css') }}">

        <!-- scripts -->
        <script src="{{ asset('js/phonon.js') }}"></script>
        <script src="{{ asset('js/components/side-panels.js') }}"></script>
        <script src="{{ asset('js/components/forms.js') }}"></script>
        <script src="{{ asset('js/components/notifications.js') }}"></script>
    </head>
    <body>
        @if(Auth::check())
        <div class="side-panel side-panel-left" data-expose-aside="left" data-disable="right" data-page="home" id="side-panel-identifier">
            <header class="header-bar">
                <button class="btn pull-right icon icon-close show-for-phone-only" data-side-panel-close="true"></button>
                <div class="pull-left">
                    <h4 class="title">ChilliApp Menu</h4>
                </div>
            </header>
            <div class="content">
                <ul class="list">
                    @if(Auth::user()->hasRole('superadmin') || Auth::user()->hasRole('admin'))
                        <li><a class="padded-list" href="{{ url('exams') }}">Exams</a></li>
                        <li><a class="padded-list" href="{{ url('teachers') }}">Teachers</a></li>
                        <li><a class="padded-list" href="{{ url('students') }}">Students</a></li>
                        <li><a class="padded-list" href="{{ url('reports') }}">Reports</a></li>
                        <li><a class="padded-list" href="{{ url('messages') }}">Messaging</a></li>
                        <li><a class="padded-list" href="{{ url('settings') }}">Settings</a></li>      
                    @endif
                    @if(Auth::user()->hasRole('teacher'))
                        <li><a class="padded-list" href="">My Exams</a></li>    
                    @endif
                    <li><a class="padded-list" href="{{ url('signout') }}">Sign Out</a></li>
                </ul>
            </div>
        </div>
        @endif

        @yield('partials')

        <home data-page="true">
            <header class="header-bar">
                @if(Auth::check())
                    <button class="btn icon icon-menu pull-left show-for-phone-only" data-side-panel-id="side-panel-identifier"></button>
                @endif
                <div class="center">
                    <h1 class="title">{{ ucfirst($page) }}</h1>
                </div>
            </header>
            <div class="content">
                @yield('body')
            </div>
        </home>

        <!-- our app config -->
        <script src="{{ asset('js/app.js') }}"></script>
        @yield('partials-script')
    </body>
</html>