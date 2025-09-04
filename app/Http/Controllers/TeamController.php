<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TeamController extends Controller
{
    //? GET /teams - List semua programmer
    public function index()
    {
        $teams = Team::withCount(['tickets as active_tickets_count' => function ($query) {
            $query->whereIn('status', ['open', 'in_progress']);
        }])->get();

        return view('Teams.index', compact('teams'));
    }

    //? POST /teams - Tambah programmer baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100'
        ]);

        $team = Team::create([
            'name' => $request->name
        ]);

        return redirect()->route('teams.index')
            ->with('success', 'Programmer berhasil ditambahkan');
    }

    //? GET /teams/{id}/tickets - Tickets assigned to specific team member
    public function tickets($id)
    {
        $team = Team::findOrFail($id);
        $tickets = $team->tickets()
            ->orderBy('created_at', 'desc')
            ->get();

        return view('teams.tickets', compact('team', 'tickets'));
    }

    // API Routes
    public function apiIndex(): JsonResponse
    {
        $teams = Team::withCount(['tickets as active_tickets_count' => function ($query) {
            $query->whereIn('status', ['open', 'in_progress']);
        }])->get();

        return response()->json([
            'status' => 'success',
            'data' => $teams
        ]);
    }
}
