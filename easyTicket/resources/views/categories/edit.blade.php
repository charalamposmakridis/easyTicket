@extends('layouts.app')

@section('content')
    <h1>Edit Category #{{ $category->id }}</h1>

    <form method="POST" action="{{ route('categories.update', $category) }}">
        @csrf
        @method('PUT')

        <div>
            <label for="name">Category Name:</label><br>
            <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" required>
            @error('name')
            <p><small>{{ $message }}</small></p>
            @enderror
        </div>

        <br>

        <button type="submit">Update Category</button>
        <a href="{{ route('categories.index') }}">Cancel</a>
    </form>
@endsection
