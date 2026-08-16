@extends('layouts.app')

@section('content')
    <h1>Edit Ticket #{{ $ticket->id }}</h1>

    <form method="POST" action="{{ route('tickets.update', $ticket) }}">
        @csrf
        @method('PUT')

        <div>
            <label for="title">Title:</label><br>
            <input type="text" name="title" id="title" value="{{ old('title', $ticket->title) }}" required>
            @error('title')
            <p><small>{{ $message }}</small></p>
            @enderror
        </div>

        <br>

        <div>
            <label for="priority">Priority:</label><br>
            <select name="priority" id="priority" required>
                <option value="low" {{ old('priority', $ticket->priority) == 'low' ? 'selected' : '' }}>Low</option>
                <option value="medium" {{ old('priority', $ticket->priority) == 'medium' ? 'selected' : '' }}>Medium
                </option>
                <option value="high" {{ old('priority', $ticket->priority) == 'high' ? 'selected' : '' }}>High</option>
            </select>
            @error('priority')
            <p><small>{{ $message }}</small></p>
            @enderror
        </div>

        <br>

        {{-- Επιλογή Status: Εμφανίζεται ΑΠΟΚΛΕΙΣΤΙΚΑ σε Agent/Admin --}}
        @if(auth()->user()->isAgent() || auth()->user()->isAdmin())
            <div>
                <label for="status">Status:</label><br>
                <select name="status" id="status" required>
                    <option value="open" {{ old('status', $ticket->status) == 'open' ? 'selected' : '' }}>Open</option>
                    <option value="in_progress" {{ old('status', $ticket->status) == 'in_progress' ? 'selected' : '' }}>
                        In Progress
                    </option>
                    <option value="closed" {{ old('status', $ticket->status) == 'closed' ? 'selected' : '' }}>Closed
                    </option>
                </select>
                @error('status')
                <p><small>{{ $message }}</small></p>
                @enderror
            </div>
            <br>
        @endif

        <div>
            <label for="categories">Categories:</label><br>
            <select name="categories[]" id="categories" multiple>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ in_array($category->id, old('categories', $ticket->categories->pluck('id')->toArray())) ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('categories')
            <p><small>{{ $message }}</small></p>
            @enderror
        </div>

        <br>

        <div>
            <label for="description">Description:</label><br>
            <textarea name="description" id="description" rows="5"
                      required>{{ old('description', $ticket->description) }}</textarea>
            @error('description')
            <p><small>{{ $message }}</small></p>
            @enderror
        </div>

        <br>

        <button type="submit">Update Ticket</button>
        <a href="{{ route('tickets.show', $ticket) }}">Cancel</a>
    </form>
@endsection
