@extends('layouts.deconnecte')

@section('content')
    <h3 class="login-box-msg">Connexion</h3>

    <form method="POST" action="{{ route('login') }}">

        @csrf
        <div class="input-group mb-3">

            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <div class="input-group-append ">
                <div class="input-group-text ">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
        </div>
        <div class="input-group mb-3">

            <input id="password" type="password"
                class="form-control @error('password') is-invalid @enderror" name="password" required
                autocomplete="current-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-7">
                <div class="icheck-primary">
                    <input type="checkbox" id="remember">
                    <label for="remember" class="mt-2">
                        Souviens-toi de moi
                    </label>
                </div>
            </div>

            <div class="col-5">
                <button type="submit" class="btn btn-info btn-block">Se connecter</button>
            </div>
            <!-- /.col -->
        </div>
    </form>

    <!-- /.social-auth-links -->
    @if (Route::has('password.request'))
        <div class="mt-4 text-center">
            <a class="btn btn-link" href="{{ route('password.request') }}">
                {{ __('Mot de passe oublié?') }}
            </a>
        </div>
    @endif
@endsection
