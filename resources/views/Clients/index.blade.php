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
            <p class="text-base-content/70 mt-1">Manage all support tickets</p>
        </div>
        
        <div class="flex flex-col sm:flex-row gap-3">
            <!-- Filter Dropdown -->
            <div class="dropdown dropdown-end">
                <div tabindex="0" role="button" class="btn btn-outline">
                    <i class="fas fa-filter mr-2"></i>
                    <span x-text="filterText"></span>
                    <i class="fas fa-chevron-down ml-2"></i>
                </div>
                <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                    <li><a @click="setFilter('all')"><i class="fas fa-list mr-2"></i>All Tickets</a></li>
                    <li><a @click="setFilter('open')"><i class="fas fa-envelope-open mr-2"></i>Open</a></li>
                    <li><a @click="setFilter('in_progress')"><i class="fas fa-spinner mr-2"></i>In Progress</a></li>
                    <li><a @click="setFilter('resolved')"><i class="fas fa-check mr-2"></i>Resolved</a></li>
                    <li><a @click="setFilter('closed')"><i class="fas fa-times mr-2"></i>Closed</a></li>
                </ul>
            </div>
            
            <a href="{{ route('tickets.create') }}" class="btn btn-primary">
                <i class="fas fa-plus mr-2"></i>New Ticket
            </a>
        </div>
    </div>

    <!-- Loading State -->
    <div x-show="loading" class="flex justify-center items-center py-12">
        <span class="loading loading-spinner loading-lg"></span>
    </div>

    <!-- Stats Cards -->
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
            <div class="stat-title">In Progress</div>
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

    <!-- Tickets Table -->
    <div class="card bg-base-100 shadow-xl">
        <div class="card-body p-0">
            <div class="overflow-x-auto">
                <table class="table table-zebra">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Requester</th>
                            <th>Problem</th>
                            <th>Status</th>
                            <th>Assigned To</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-for="ticket in filteredTickets" :key="ticket.id">
                            <tr>
                                <td>
                                    <div class="font-mono font-bold" x-text="'#' + ticket.id"></div>
                                </td>
                                <td>
                                    <div class="font-semibold" x-text="ticket.requester_name"></div>
                                </td>
                                <td>
                                    <div class="max-w-xs">
                                        <p class="truncate" x-text="ticket.problem_detail"></p>
                                    </div>
                                </td>
                                <td>
                                    <div class="badge" 
                                         :class="{
                                             'badge-error': ticket.status === 'open',
                                             'badge-warning': ticket.status === 'in_progress', 
                                             'badge-success': ticket.status === 'resolved',
                                             'badge-neutral': ticket.status === 'closed'
                                         }"
                                         x-text="ticket.status.replace('_', ' ').toUpperCase()">
                                    </div>
                                </td>
                                <td>
                                    <span x-show="ticket.assigned_team" x-text="ticket.assigned_team?.name"></span>
                                    <span x-show="!ticket.assigned_team" class="text-base-content/50">Unassigned</span>
                                </td>
                                <td>
                                    <span x-text="formatDate(ticket.created_at)"></span>
                                </td>
                                <td>
                                    <div class="flex gap-2">
                                        <a :href="'/tickets/' + ticket.id" class="btn btn-sm btn-ghost">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a :href="'/tickets/' + ticket.id + '/edit'" class="btn btn-sm btn-ghost">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button @click="deleteTicket(ticket.id)" class="btn btn-sm btn-ghost text-error">
                                            <i class="fas fa-trash"></i>
                                        </button>
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

    <!-- Delete Confirmation Modal -->
    <div class="modal" :class="{ 'modal-open': showDeleteModal }">
        <div class="modal-box">
            <h3 class="font-bold text-lg">Confirm Delete</h3>
            <p class="py-4">Are you sure you want to delete this ticket? This action cannot be undone.</p>
            <div class="modal-action">
                <button @click="showDeleteModal = false" class="btn">Cancel</button>
                <button @click="confirmDelete()" class="btn btn-error">Delete</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function ticketList() {
    return {
        tickets: @json($tickets ?? []),
        loading: false,
        currentFilter: 'all',
        filterText: 'All Tickets',
        showDeleteModal: false,
        ticketToDelete: null,

        init() {
            this.calculateStats();
        },

        get filteredTickets() {
            if (this.currentFilter === 'all') {
                return this.tickets;
            }
            return this.tickets.filter(ticket => ticket.status === this.currentFilter);
        },

        get stats() {
            const stats = {
                open: 0,
                in_progress: 0,
                resolved: 0,
                closed: 0
            };
            
            this.tickets.forEach(ticket => {
                if (stats.hasOwnProperty(ticket.status)) {
                    stats[ticket.status]++;
                }
            });
            
            return stats;
        },

        setFilter(filter) {
            this.currentFilter = filter;
            this.filterText = filter === 'all' ? 'All Tickets' : 
                             filter === 'in_progress' ? 'In Progress' :
                             filter.charAt(0).toUpperCase() + filter.slice(1);
        },

        async deleteTicket(id) {
            const confirmed = await this.$parent.confirmAction(
                'Delete Ticket?',
                'Are you sure you want to delete this ticket? This action cannot be undone.',
                'Yes, delete it!'
            );

            if (!confirmed) return;

            try {
                const result = await this.$parent.makeRequest(`/tickets/${id}`, {
                    method: 'DELETE'
                });

                if (result.success) {
                    this.tickets = this.tickets.filter(t => t.id !== id);
                    this.$parent.showAlert('success', 'Ticket deleted successfully');
                } else {
                    throw new Error(result.error || 'Failed to delete ticket');
                }
            } catch (error) {
                console.error('Delete failed:', error);
                this.$parent.showAlert('error', 'Failed to delete ticket');
            }
        },

        async confirmDelete() {
            // This method is now deprecated, using SweetAlert instead
            if (!this.ticketToDelete) return;

            try {
                const result = await this.$parent.makeRequest(`/tickets/${this.ticketToDelete}`, {
                    method: 'DELETE'
                });

                if (result.success) {
                    this.tickets = this.tickets.filter(t => t.id !== this.ticketToDelete);
                    this.$parent.showAlert('success', 'Ticket deleted successfully');
                } else {
                    throw new Error(result.error || 'Failed to delete ticket');
                }
            } catch (error) {
                console.error('Delete failed:', error);
                this.$parent.showAlert('error', 'Failed to delete ticket');
            }

            this.showDeleteModal = false;
            this.ticketToDelete = null;
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