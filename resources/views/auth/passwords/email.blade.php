@extends('layouts.deconnecte')

@section('content')
    <h5 class="login-box-msg">Réinitialisation mot de passe</h5>

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <label for="email" class="col-md-3 col-form-label text-md-end">Email</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <div class="mt-3 text-center">
            <button type="submit" class="btn btn-primary float-left">Valider</button>
            <a href="{{ route('login') }}" class="mr-2 float-right">Retour</a>
        </div>
    </form>
@endsection
