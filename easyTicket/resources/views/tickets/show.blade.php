@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h1>Ticket #{{ $ticket->id }}: {{ $ticket->title }}</h1>

    <p><strong>Created by:</strong> {{ $ticket->user->name }} ({{ $ticket->user->email }})</p>
    <p><strong>Status:</strong> {{ strtoupper($ticket->status) }}</p>
    <p><strong>Priority:</strong> {{ ucfirst($ticket->priority) }}</p>
    <p><strong>Assigned Agent:</strong> {{ $ticket->agent ? $ticket->agent->name : 'Unassigned' }}</p>

    <p><strong>Categories:</strong>
        @forelse($ticket->categories as $category)
            <span>[{{ $category->name }}]</span>
        @empty
            <span>None</span>
        @endforelse
    </p>

    <h3>Description</h3>
    <p>{{ $ticket->description }}</p>

    <hr>

    @if(auth()->user()->isAgent() || auth()->user()->isAdmin())
        <div>
            <h3>Manage Ticket</h3>
            <form method="POST" action="{{ route('tickets.update-status', $ticket) }}">
                @csrf
                @method('PATCH')

                <div>
                    <label for="status"><strong>Change Status:</strong></label><br>
                    <select name="status" id="status">
                        <option value="open" {{ $ticket->status == 'open' ? 'selected' : '' }}>Open</option>
                        <option value="in_progress" {{ $ticket->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="closed" {{ $ticket->status == 'closed' ? 'selected' : '' }}>Closed (Resolved)</option>
                    </select>
                    <button type="submit">Update Status</button>
                </div>
            </form>

            <form method="POST" action="{{ route('tickets.assign', $ticket) }}">
                @csrf
                @method('PATCH')

                <div>
                    <label for="assigned_to"><strong>Assign Agent:</strong></label><br>
                    <select name="assigned_to" id="assigned_to">
                        <option value="">Unassigned</option>
                        @foreach($agents as $agent)
                            <option value="{{ $agent->id }}" {{ $ticket->assigned_to == $agent->id ? 'selected' : '' }}>
                                {{ $agent->name }} ({{ $agent->role }})
                            </option>
                        @endforeach
                    </select>
                    <button type="submit">Assign Agent</button>
                </div>
            </form>
        </div>
        <br>
    @endif

    <a href="{{ route('tickets.edit', $ticket) }}">Edit Ticket</a> |
    <a href="{{ route('tickets.index') }}">Back to Tickets List</a>
@endsection
