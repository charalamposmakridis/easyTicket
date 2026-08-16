@extends('layouts.app')

@section('content')
    <h1>Create New Ticket</h1>

    <form method="POST" action="{{ route('tickets.store') }}">
        @csrf

        <div>
            <label for="title">Title:</label><br>
            <input type="text" name="title" id="title" value="{{ old('title') }}" required>
            @error('title')
            <p><small>{{ $message }}</small></p>
            @enderror
        </div>

        <br>

        <div>
            <label for="priority">Priority:</label><br>
            <select name="priority" id="priority" required>
                <option value="">Select Priority</option>
                <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
            </select>
            @error('priority')
            <p><small>{{ $message }}</small></p>
            @enderror
        </div>

        <br>

        <div>
            <label for="categories">Categories:</label><br>
            <select name="categories[]" id="categories" multiple required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ is_array(old('categories')) && in_array($category->id, old('categories')) ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            <br><small>(Hold Ctrl/Cmd to select multiple)</small>
            @error('categories')
            <p><small>{{ $message }}</small></p>
            @enderror
        </div>

        <br>

        <div>
            <label for="description">Description:</label><br>
            <textarea name="description" id="description" rows="5" required>{{ old('description') }}</textarea>
            @error('description')
            <p><small>{{ $message }}</small></p>
            @enderror
        </div>

        <br>

        <button type="submit">Submit Ticket</button>
        <a href="{{ route('tickets.index') }}">Cancel</a>
    </form>
@endsection
