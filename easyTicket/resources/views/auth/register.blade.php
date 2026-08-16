@extends('layouts.app')

@section('content')
    <h1>Register</h1>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus>
            @error('name')
            <p><small>{{ $message }}</small></p>
            @enderror
        </div>

        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required>
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
            <label for="password_confirmation">Confirm Password:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required>
        </div>

        <div>
            <a href="{{ route('login') }}">Already registered? Log in</a>
        </div>

        <button type="submit">Register</button>
    </form>
@endsection
