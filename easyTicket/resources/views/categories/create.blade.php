@extends('layouts.app')

@section('content')
    <h1>Create New Category</h1>

    <form method="POST" action="{{ route('categories.store') }}">
        @csrf

        <div>
            <label for="name">Category Name:</label><br>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required>
            @error('name')
            <p><small>{{ $message }}</small></p>
            @enderror
        </div>

        <br>

        <button type="submit">Save Category</button>
        <a href="{{ route('categories.index') }}">Cancel</a>
    </form>
@endsection
