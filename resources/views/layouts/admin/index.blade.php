<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ADMIN - IQOMAH TIME </title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body class="">

    <nav class="navbar navbar-expand-md navbar-light tw-bg-teal-300 tw-text-gray-200 shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }} " class="tw-text-gray-200">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
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

    
    <div class="py-4 tw-relative tw-min-h-full">
        <div class="tw-block tw-absolute tw-inset-y-0 tw-left-0 tw-bg-indigo-100 tw-shadow-md tw-border tw-border-l-0 tw-border-t-0 tw-border-b-0 tw-border-gray-500 tw-overflow-scroll" id="nav" style="width: 200px;">
            <ul>
                <li><x-admin.navigation-item url="{{route('admin.home')}}" name="Home" ></x-admin-navigation-item></li>
                <li><x-admin.navigation-item url="{{route('admin.setting.background.index')}}" name="Background" ></x-admin-navigation-item></li>
                <li><x-admin.navigation-item url="{{route('admin.homeSlider.index')}}" name="Home Slider" ></x-admin-navigation-item></li>
                <li><x-admin.navigation-item url="{{route('admin.time.index')}}" name="Time Setting" ></x-admin-navigation-item></li>
            </ul>
        </div>
        <div style="padding-left: 200px;">
            @yield('content')
        </div>
    </div>
    
    <script type="text/javascript" src="{{asset('js/app.js')}}"></script>    
</body>
</html>