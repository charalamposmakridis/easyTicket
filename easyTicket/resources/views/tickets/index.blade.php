@extends('layouts.app')

@section('content')
    <h1>Tickets</h1>

    <p>
        <a href="{{ route('tickets.create') }}">+ Create New Ticket</a>
    </p>

    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Categories</th>
            <th>User</th>
            <th>Status</th>
            <th>Priority</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse($tickets as $ticket)
            <tr>
                <td>{{ $ticket->id }}</td>
                <td>{{ $ticket->title }}</td>
                <td>
                    {{ $ticket->categories->pluck('name')->implode(', ') ?: '-' }}
                </td>
                <td>{{ $ticket->user->name ?? 'N/A' }}</td>
                <td>{{ ucfirst($ticket->status) }}</td>
                <td>{{ ucfirst($ticket->priority) }}</td>
                <td>{{ $ticket->created_at->format('d/m/Y') }}</td>
                <td>
                    <a href="{{ route('tickets.show', $ticket) }}">View</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8">No tickets found.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <br>
    <div>
        {{ $tickets->links() }}
    </div>
@endsection
