@extends('app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                {{--Verification Card--}}
                <div class="card">

                    {{--Heading--}}
                    <div class="card-header">El. pašto adreso patvirtinimas</div>
                    {{--Heading--}}

                    {{--Body--}}
                    <div class="card-body">

                        @if (session('resent'))
                            <div class="alert alert-success"
                                 role="alert">
                                Patvirtinimo nuoroda nusiųsta nurodytu el. pašto adresu.
                            </div>
                        @endif

                        Prieš tęsiant, patikrinkite ar gavote patvirtinimo nuorodą nurodytu el. pašto adresu.
                        Jei negavote laiško,
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit"
                                    class="btn btn-link p-0 m-0 align-baseline">pakartoti siuntimą
                            </button>
                            .
                        </form>
                    </div>
                    {{--Body--}}

                </div>
                {{--Verification Card--}}

            </div>
        </div>
    </div>
@endsection
