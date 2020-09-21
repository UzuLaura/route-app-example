@extends('app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                {{--Login Card--}}
                <div class="card">

                    {{--Heading--}}
                    <div class="card-header">Prisijungti</div>
                    {{--Heading--}}

                    {{--Body--}}
                    <div class="card-body">

                        {{--Login Form--}}
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            {{--Email--}}
                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">El. pašto adresas</label>

                                <div class="col-md-6">
                                    <input id="email"
                                           type="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           name="email"
                                           value="{{ old('email') }}"
                                           required
                                           autocomplete="email"
                                           autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            {{--Email--}}

                            {{--Password--}}
                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-right">Slaptažodis</label>

                                <div class="col-md-6">
                                    <input id="password"
                                           type="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           name="password"
                                           required
                                           autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            {{--Password--}}

                            {{--Remember Me--}}
                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input"
                                               type="checkbox"
                                               name="remember"
                                               id="remember"
                                                {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            Prisiminti mane
                                        </label>
                                    </div>
                                </div>
                            </div>
                            {{--Remember Me--}}

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">

                                    {{--Login Button--}}
                                    <button type="submit" class="btn btn-primary">
                                        Prisijungti
                                    </button>
                                    {{--Login Button--}}
                                </div>
                            </div>
                        </form>
                        {{--Login Form--}}

                    </div>
                    {{--Body--}}

                </div>
                {{--Login Card--}}

            </div>
        </div>
    </div>
@endsection
