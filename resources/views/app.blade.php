<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

{{--Head--}}
@include('layouts.head')
{{--Head--}}

<body class="bg-light">
<div id="app">
    <div class="container">

        {{--Header--}}
        @include('layouts.header')
        {{--Header--}}

        {{--Decoravive line--}}
        <hr class="my-2">
        {{--Decoravive line--}}

        <main class="row mt-4">

            @auth()

                {{--Navbar--}}
                @include('layouts.navbar')
                {{--Navbar--}}

                {{--Content--}}
                <div class="col-12 col-lg-10">
                    <router-view></router-view>
                </div>
                {{--Content--}}

            @endauth

            @yield('content')

        </main>

    </div>
</div>
</body>
</html>
