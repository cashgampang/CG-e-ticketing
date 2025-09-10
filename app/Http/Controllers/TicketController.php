<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TicketController extends Controller
{
    //? GET /tickets - List tickets berdasarkan role
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'IT') {
            // IT bisa lihat semua tickets
            $tickets = Ticket::with(['assignedTeam', 'user',])
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            // User biasa hanya bisa lihat ticket mereka sendiri
            $tickets = Ticket::with(['assignedTeam', 'user'])
                ->where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('Clients.index', compact('tickets'));
    }

    //? GET /tickets/create - Form buat ticket baru
    public function create()
    {
        $teams = Team::all();
        return view('Clients.create', compact('teams'));
    }

    //? POST /tickets/store - Form buat ticket baru
    public function store(Request $request): JsonResponse
    {
        try {
            if (!Auth::check()) {
                return response()->json([
                    'success' => false,
                    'message' => 'You must be logged in to create a ticket'
                ], 401);
            }

            $validated = $request->validate([
                'requester_name' => 'required|string|max:100',
                'problem_detail' => 'required|string',
                'definition_of_done' => 'required|string',
            ]);

            $ticket = Ticket::create([
                'requester_name' => $validated['requester_name'],
                'problem_detail' => $validated['problem_detail'],
                'definition_of_done' => $validated['definition_of_done'],
                'user_id' => Auth::id(), // Set the authenticated user's ID
                'status' => 'open', // default status
                'priority' => 'medium', // default priority
            ]);

            $ticket->load(['assignedTeam', 'user']);

            return response()->json([
                'success' => true,
                'message' => 'Ticket created successfully!',
                'ticket' => $ticket
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Ticket creation failed: ' . $e->getMessage(), [
                'user_id' => Auth::id(),
                'request_data' => $request->all(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while creating the ticket'
            ], 500);
        }
    }

    //? GET /tickets/{id} - Detail ticket dengan role check
    public function show($id)
    {
        $user = Auth::user();

        $ticket = Ticket::with(['assignedTeam', 'user'])->findOrFail($id);

        // Cek akses: IT bisa lihat semua, user hanya bisa lihat milik mereka
        if ($user->role !== 'IT' && $ticket->user_id !== $user->id) {
            abort(403, 'Unauthorized access to this ticket.');
        }

        $teams = Team::all();
        return view('Clients.show', compact('ticket', 'teams'));
    }

    //? GET /tickets/{id}/edit - Form edit ticket dengan role check
    public function edit($id)
    {
        $user = Auth::user();

        $ticket = Ticket::with(['assignedTeam', 'user'])->findOrFail($id);

        // Cek akses: IT bisa edit semua, user hanya bisa edit milik mereka yang masih open
        if ($user->role !== 'IT') {
            if ($ticket->user_id !== $user->id || !in_array($ticket->status, ['open', 'in_progress'])) {
                abort(403, 'Unauthorized to edit this ticket.');
            }
        }

        $teams = Team::all();
        return view('Clients.edit', compact('ticket', 'teams'));
    }

    //? PUT /tickets/{id} - Update ticket dengan role-based validation
    public function update(Request $request, $id): JsonResponse
    {
        try {
            if (!Auth::check()) {
                return response()->json([
                    'success' => false,
                    'message' => 'You must be logged in to update a ticket'
                ], 401);
            }

            $user = Auth::user();
            $ticket = Ticket::findOrFail($id);

            // Cek akses edit
            if ($user->role !== 'IT' && $ticket->user_id !== $user->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized to update this ticket'
                ], 403);
            }

            // Validasi berbeda sesuai role
            $validationRules = [];

            if ($user->role !== 'IT') {
                // User biasa wajib isi detail tiket
                $validationRules = [
                    'requester_name' => 'required|string|max:100',
                    'problem_detail' => 'required|string',
                    'definition_of_done' => 'required|string'
                ];
            } else {
                // IT bisa update status & assigned_to
                $validationRules['status'] = 'required|in:open,in_progress,resolved,closed';
                $validationRules['assigned_to'] = 'nullable|exists:teams,id';
            }

            $validated = $request->validate($validationRules);

            $updateData = [];

            // User biasa update detail tiket
            if ($user->role !== 'IT') {
                $updateData = $request->only([
                    'requester_name',
                    'problem_detail',
                    'definition_of_done'
                ]);
            } else {
                // IT update status & assignment
                $updateData['status'] = $request->status;
                $updateData['assigned_to'] = $request->assigned_to;

                // Update timestamp otomatis
                if ($request->status === 'in_progress' && $ticket->status !== 'in_progress') {
                    $updateData['assigned_at'] = now();
                }
                if ($request->status === 'resolved' && $ticket->status !== 'resolved') {
                    $updateData['resolved_at'] = now();
                }
            }

            $ticket->update($updateData);
            $ticket->load(['assignedTeam', 'user']);

            return response()->json([
                'success' => true,
                'message' => 'Ticket berhasil diupdate',
                'ticket' => $ticket
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ticket not found'
            ], 404);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Ticket update failed: ' . $e->getMessage(), [
                'user_id' => Auth::id(),
                'ticket_id' => $id,
                'request_data' => $request->all(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating the ticket'
            ], 500);
        }
    }


    //? POST /tickets/{id}/assign - Assign ticket ke programmer (hanya IT)
    public function assign(Request $request, $id)
    {
        $user = Auth::user();

        if ($user->role !== 'IT') {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Only IT can assign tickets.'], 403);
            }
            abort(403, 'Only IT can assign tickets.');
        }

        $ticket = Ticket::findOrFail($id);

        $request->validate([
            'assigned_to' => 'required|exists:teams,id'
        ]);

        $ticket->update([
            'assigned_to' => $request->assigned_to,
            'status'      => 'in_progress',
            'assigned_at' => now()
        ]);

        $ticket->load('assignedTeam');

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Ticket berhasil di-assign',
                'ticket'  => $ticket,
                'team'    => $ticket->assignedTeam
            ]);
        }

        return redirect()->back()->with('success', 'Ticket berhasil di-assign');
    }


    //? DELETE /tickets/{id} - Hanya IT atau pemilik ticket yang bisa hapus
    public function destroy($id)
    {
        try {
            $ticket = Ticket::findOrFail($id);
            $ticket->delete();

            return response()->json([
                'success' => true,
                'message' => 'Ticket deleted successfully'
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ticket not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete ticket'
            ], 500);
        }
    }


    //? GET /tickets/status/{status} - Filter by status dengan role check
    public function byStatus($status)
    {
        $user = Auth::user();

        $query = Ticket::with(['assignedTeam', 'user'])
            ->where('status', $status);

        if ($user->role !== 'IT') {
            $query->forUser($user->id);
        }

        $tickets = $query->orderBy('created_at', 'desc')->get();

        return view('Clients.index', compact('tickets', 'status'));
    }

    // API Routes dengan role-based access
    public function apiIndex(): JsonResponse
    {
        $user = Auth::user();

        $query = Ticket::with(['assignedTeam', 'user']);

        if ($user->role !== 'IT') {
            $query->forUser($user->id);
        }

        $tickets = $query->orderBy('created_at', 'desc')->get();

        return response()->json([
            'status' => 'success',
            'data' => $tickets
        ]);
    }

    public function apiAssign(Request $request, $id): JsonResponse
    {
        try {
            $user = Auth::user();

            if ($user->role !== 'IT') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Unauthorized. Only IT can assign tickets.'
                ], 403);
            }

            $ticket = Ticket::findOrFail($id);

            $request->validate([
                'assigned_to' => 'required|exists:teams,id'
            ]);

            $ticket->update([
                'assigned_to' => $request->assigned_to,
                'status' => 'in_progress',
                'assigned_at' => now()
            ]);

            $ticket->load(['assignedTeam', 'user']);

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
            $user = Auth::user();
            $ticket = Ticket::findOrFail($id);

            // Cek akses hapus
            if ($user->role !== 'IT') {
                if ($ticket->user_id !== $user->id || $ticket->status !== 'open') {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Unauthorized to delete this ticket.'
                    ], 403);
                }
            }

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
