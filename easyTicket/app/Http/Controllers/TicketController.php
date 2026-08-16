<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Category;
use App\Models\User;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isClient()) {
            $tickets = Ticket::with(['categories', 'agent'])
                ->where('user_id', $user->id)
                ->latest()
                ->paginate(10);
        } else {
            $tickets = Ticket::with(['user', 'categories', 'agent'])
                ->latest()
                ->paginate(10);
        }

        return view('tickets.index', compact('tickets'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('tickets.create', compact('categories'));
    }

    public function store(StoreTicketRequest $request)
    {
        $ticket = auth()->user()->tickets()->create([
            'title'       => $request->title,
            'description' => $request->description,
            'priority'    => $request->priority,
            'status'      => 'open',
        ]);

        if ($request->has('categories')) {
            $ticket->categories()->sync($request->categories);
        }

        return redirect()->route('tickets.index')
            ->with('success', 'Ticket created successfully!');
    }

    public function show(Ticket $ticket)
    {
        if (auth()->user()->isClient() && $ticket->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access.');
        }

        $ticket->load(['user', 'categories', 'agent']);

        $agents = User::whereIn('role', ['agent', 'admin'])->get();

        return view('tickets.show', compact('ticket', 'agents'));
    }

    public function edit(Ticket $ticket)
    {
        if (auth()->user()->isClient() && $ticket->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access.');
        }

        $categories = Category::all();
        return view('tickets.edit', compact('ticket', 'categories'));
    }

    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        if (auth()->user()->isClient() && $ticket->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access.');
        }

        $data = [
            'title'       => $request->title,
            'description' => $request->description,
            'priority'    => $request->priority,
        ];

        if (!auth()->user()->isClient() && $request->has('status')) {
            $data['status'] = $request->status;
        }

        $ticket->update($data);

        if ($request->has('categories')) {
            $ticket->categories()->sync($request->categories);
        } else {
            $ticket->categories()->detach();
        }

        return redirect()->route('tickets.show', $ticket)
            ->with('success', 'Ticket updated successfully!');
    }

    public function destroy(Ticket $ticket)
    {
        if (auth()->user()->isClient() && $ticket->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access.');
        }

        $ticket->categories()->detach();
        $ticket->delete();

        return redirect()->route('tickets.index')
            ->with('success', 'Ticket deleted successfully!');
    }

    public function updateStatus(Request $request, Ticket $ticket)
    {
        if ($request->user()->isClient()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'status' => 'required|in:open,in_progress,closed',
        ]);

        $ticket->update([
            'status' => $request->status,
        ]);

        return redirect()->route('tickets.show', $ticket)
            ->with('success', 'Status updated successfully!');
    }

    public function assignAgent(Request $request, Ticket $ticket)
    {
        if ($request->user()->isClient()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        $ticket->update([
            'assigned_to' => $request->assigned_to,
        ]);

        return redirect()->route('tickets.show', $ticket)
            ->with('success', 'Agent assigned successfully!');
    }
}
