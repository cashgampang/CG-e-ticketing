@extends('layouts.app')

@section('title', 'All Tickets')

@section('content')
    <div x-data="ticketList()" x-init="init()">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <div>
                <h1 class="text-3xl font-bold text-base-content">
                    <i class="fas fa-ticket-alt mr-3"></i>Tickets
                </h1>
                <p class="text-base-content/70 mt-1">
                    @if (auth()->user()->role === 'IT')
                        Manage all support tickets
                    @else
                        Your support tickets
                    @endif
                </p>
            </div>

            <div class="flex flex-col sm:flex-row gap-3">
                <!-- Filter Dropdown - Only show for IT -->
                @if (auth()->user()->role === 'IT')
                    <div class="dropdown dropdown-end">
                        <div tabindex="0" role="button" class="btn btn-outline">
                            <i class="fas fa-filter mr-2"></i>
                            <span x-text="filterText"></span>
                            <i class="fas fa-chevron-down ml-2"></i>
                        </div>
                        <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                            <li><a @click="setFilter('all')"><i class="fas fa-list mr-2"></i>All Tickets</a></li>
                            <li><a @click="setFilter('open')"><i class="fas fa-envelope-open mr-2"></i>Open</a></li>
                            <li><a @click="setFilter('in_progress')"><i class="fas fa-spinner mr-2"></i>On Prog</a></li>
                            <li><a @click="setFilter('resolved')"><i class="fas fa-check mr-2"></i>Resolved</a></li>
                            <li><a @click="setFilter('closed')"><i class="fas fa-times mr-2"></i>Closed</a></li>
                        </ul>
                    </div>
                @endif

                <a href="{{ route('tickets.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus mr-2"></i>New Ticket
                </a>
            </div>
        </div>

        <!-- Loading State -->
        <div x-show="loading" class="flex justify-center items-center py-12">
            <span class="loading loading-spinner loading-lg"></span>
        </div>

        <!-- Stats Cards - Only show for IT -->
        @if (auth()->user()->role === 'IT')
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="stat bg-base-200 rounded-lg">
                    <div class="stat-figure text-primary">
                        <i class="fas fa-envelope-open text-2xl"></i>
                    </div>
                    <div class="stat-title">Open</div>
                    <div class="stat-value text-primary" x-text="stats.open"></div>
                </div>

                <div class="stat bg-base-200 rounded-lg">
                    <div class="stat-figure text-warning">
                        <i class="fas fa-spinner text-2xl"></i>
                    </div>
                    <div class="stat-title">Progress</div>
                    <div class="stat-value text-warning" x-text="stats.in_progress"></div>
                </div>

                <div class="stat bg-base-200 rounded-lg">
                    <div class="stat-figure text-success">
                        <i class="fas fa-check text-2xl"></i>
                    </div>
                    <div class="stat-title">Resolved</div>
                    <div class="stat-value text-success" x-text="stats.resolved"></div>
                </div>

                <div class="stat bg-base-200 rounded-lg">
                    <div class="stat-figure text-error">
                        <i class="fas fa-times text-2xl"></i>
                    </div>
                    <div class="stat-title">Closed</div>
                    <div class="stat-value text-error" x-text="stats.closed"></div>
                </div>
            </div>
        @endif

        <!-- Tickets Table -->
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body p-0">
                <div class="overflow-x-auto">
                    <table class="table table-zebra w-full">
                        <thead>
                            <tr>
                                <th class="w-16">ID</th>
                                <th class="min-w-32">Requester</th>
                                <th class="min-w-36">Problem</th>
                                <th class="w-32">Status</th>
                                @if (auth()->user()->role === 'IT')
                                    <th class="min-w-32">Assigned To</th>
                                @endif
                                <th class="w-24">Created</th>
                                <th class="min-w-48">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-for="ticket in filteredTickets" :key="ticket.ticket_code ">
                                <tr>
                                    <td>
                                        <div class="font-mono font-bold text-sm" x-text="ticket.ticket_code"></div>
                                    </td>
                                    <td>
                                        <div class="font-semibold text-sm" x-text="ticket.requester_name"></div>
                                    </td>
                                    <td>
                                        <div class="max-w-xs">
                                            <p class="truncate text-sm" x-text="ticket.problem_detail"
                                                :title="ticket.problem_detail"></p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="badge badge-sm"
                                            :class="{
                                                'badge-error': ticket.status === 'open',
                                                'badge-warning': ticket.status === 'in_progress',
                                                'badge-success': ticket.status === 'resolved',
                                                'badge-neutral': ticket.status === 'closed'
                                            }"
                                            x-text="ticket.status.replace('_', ' ').toUpperCase()">
                                        </div>
                                    </td>
                                    @if (auth()->user()->role === 'IT')
                                        <td>
                                            <!-- Fixed assignment display and functionality -->
                                            <div x-show="ticket.assigned_team" class="text-sm"
                                                x-text="ticket.assigned_team?.name"></div>
                                            <div x-show="!ticket.assigned_team">
                                                <p><i><b>Unassigned</b></i></p>
                                            </div>
                                        </td>
                                    @endif
                                    <td>
                                        <span class="text-sm" x-text="formatDate(ticket.created_at)"></span>
                                    </td>
                                    <td>
                                        <!-- Replaced gear dropdown with contextual action buttons -->
                                        <div class="flex flex-wrap gap-1">
                                            <!-- View button - available for all users -->
                                            <a :href="'/tickets/' + ticket.id" class="btn btn-xs btn-ghost" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <!-- Edit button - only for ticket owner or IT -->
                                            <template
                                                x-if="ticket.user_id === {{ auth()->id() }} || '{{ auth()->user()->role }}' === 'IT'">
                                                <a :href="'/tickets/' + ticket.id + '/edit'" class="btn btn-xs btn-ghost"
                                                    title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </template>

                                            <!-- Contextual status buttons for IT -->
                                            @if (auth()->user()->role === 'IT')
                                                <template x-if="ticket.status === 'open'">
                                                    <div class="flex gap-1">
                                                        <button @click="updateStatus(ticket.id, 'in_progress')"
                                                            class="btn btn-xs btn-success" title="Start Progress">
                                                            <i class="fas fa-play mr-1"></i>Start
                                                        </button>
                                                        <button @click="updateStatus(ticket.id, 'closed')"
                                                            class="btn btn-xs btn-error" title="Cancel">
                                                            <i class="fas fa-times mr-1"></i>Cancel
                                                        </button>
                                                    </div>
                                                </template>

                                                <template x-if="ticket.status === 'in_progress'">
                                                    <div class="flex gap-1">
                                                        <button @click="updateStatus(ticket.id, 'resolved')"
                                                            class="btn btn-xs btn-success" title="Mark as Resolved">
                                                            <i class="fas fa-check mr-1"></i>Resolve
                                                        </button>
                                                        <button @click="updateStatus(ticket.id, 'closed')"
                                                            class="btn btn-xs btn-error" title="Cancel">
                                                            <i class="fas fa-times mr-1"></i>Cancel
                                                        </button>
                                                    </div>
                                                </template>

                                                <!-- Delete button - only for IT -->
                                                <button @click="deleteTicket(ticket.id)"
                                                    class="btn btn-xs btn-ghost text-error" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>

                    <div x-show="filteredTickets.length === 0 && !loading" class="text-center py-12">
                        <i class="fas fa-inbox text-6xl text-base-content/30 mb-4"></i>
                        <p class="text-xl text-base-content/70">No tickets found</p>
                        <a href="{{ route('tickets.create') }}" class="btn btn-primary mt-4">
                            <i class="fas fa-plus mr-2"></i>Create First Ticket
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Added assignment modal for better UX -->
        @if (auth()->user()->role === 'IT')
            <div x-show="showAssignModalFlag" class="modal modal-open" x-cloak>
                <div class="modal-box">
                    <h3 class="font-bold text-lg">Assign Team</h3>
                    <p class="py-4">Select a team to assign this ticket to:</p>

                    <div class="space-y-2">
                        <template x-for="team in teams" :key="team.id">
                            <button @click="assignTeam(selectedTicketId, team.id, team.name)"
                                class="btn btn-outline w-full justify-start" x-text="team.name">
                            </button>
                        </template>
                    </div>

                    <div class="modal-action">
                        <button @click="showAssignModalFlag = false" class="btn">Cancel</button>
                    </div>
                </div>
            </div>
        @endif
    </div>

    @push('scripts')
        <script>
            function ticketList() {
                return {
                    tickets: @json($tickets ?? []),
                    teams: @json($teams ?? []),
                    loading: false,
                    currentFilter: 'all',
                    filterText: 'All Tickets',
                    userRole: '{{ auth()->user()->role }}',
                    showAssignModalFlag: false,
                    selectedTicketId: null,

                    init() {
                        this.calculateStats();
                    },

                    get filteredTickets() {
                        let filtered = this.tickets;

                        if (this.userRole !== 'IT') {
                            filtered = filtered.filter(ticket => ticket.user_id === {{ auth()->id() }});
                        }

                        if (this.currentFilter === 'all') {
                            return filtered;
                        }
                        return filtered.filter(ticket => ticket.status === this.currentFilter);
                    },

                    get stats() {
                        const stats = {
                            open: 0,
                            in_progress: 0,
                            resolved: 0,
                            closed: 0
                        };

                        this.filteredTickets.forEach(ticket => {
                            if (stats.hasOwnProperty(ticket.status)) {
                                stats[ticket.status]++;
                            }
                        });

                        return stats;
                    },

                    setFilter(filter) {
                        this.currentFilter = filter;
                        this.filterText = filter === 'all' ? 'All Tickets' :
                            filter === 'in_progress' ? 'On Prog' :
                            filter.charAt(0).toUpperCase() + filter.slice(1);
                    },

                    showAssignModal(ticketId) {
                        this.selectedTicketId = ticketId;
                        this.showAssignModalFlag = true;
                    },

                    async assignTeam(ticketId, teamId, teamName) {
                        try {
                            const response = await fetch(`/teams`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': window.csrfToken,
                                    'Accept': 'application/json'
                                },
                                body: JSON.stringify({
                                    team_id: teamId
                                })
                            });

                            const result = await response.json();

                            if (result.success) {
                                // Update local ticket data
                                const ticket = this.tickets.find(t => t.id === ticketId);
                                if (ticket) {
                                    ticket.assigned_team = {
                                        id: teamId,
                                        name: teamName
                                    };
                                    ticket.team_id = teamId;
                                }
                                this.showAssignModalFlag = false;
                                this.showAlert('success', `Ticket assigned to ${teamName}`);
                            } else {
                                throw new Error(result.message || 'Failed to assign team');
                            }
                        } catch (error) {
                            console.error('Assignment failed:', error);
                            this.showAlert('error', 'Failed to assign team');
                        }
                    },

                    async updateStatus(ticketId, status) {
                        try {
                            const response = await fetch(`/tickets/${ticketId}`, {
                                method: 'PUT',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': window.csrfToken,
                                    'Accept': 'application/json'
                                },
                                body: JSON.stringify({
                                    status: status
                                })
                            });

                            const result = await response.json();

                            if (result.success) {
                                // Update local ticket data
                                const ticket = this.tickets.find(t => t.id === ticketId);
                                if (ticket) {
                                    ticket.status = status;
                                }
                                this.showAlert('success', `Ticket status updated to ${status.replace('_', ' ')}`);
                            } else {
                                throw new Error(result.message || 'Failed to update status');
                            }
                        } catch (error) {
                            console.error('Status update failed:', error);
                            this.showAlert('error', 'Failed to update status');
                        }
                    },

                    async deleteTicket(id) {
                        const confirmed = confirm(
                            'Are you sure you want to delete this ticket? This action cannot be undone.');

                        if (!confirmed) return;

                        try {
                            const response = await fetch(`/tickets/${id}`, {
                                method: 'DELETE',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': window.csrfToken,
                                    'Accept': 'application/json'
                                }
                            });

                            const result = await response.json();

                            if (result.success) {
                                this.tickets = this.tickets.filter(t => t.id !== id);
                                this.showAlert('success', 'Ticket deleted successfully');
                            } else {
                                throw new Error(result.message || 'Failed to delete ticket');
                            }
                        } catch (error) {
                            console.error('Delete failed:', error);
                            this.showAlert('error', 'Failed to delete ticket');
                        }
                    },

                    showAlert(type, message) {
                        if (window.app && window.app.showAlert) {
                            window.app.showAlert(type, message);
                        } else {
                            alert(message);
                        }
                    },

                    formatDate(dateString) {
                        return new Date(dateString).toLocaleDateString('en-US', {
                            year: 'numeric',
                            month: 'short',
                            day: 'numeric'
                        });
                    }
                }
            }
        </script>
    @endpush
@endsection
