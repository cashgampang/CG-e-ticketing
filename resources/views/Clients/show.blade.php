@extends('layouts.app')

@section('title', 'Ticket Detail')

@section('content')
    <div class="min-h-screen bg-base-200 py-4 sm:py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="bg-base-100 rounded-lg shadow-sm border border-base-300 p-4 sm:p-6 mb-6 sm:mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <a href="{{ route('tickets.index') }}"
                            class="p-2 rounded-lg bg-base-200 hover:bg-base-300 transition-colors">
                            <svg class="w-5 h-5 text-base-content" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                                </path>
                            </svg>
                        </a>
                        <div>
                            <h1 class="text-xl sm:text-2xl font-bold text-base-content">Ticket #{{ $ticket->id }}</h1>
                            <p class="text-sm text-base-content/70">Created on {{ $ticket->created_at->format('M d, Y') }}
                            </p>
                        </div>
                        <div class="ml-0 sm:ml-4">
                            @php
                                $statusColors = [
                                    'open' => 'bg-base-200 text-base-content border-base-300',
                                    'in_progress' => 'bg-base-300 text-base-content border-base-content/20',
                                    'resolved' => 'bg-neutral text-neutral-content border-neutral',
                                    'closed' => 'bg-base-content text-base-100 border-base-content',
                                ];
                            @endphp
                            <span
                                class="px-3 py-1 rounded-full text-xs font-medium border {{ $statusColors[$ticket->status] ?? 'bg-base-200 text-base-content border-base-300' }}">
                                {{ strtoupper($ticket->status) }}
                            </span>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-wrap gap-2">
                        @if (auth()->user()->role === 'IT' || $ticket->user_id === auth()->id())
                            <a href="{{ route('tickets.edit', $ticket->id) }}"
                                class="px-4 py-2 bg-neutral hover:bg-neutral-focus text-neutral-content rounded-lg font-medium transition-colors flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                    </path>
                                </svg>
                                Edit
                            </a>
                        @endif

                        @if (auth()->user()->role === 'IT')
                            <button onclick="showAssignModal()"
                                class="px-4 py-2 bg-base-300 hover:bg-base-content/20 text-base-content rounded-lg font-medium transition-colors flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                    </path>
                                </svg>
                                Assign
                            </button>
                        @endif

                        @if (auth()->user()->role === 'IT' || ($ticket->user_id === auth()->id() && $ticket->status === 'open'))
                            <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST" class="inline"
                                onsubmit="return confirm('Are you sure you want to delete this ticket?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-4 py-2 bg-base-300 hover:bg-error/20 text-base-content hover:text-error rounded-lg font-medium transition-colors flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                    Delete
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 sm:gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6 sm:space-y-8">
                    <!-- Ticket Information -->
                    <div class="bg-base-100 rounded-lg shadow-sm border border-base-300 p-4 sm:p-6">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="p-2 bg-base-200 rounded-lg">
                                <svg class="w-5 h-5 text-base-content" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h2 class="text-lg sm:text-xl font-bold text-base-content">Ticket Information</h2>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                            <div class="bg-base-200 rounded-lg p-4">
                                <label class="text-sm font-medium text-base-content/70 mb-2 block">Requester</label>
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-neutral rounded-full flex items-center justify-center">
                                        <span
                                            class="text-neutral-content text-sm font-bold">{{ substr($ticket->user->name, 0, 1) }}</span>
                                    </div>
                                    <span class="font-medium text-base-content">{{ $ticket->requester_name }}</span>
                                </div>
                            </div>

                            <div class="bg-base-200 rounded-lg p-4">
                                <label class="text-sm font-medium text-base-content/70 mb-2 block">Status</label>
                                <div class="flex items-center gap-2">
                                    <div
                                        class="w-3 h-3 rounded-full {{ $ticket->status === 'open' ? 'bg-warning' : ($ticket->status === 'in_progress' ? 'bg-info' : ($ticket->status === 'resolved' ? 'bg-success' : 'bg-neutral')) }}">
                                    </div>
                                    <span
                                        class="font-medium text-base-content capitalize">{{ str_replace('_', ' ', $ticket->status) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Problem Description -->
                    <div class="bg-base-100 rounded-lg shadow-sm border border-base-300 p-4 sm:p-6">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="p-2 bg-base-200 rounded-lg">
                                <svg class="w-5 h-5 text-base-content" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z">
                                    </path>
                                </svg>
                            </div>
                            <h2 class="text-lg sm:text-xl font-bold text-base-content">Problem Description</h2>
                        </div>
                        <div class="prose max-w-none">
                            <p class="text-base-content/80 leading-relaxed">{{ $ticket->problem_detail }}</p>
                        </div>
                    </div>

                    <!-- Definition of Done -->
                    <div class="bg-base-100 rounded-lg shadow-sm border border-base-300 p-4 sm:p-6">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="p-2 bg-base-200 rounded-lg">
                                <svg class="w-5 h-5 text-base-content" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h2 class="text-lg sm:text-xl font-bold text-base-content">Definition of Done</h2>
                        </div>
                        <div class="prose max-w-none">
                            <p class="text-base-content/80 leading-relaxed">{{ $ticket->definition_of_done }}</p>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6 sm:space-y-8">
                    @if (auth()->user()->role === 'IT')
                        <!-- Assignment Section -->
                        <div class="bg-base-100 rounded-lg shadow-sm border border-base-300 p-4 sm:p-6">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="p-2 bg-base-200 rounded-lg">
                                    <svg class="w-5 h-5 text-base-content" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                        </path>
                                    </svg>
                                </div>
                                <h2 class="text-lg font-bold text-base-content">Assignment</h2>
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <label class="text-sm font-medium text-base-content/70 mb-2 block">Assigned
                                        Team</label>
                                    @if ($ticket->assignedTeam)
                                        <div class="flex items-center gap-2 p-3 bg-base-200 rounded-lg">
                                            <div class="w-6 h-6 bg-neutral rounded-full flex items-center justify-center">
                                                <span
                                                    class="text-neutral-content text-xs font-bold">{{ substr($ticket->assignedTeam->name, 0, 1) }}</span>
                                            </div>
                                            <span
                                                class="font-medium text-base-content">{{ $ticket->assignedTeam->name }}</span>
                                        </div>
                                    @else
                                        <div
                                            class="flex items-center gap-2 p-3 bg-base-200 rounded-lg text-base-content/50">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728">
                                                </path>
                                            </svg>
                                            <span>Not assigned</span>
                                        </div>
                                    @endif
                                </div>

                                <button onclick="showAssignModal()"
                                    class="w-full px-4 py-3 bg-neutral hover:bg-neutral-focus text-neutral-content rounded-lg font-medium transition-colors flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                        </path>
                                    </svg>
                                    Assign Team
                                </button>
                            </div>
                        </div>
                    @endif

                    <!-- Timeline -->
                    <div class="bg-base-100 rounded-lg shadow-sm border border-base-300 p-4 sm:p-6">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="p-2 bg-base-200 rounded-lg">
                                <svg class="w-5 h-5 text-base-content" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h2 class="text-lg font-bold text-base-content">Timeline</h2>
                        </div>

                        <div class="space-y-4">
                            <div class="flex items-start gap-3">
                                <div
                                    class="w-8 h-8 bg-neutral rounded-full flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-base-content">Created</p>
                                    <p class="text-sm text-base-content/70">
                                        {{ $ticket->created_at->format('M d, Y, g:i A') }}</p>
                                </div>
                            </div>

                            @if ($ticket->assigned_at)
                                <div class="flex items-start gap-3">
                                    <div
                                        class="w-8 h-8 bg-info rounded-full flex items-center justify-center flex-shrink-0">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-medium text-base-content">Assigned</p>
                                        <p class="text-sm text-base-content/70">
                                            {{ \Carbon\Carbon::parse($ticket->assigned_at)->format('M d, Y, g:i A') }}</p>
                                    </div>
                                </div>
                            @endif

                            @if ($ticket->resolved_at)
                                <div class="flex items-start gap-3">
                                    <div
                                        class="w-8 h-8 bg-success rounded-full flex items-center justify-center flex-shrink-0">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-medium text-base-content">Resolved</p>
                                        <p class="text-sm text-base-content/70">
                                            {{ \Carbon\Carbon::parse($ticket->resolved_at)->format('M d, Y, g:i A') }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if (auth()->user()->role === 'IT')
                        <!-- Quick Actions -->
                        <div class="bg-base-100 rounded-lg shadow-sm border border-base-300 p-4 sm:p-6">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="p-2 bg-base-200 rounded-lg">
                                    <svg class="w-5 h-5 text-base-content" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                                <h2 class="text-lg font-bold text-base-content">Quick Actions</h2>
                            </div>

                            <div class="space-y-3">
                                @if ($ticket->status === 'open')
                                    <form action="{{ route('tickets.update', $ticket->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="in_progress">
                                        <input type="hidden" name="requester_name"
                                            value="{{ $ticket->requester_name }}">
                                        <input type="hidden" name="problem_detail"
                                            value="{{ $ticket->problem_detail }}">
                                        <input type="hidden" name="definition_of_done"
                                            value="{{ $ticket->definition_of_done }}">
                                        <button type="submit"
                                            class="w-full px-4 py-3 bg-info hover:bg-info-focus text-info-content rounded-lg font-medium transition-colors flex items-center justify-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h8m-9-4V8a3 3 0 013-3h4a3 3 0 013 3v2M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            Start Progress
                                        </button>
                                    </form>
                                @elseif($ticket->status === 'in_progress')
                                    <form action="{{ route('tickets.update', $ticket->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="resolved">
                                        <input type="hidden" name="requester_name"
                                            value="{{ $ticket->requester_name }}">
                                        <input type="hidden" name="problem_detail"
                                            value="{{ $ticket->problem_detail }}">
                                        <input type="hidden" name="definition_of_done"
                                            value="{{ $ticket->definition_of_done }}">
                                        <button type="submit"
                                            class="w-full px-4 py-3 bg-success hover:bg-success-focus text-success-content rounded-lg font-medium transition-colors flex items-center justify-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            Mark Resolved
                                        </button>
                                    </form>
                                @elseif($ticket->status === 'resolved')
                                    <form action="{{ route('tickets.update', $ticket->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="closed">
                                        <input type="hidden" name="requester_name"
                                            value="{{ $ticket->requester_name }}">
                                        <input type="hidden" name="problem_detail"
                                            value="{{ $ticket->problem_detail }}">
                                        <input type="hidden" name="definition_of_done"
                                            value="{{ $ticket->definition_of_done }}">
                                        <button type="submit"
                                            class="w-full px-4 py-3 bg-neutral hover:bg-neutral-focus text-neutral-content rounded-lg font-medium transition-colors flex items-center justify-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                                </path>
                                            </svg>
                                            Close Ticket
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if (auth()->user()->role === 'IT')
        <!-- Assignment Modal -->
        <div id="assignModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50"
            onclick="hideAssignModal()">
            <div class="bg-base-100 rounded-lg shadow-2xl max-w-md w-full mx-4 p-6" onclick="event.stopPropagation()">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-base-content">Assign Team</h3>
                    <button onclick="hideAssignModal()" class="p-2 hover:bg-base-200 rounded-lg transition-colors">
                        <svg class="w-5 h-5 text-base-content/50" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form action="{{ route('tickets.assign', $ticket->id) }}" method="POST">
                    @csrf
                    <div class="mb-6">
                        <label for="assigned_to" class="block text-sm font-medium text-base-content/70 mb-2">Select
                            Team</label>
                        <select name="assigned_to" id="assigned_to" required
                            class="w-full px-4 py-3 border border-base-300 bg-base-100 text-base-content rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors">
                            <option value="">Choose a team...</option>
                            @foreach ($teams as $team)
                                <option value="{{ $team->id }}"
                                    {{ $ticket->assigned_to == $team->id ? 'selected' : '' }}>
                                    {{ $team->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex gap-3">
                        <button type="button" onclick="hideAssignModal()"
                            class="flex-1 px-4 py-3 border border-base-300 text-base-content rounded-lg font-medium hover:bg-base-200 transition-colors">
                            Cancel
                        </button>
                        <button type="submit"
                            class="flex-1 px-4 py-3 bg-neutral hover:bg-neutral-focus text-neutral-content rounded-lg font-medium transition-colors">
                            Assign
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <script>
        function showAssignModal() {
            document.getElementById('assignModal').classList.remove('hidden');
            document.getElementById('assignModal').classList.add('flex');
        }

        function hideAssignModal() {
            document.getElementById('assignModal').classList.add('hidden');
            document.getElementById('assignModal').classList.remove('flex');
        }
    </script>
@endsection
