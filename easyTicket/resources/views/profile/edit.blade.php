@extends('layouts.app')

@section('content')
    <h1>Profile Settings</h1>

    <!-- Ενημέρωση Στοιχείων Προφίλ -->
    <section>
        <h2>Update Profile Information</h2>
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('patch')

            <div>
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}" required>
                @error('name')
                <p><small>{{ $message }}</small></p>
                @enderror
            </div>

            <div>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}" required>
                @error('email')
                <p><small>{{ $message }}</small></p>
                @enderror
            </div>

            <button type="submit">Save Changes</button>
        </form>
    </section>

    <hr>

    <!-- Αλλαγή Κωδικού Πρόσβασης -->
    <section>
        <h2>Update Password</h2>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            @method('put')

            <div>
                <label for="current_password">Current Password:</label>
                <input type="password" name="current_password" id="current_password" required>
            </div>

            <div>
                <label for="password">New Password:</label>
                <input type="password" name="password" id="password" required>
            </div>

            <div>
                <label for="password_confirmation">Confirm Password:</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required>
            </div>

            <button type="submit">Update Password</button>
        </form>
    </section>
@endsection
