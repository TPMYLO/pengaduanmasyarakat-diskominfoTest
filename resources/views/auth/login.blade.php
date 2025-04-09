@extends('layout.auth.app')
@section('title', 'Login')
@section('content')
    <div class="app app-auth-sign-in align-content-stretch d-flex flex-wrap justify-content-end">
        <div class="app-auth-background">

        </div>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="app-auth-container">
                <div class="logo">
                    <a href="{{ $appset->url }}">{{ $appset->name }}</a>
                </div>
                <div class="auth-credentials m-b-xxl">
                    <label for="signInEmail" class="form-label">Email</label>
                    <input type="email" class="form-control m-b-md @error('email') is-invalid @enderror" id="signInEmail"
                        aria-describedby="signInEmail" name="email" value="{{ old('email') }}"
                        placeholder="email@gmail.com" required>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <label for="signInPassword" class="form-label">Password</label>
                    <input type="password" class="form-control  @error('password') is-invalid @enderror" name="password"
                        required id="signInPassword" aria-describedby="signInPassword"
                        placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="auth-submit">
                    <button type="submit" class="btn btn-primary">Sign In</button>
                </div>
            </div>
        </form>
    </div>
@endsection
