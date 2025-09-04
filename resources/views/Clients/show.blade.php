@extends('layouts.app')

@section('title', 'Ticket #' . $ticket->id)

@section('content')
    <div x-data="ticketDetails()" x-init="init()">
        <!-- Header -->
        <div class="flex flex-col lg:flex-row justify-between items-start gap-4 mb-6">
            <div class="flex items-center gap-4">
                <a href="{{ route('tickets.index') }}" class="btn btn-ghost btn-circle">
                    <i class="fas fa-arrow-left text-xl"></i>
                </a>
                <div>
                    <div class="flex items-center gap-3">
                        <h1 class="text-3xl font-bold text-base-content">
                            Ticket #{{ $ticket->id }}
                        </h1>
                        <div class="badge badge-lg"
                            :class="{
                                'badge-error': ticket.status === 'open',
                                'badge-warning': ticket.status === 'in_progress',
                                'badge-success': ticket.status === 'resolved',
                                'badge-neutral': ticket.status === 'closed'
                            }">
                            <span x-text="ticket.status.replace('_', ' ').toUpperCase()"></span>
                        </div>
                    </div>
                    <p class="text-base-content/70 mt-1">Created on {{ $ticket->created_at->format('M d, Y') }}</p>
                </div>
            </div>

            <div class="flex flex-wrap gap-2">
                <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-outline">
                    <i class="fas fa-edit mr-2"></i>Edit
                </a>
                <button @click="showAssignModal = true" class="btn btn-outline btn-primary">
                    <i class="fas fa-user-plus mr-2"></i>
                    <span x-text="ticket.assigned_team ? 'Reassign' : 'Assign'"></span>
                </button>
                <button @click="showDeleteModal = true" class="btn btn-outline btn-error">
                    <i class="fas fa-trash mr-2"></i>Delete
                </button>
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
            <!-- Ticket Details -->
            <div class="xl:col-span-2 space-y-6">
                <!-- Basic Info Card -->
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <h2 class="card-title text-xl mb-4">
                            <i class="fas fa-info-circle mr-2"></i>Ticket Information
                        </h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="text-sm font-semibold text-base-content/70">Requester</label>
                                <div class="mt-1 p-3 bg-base-200 rounded-lg">
                                    <div class="flex items-center">
                                        <i class="fas fa-user mr-2"></i>
                                        <span class="font-medium" x-text="ticket.requester_name"></span>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="text-sm font-semibold text-base-content/70">Status</label>
                                <div class="mt-1 p-3 bg-base-200 rounded-lg">
                                    <div class="flex items-center">
                                        <i class="fas fa-flag mr-2"></i>
                                        <span x-text="ticket.status.replace('_', ' ').toUpperCase()"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Problem Detail Card -->
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <h2 class="card-title text-xl mb-4">
                            <i class="fas fa-exclamation-triangle mr-2 text-warning"></i>Problem Description
                        </h2>
                        <div class="prose max-w-none">
                            <p x-text="ticket.problem_detail" class="text-base-content whitespace-pre-wrap"></p>
                        </div>
                    </div>
                </div>

                <!-- Definition of Done Card -->
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <h2 class="card-title text-xl mb-4">
                            <i class="fas fa-check-square mr-2 text-success"></i>Definition of Done
                        </h2>
                        <div class="prose max-w-none">
                            <p x-text="ticket.definition_of_done" class="text-base-content whitespace-pre-wrap"></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Assignment Card -->
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <h3 class="card-title text-lg">
                            <i class="fas fa-users mr-2"></i>Assignment
                        </h3>

                        <div class="space-y-4">
                            <div>
                                <label class="text-sm font-semibold text-base-content/70">Assigned Team</label>
                                <div class="mt-1">
                                    <div x-show="ticket.assigned_team"
                                        class="flex items-center p-3 bg-success/20 rounded-lg">
                                        <div class="avatar placeholder mr-3">
                                            <div class="bg-success text-success-content rounded-full w-8">
                                                <span class="text-xs" x-text="ticket.assigned_team?.name?.charAt(0)"></span>
                                            </div>
                                        </div>
                                        <span x-text="ticket.assigned_team?.name" class="font-medium"></span>
                                    </div>
                                    <div x-show="!ticket.assigned_team"
                                        class="p-3 bg-base-200 rounded-lg text-base-content/50">
                                        <i class="fas fa-user-slash mr-2"></i>Not assigned
                                    </div>
                                </div>
                            </div>

                            <button @click="showAssignModal = true" class="btn btn-primary btn-block">
                                <i class="fas fa-user-plus mr-2"></i>
                                <span x-text="ticket.assigned_team ? 'Reassign' : 'Assign Team'"></span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Timeline Card -->
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <h3 class="card-title text-lg">
                            <i class="fas fa-clock mr-2"></i>Timeline
                        </h3>

                        <div class="space-y-4">
                            <div class="flex items-center">
                                <div class="avatar placeholder mr-3">
                                    <div class="bg-primary text-primary-content rounded-full w-8">
                                        <i class="fas fa-plus text-xs"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="font-medium">Created</div>
                                    <div class="text-sm text-base-content/70" x-text="formatDateTime(ticket.created_at)">
                                    </div>
                                </div>
                            </div>

                            <div x-show="ticket.assigned_at" class="flex items-center">
                                <div class="avatar placeholder mr-3">
                                    <div class="bg-warning text-warning-content rounded-full w-8">
                                        <i class="fas fa-user text-xs"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="font-medium">Assigned</div>
                                    <div class="text-sm text-base-content/70" x-text="formatDateTime(ticket.assigned_at)">
                                    </div>
                                </div>
                            </div>

                            <div x-show="ticket.resolved_at" class="flex items-center">
                                <div class="avatar placeholder mr-3">
                                    <div class="bg-success text-success-content rounded-full w-8">
                                        <i class="fas fa-check text-xs"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="font-medium">Resolved</div>
                                    <div class="text-sm text-base-content/70" x-text="formatDateTime(ticket.resolved_at)">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions Card -->
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <h3 class="card-title text-lg">
                            <i class="fas fa-bolt mr-2"></i>Quick Actions
                        </h3>

                        <div class="space-y-2">
                            <button @click="updateStatus('in_progress')" x-show="ticket.status === 'open'"
                                class="btn btn-warning btn-block btn-sm">
                                <i class="fas fa-play mr-2"></i>Start Progress
                            </button>

                            <button @click="updateStatus('resolved')" x-show="ticket.status === 'in_progress'"
                                class="btn btn-success btn-block btn-sm">
                                <i class="fas fa-check mr-2"></i>Mark Resolved
                            </button>

                            <button @click="updateStatus('closed')" x-show="ticket.status === 'resolved'"
                                class="btn btn-neutral btn-block btn-sm">
                                <i class="fas fa-archive mr-2"></i>Close Ticket
                            </button>

                            <button @click="updateStatus('open')" x-show="ticket.status !== 'open'"
                                class="btn btn-error btn-block btn-sm">
                                <i class="fas fa-undo mr-2"></i>Reopen
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Assign Modal -->
        <div class="modal" :class="{ 'modal-open': showAssignModal }">
            <div class="modal-box">
                <h3 class="font-bold text-lg mb-4">Assign Ticket</h3>

                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Select Team Member</span>
                    </label>
                    <select x-model="selectedTeam" class="select select-bordered">
                        <option value="">Choose a team member...</option>
                        <template x-for="team in teams" :key="team.id">
                            <option :value="team.id" x-text="team.name"></option>
                        </template>
                    </select>
                </div>

                <div class="modal-action">
                    <button @click="showAssignModal = false" class="btn">Cancel</button>
                    <button @click="assignTicket()" :disabled="!selectedTeam || assigning" class="btn btn-primary">
                        <span x-show="!assigning">Assign</span>
                        <span x-show="assigning" class="loading loading-spinner loading-sm"></span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Delete Modal -->
        <div class="modal" :class="{ 'modal-open': showDeleteModal }">
            <div class="modal-box">
                <h3 class="font-bold text-lg">Delete Ticket</h3>
                <p class="py-4">Are you sure you want to delete this ticket? This action cannot be undone.</p>
                <div class="modal-action">
                    <button @click="showDeleteModal = false" class="btn">Cancel</button>
                    <button @click="deleteTicket()" class="btn btn-error">Delete</button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function ticketDetails() {
                return {
                    ticket: @json($ticket),
                    teams: @json($teams),
                    showAssignModal: false,
                    showDeleteModal: false,
                    selectedTeam: '',
                    assigning: false,

                    init() {
                        this.selectedTeam = this.ticket.assigned_to || '';
                    },

                    async assignTicket() {
                        if (!this.selectedTeam) return;

                        this.assigning = true;
                        try {
                            const result = await this.$parent.makeRequest(`/tickets/${this.ticket.id}/assign`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({
                                    assigned_to: this.selectedTeam
                                })
                            });

                            if (result.success) {
                                this.ticket = result.data.data;
                                this.showAssignModal = false;
                                this.$parent.showAlert('success', 'Ticket assigned successfully');

                                // Force re-render
                                this.$nextTick(() => {
                                    console.log('Ticket updated:', this.ticket);
                                });
                            } else {
                                throw new Error(result.error || 'Failed to assign ticket');
                            }
                        } catch (error) {
                            console.error('Assignment failed:', error);
                            this.$parent.showAlert('error', 'Failed to assign ticket');
                        }
                        this.assigning = false;
                    },

                    async updateStatus(status) {
                        const confirmed = await this.$parent.confirmAction(
                            'Update Status?',
                            `Are you sure you want to change status to "${status.replace('_', ' ').toUpperCase()}"?`,
                            'Yes, update it!'
                        );

                        if (!confirmed) return;

                        try {
                            const result = await this.$parent.makeRequest(`/tickets/${this.ticket.id}`, {
                                method: 'PUT',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({
                                    status: status,
                                    requester_name: this.ticket.requester_name,
                                    problem_detail: this.ticket.problem_detail,
                                    definition_of_done: this.ticket.definition_of_done,
                                    assigned_to: this.ticket.assigned_to
                                })
                            });

                            if (result.success) {
                                this.ticket = result.data.data;
                                this.$parent.showAlert('success', 'Status updated successfully');

                                // Force re-render
                                this.$nextTick(() => {
                                    console.log('Status updated:', this.ticket.status);
                                });
                            } else {
                                throw new Error(result.error || 'Failed to update status');
                            }
                        } catch (error) {
                            console.error('Status update failed:', error);
                            this.$parent.showAlert('error', 'Failed to update status');
                        }
                    },

                    async deleteTicket() {
                        const confirmed = await this.$parent.confirmAction(
                            'Delete Ticket?',
                            'Are you sure you want to delete this ticket? This action cannot be undone.',
                            'Yes, delete it!'
                        );

                        if (!confirmed) return;

                        try {
                            const result = await this.$parent.makeRequest(`/tickets/${this.ticket.id}`, {
                                method: 'DELETE'
                            });

                            if (result.success) {
                                window.Toast.fire({
                                    icon: 'success',
                                    title: 'Ticket deleted successfully!'
                                });

                                setTimeout(() => {
                                    window.location.href = '/tickets';
                                }, 1500);
                            } else {
                                throw new Error(result.error || 'Failed to delete ticket');
                            }
                        } catch (error) {
                            console.error('Delete failed:', error);
                            this.$parent.showAlert('error', 'Failed to delete ticket');
                            this.showDeleteModal = false;
                        }
                    },

                    formatDateTime(dateString) {
                        if (!dateString) return '';
                        return new Date(dateString).toLocaleString('en-US', {
                            year: 'numeric',
                            month: 'short',
                            day: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit'
                        });
                    }
                }
            }
        </script>
    @endpush
@endsection
