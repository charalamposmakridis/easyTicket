@extends('layouts.app')

@section('content')
    <h1>Login</h1>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus>
            @error('email')
            <p><small>{{ $message }}</small></p>
            @enderror
        </div>

        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            @error('password')
            <p><small>{{ $message }}</small></p>
            @enderror
        </div>

        <div>
            <label>
                <input type="checkbox" name="remember"> Remember me
            </label>
        </div>

        @if (Route::has('password.request'))
            <div>
                <a href="{{ route('password.request') }}">Forgot your password?</a>
            </div>
        @endif

        <button type="submit">Log in</button>
    </form>

    <br>

    @if (Route::has('register'))
        <div>
            Don't have an account?
            <a href="{{ route('register') }}">Register here!</a>
        </div>
    @endif
@endsection
