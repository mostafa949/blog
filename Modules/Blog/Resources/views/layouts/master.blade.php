<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>

       {{-- Laravel Mix - CSS File --}}
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    </head>
    <body class="bg-gray-100 h-screen antialiased leading-none font-sans">
    <div id="app">
        <header class="bg-gray-800 py-6">
            <div class="container mx-auto flex justify-between items-center px-6">
                <div>
                    <a href="{{ url('/') }}" class="text-lg font-semibold text-gray-100 no-underline">
                        Blog
                    </a>
                </div>
                <nav class="space-x-4 text-gray-300 text-sm sm:text-base">
                    <a class="no-underline hover:underline" href="{{ route('home') }}">Home</a>
                    <a class="no-underline hover:underline" href="{{ route('blog.index') }}">Blog</a>
                    <a class="no-underline hover:underline" href="{{ route('blog.categories.index') }}">Categories</a>

                    @if (auth()->guard('web')->guest() and auth()->guard('admin')->guest())
                        <a class="no-underline hover:underline" href="{{ route('login') }}">{{ __('Login') }}</a>
                        @if (Route::has('register.user'))
                            <a class="no-underline hover:underline"
                               href="{{ route('register.user') }}">{{ __('Register') }}</a>
                        @endif
                    @endif

                    @auth('admin')
                        <span>{{ auth('admin')->user()->name }}</span>

                        <a href="{{ route('logout') }}"
                           class="no-underline hover:underline"
                           onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            {{ csrf_field() }}
                        </form>
                    @endauth
                    @auth('web')
                        <span>{{ auth('web')->user()->name }}</span>

                        <a href="{{ route('logout') }}"
                           class="no-underline hover:underline"
                           onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            {{ csrf_field() }}
                        </form>
                    @endauth
                </nav>
            </div>
        </header>

        <div>
            @yield('content')
        </div>

        <div>
            @include('blog::layouts.footer')
        </div>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.bundle.js"></script>
    </body>
</html>
