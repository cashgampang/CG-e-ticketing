<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TicketController extends Controller
{
    //? GET /tickets - List semua tickets
    public function index()
    {
        $tickets = Ticket::with('assignedTeam')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('Clients.index', compact('tickets'));
    }

    //? GET /tickets/create - Form buat ticket baru
    public function create()
    {
        $teams = Team::all();
        return view('Clients.create', compact('teams'));
    }

    //? POST /tickets - Buat ticket baru
    public function store(Request $request)
    {
        $request->validate([
            'requester_name' => 'required|string|max:100',
            'problem_detail' => 'required|string',
            'definition_of_done' => 'required|string'
        ]);

        $ticket = Ticket::create([
            'requester_name' => $request->requester_name,
            'problem_detail' => $request->problem_detail,
            'definition_of_done' => $request->definition_of_done,
            'status' => 'open'
        ]);

        return redirect()->route('Clients.index')
            ->with('success', 'Ticket berhasil dibuat');
    }

    //? GET /tickets/{id} - Detail ticket
    public function show($id)
    {
        $ticket = Ticket::with('assignedTeam')->findOrFail($id);
        $teams = Team::all();
        return view('Clients.show', compact('ticket', 'teams'));
    }

    //? GET /tickets/{id}/edit - Form edit ticket
    public function edit($id)
    {
        $ticket = Ticket::with('assignedTeam')->findOrFail($id);
        $teams = Team::all();
        return view('Clients.edit', compact('ticket', 'teams'));
    }

    //? PUT /tickets/{id} - Update ticket
    public function update(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);

        $request->validate([
            'requester_name' => 'required|string|max:100',
            'problem_detail' => 'required|string',
            'definition_of_done' => 'required|string',
            'status' => 'required|in:open,in_progress,resolved,closed',
            'assigned_to' => 'nullable|exists:teams,id'
        ]);

        // Update timestamp berdasarkan perubahan status
        $updateData = $request->only([
            'requester_name',
            'problem_detail', 
            'definition_of_done',
            'status',
            'assigned_to'
        ]);

        if ($request->status === 'in_progress' && $ticket->status !== 'in_progress') {
            $updateData['assigned_at'] = now();
        }
        if ($request->status === 'resolved' && $ticket->status !== 'resolved') {
            $updateData['resolved_at'] = now();
        }

        $ticket->update($updateData);

        return redirect()->route('Clients.index')
            ->with('success', 'Ticket berhasil diupdate');
    }

    //? POST /tickets/{id}/assign - Assign ticket ke programmer
    public function assign(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);

        $request->validate([
            'assigned_to' => 'required|exists:teams,id'
        ]);

        $ticket->update([
            'assigned_to' => $request->assigned_to,
            'status' => 'in_progress',
            'assigned_at' => now()
        ]);

        return redirect()->back()
            ->with('success', 'Ticket berhasil di-assign');
    }

    //? DELETE /tickets/{id}
    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();

        return redirect()->route('Clients.index')
            ->with('success', 'Ticket berhasil dihapus');
    }

    //? GET /tickets/status/{status} - Filter by status
    public function byStatus($status)
    {
        $tickets = Ticket::with('assignedTeam')
            ->where('status', $status)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('Clients.index', compact('tickets', 'status'));
    }

    // API Routes (untuk AJAX calls dari Alpine.js)
    public function apiIndex(): JsonResponse
    {
        $tickets = Ticket::with('assignedTeam')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $tickets
        ]);
    }

    public function apiAssign(Request $request, $id): JsonResponse
    {
        try {
            $ticket = Ticket::findOrFail($id);

            $request->validate([
                'assigned_to' => 'required|exists:teams,id'
            ]);

            $ticket->update([
                'assigned_to' => $request->assigned_to,
                'status' => 'in_progress',
                'assigned_at' => now()
            ]);

            $ticket->load('assignedTeam');

            return response()->json([
                'status' => 'success',
                'message' => 'Ticket berhasil di-assign',
                'data' => $ticket
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 422);
        }
    }

    public function apiDestroy($id): JsonResponse
    {
        try {
            $ticket = Ticket::findOrFail($id);
            $ticket->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Ticket berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 422);
        }
    }
}