<header class="mt-3 d-flex justify-content-between align-items-center">

    {{--Brand--}}
    <h1 class="h4 m-0 text-primary text-uppercase font-weight-bold">
        <a class="text-decoration-none" href="{{ route('home', '/') }}">Maršrutai</a>
    </h1>
    {{--Brand--}}

    @auth()
        <div class="d-flex">

            {{--Toggler Button--}}
            <button class="btn d-lg-none"
                    type="button"
                    data-toggle="collapse"
                    data-target="#side-navbar"
                    aria-controls="side-navbar"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                <span>Meniu</span>
            </button>
            {{--Toggler Button--}}

            {{--Logout Form--}}
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button class="btn btn-light ml-1">Atsijungti</button>
            </form>
            {{--Logout Form--}}

        </div>
    @endauth

</header>