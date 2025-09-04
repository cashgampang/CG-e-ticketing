@extends('layouts.app')

@section('title', 'Edit Ticket #' . $ticket->id)

@section('content')
    <div x-data="editTicket()" x-init="init()">
        <!-- Header -->
        <div class="flex items-center gap-4 mb-6">
            <a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-ghost btn-circle">
                <i class="fas fa-arrow-left text-xl"></i>
            </a>
            <div>
                <h1 class="text-3xl font-bold text-base-content">
                    <i class="fas fa-edit mr-3"></i>Edit Ticket #{{ $ticket->id }}
                </h1>
                <p class="text-base-content/70 mt-1">Update ticket information and status</p>
            </div>
        </div>

        <!-- Form Card -->
        <div class="max-w-4xl mx-auto">
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <form @submit.prevent="submitForm()" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Status and Assignment Row -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Status -->
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text font-semibold">
                                        <i class="fas fa-flag mr-2"></i>Status
                                    </span>
                                </label>
                                <select name="status" x-model="form.status" class="select select-bordered"
                                    :class="{ 'select-error': errors.status }" required>
                                    <option value="open">Open</option>
                                    <option value="in_progress">In Progress</option>
                                    <option value="resolved">Resolved</option>
                                    <option value="closed">Closed</option>
                                </select>
                                <div x-show="errors.status" class="label">
                                    <span class="label-text-alt text-error" x-text="errors.status"></span>
                                </div>
                            </div>

                            <!-- Assignment -->
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text font-semibold">
                                        <i class="fas fa-users mr-2"></i>Assigned To
                                    </span>
                                </label>
                                <select name="assigned_to" x-model="form.assigned_to" class="select select-bordered"
                                    :class="{ 'select-error': errors.assigned_to }">
                                    <option value="">Unassigned</option>
                                    <template x-for="team in teams" :key="team.id">
                                        <option :value="team.id" x-text="team.name"></option>
                                    </template>
                                </select>
                                <div x-show="errors.assigned_to" class="label">
                                    <span class="label-text-alt text-error" x-text="errors.assigned_to"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Requester Name -->
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-semibold">
                                    <i class="fas fa-user mr-2"></i>Requester Name
                                </span>
                                <span class="label-text-alt text-error">Required</span>
                            </label>
                            <input type="text" name="requester_name" x-model="form.requester_name"
                                placeholder="Enter requester's full name" class="input input-bordered"
                                :class="{ 'input-error': errors.requester_name }" required maxlength="100" />
                            <div x-show="errors.requester_name" class="label">
                                <span class="label-text-alt text-error" x-text="errors.requester_name"></span>
                            </div>
                        </div>

                        <!-- Problem Detail -->
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-semibold">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>Problem Detail
                                </span>
                                <span class="label-text-alt text-error">Required</span>
                            </label>
                            <textarea name="problem_detail" x-model="form.problem_detail" class="textarea textarea-bordered h-32"
                                :class="{ 'textarea-error': errors.problem_detail }" placeholder="Describe the problem in detail..." required></textarea>
                            <div class="label">
                                <span class="label-text-alt" x-text="`${form.problem_detail.length} characters`"></span>
                                <span x-show="errors.problem_detail" class="label-text-alt text-error"
                                    x-text="errors.problem_detail"></span>
                            </div>
                        </div>

                        <!-- Definition of Done -->
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-semibold">
                                    <i class="fas fa-check-square mr-2"></i>Definition of Done
                                </span>
                                <span class="label-text-alt text-error">Required</span>
                            </label>
                            <textarea name="definition_of_done" x-model="form.definition_of_done" class="textarea textarea-bordered h-32"
                                :class="{ 'textarea-error': errors.definition_of_done }"
                                placeholder="Describe what needs to be accomplished to resolve this issue..." required></textarea>
                            <div class="label">
                                <span class="label-text-alt" x-text="`${form.definition_of_done.length} characters`"></span>
                                <span x-show="errors.definition_of_done" class="label-text-alt text-error"
                                    x-text="errors.definition_of_done"></span>
                            </div>
                        </div>

                        <!-- Changes Summary -->
                        <div x-show="hasChanges" x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            class="card bg-warning/10 border border-warning/20">
                            <div class="card-body">
                                <h3 class="card-title text-warning">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>Changes Detected
                                </h3>
                                <div class="text-sm space-y-2">
                                    <div x-show="changes.status" class="flex justify-between">
                                        <span>Status:</span>
                                        <span>
                                            <span class="text-base-content/50" x-text="originalData.status"></span>
                                            <i class="fas fa-arrow-right mx-2"></i>
                                            <span class="font-semibold" x-text="form.status"></span>
                                        </span>
                                    </div>
                                    <div x-show="changes.assigned_to" class="flex justify-between">
                                        <span>Assignment:</span>
                                        <span>
                                            <span class="text-base-content/50"
                                                x-text="getTeamName(originalData.assigned_to) || 'Unassigned'"></span>
                                            <i class="fas fa-arrow-right mx-2"></i>
                                            <span class="font-semibold"
                                                x-text="getTeamName(form.assigned_to) || 'Unassigned'"></span>
                                        </span>
                                    </div>
                                    <div x-show="changes.requester_name" class="flex justify-between">
                                        <span>Requester:</span>
                                        <span class="font-semibold" x-text="form.requester_name"></span>
                                    </div>
                                    <div x-show="changes.problem_detail || changes.definition_of_done">
                                        <span class="font-semibold">Content has been modified</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex flex-col sm:flex-row gap-4 justify-end">
                            <a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-ghost">
                                <i class="fas fa-times mr-2"></i>Cancel
                            </a>
                            <button type="button" @click="resetForm()" class="btn btn-outline" :disabled="!hasChanges">
                                <i class="fas fa-undo mr-2"></i>Reset Changes
                            </button>
                            <button type="submit" class="btn btn-primary" :disabled="loading || !hasChanges">
                                <span x-show="!loading" class="flex items-center">
                                    <i class="fas fa-save mr-2"></i>Save Changes
                                </span>
                                <span x-show="loading" class="flex items-center">
                                    <span class="loading loading-spinner loading-sm mr-2"></span>Saving...
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Confirmation Modal -->
        <div class="modal" :class="{ 'modal-open': showConfirmModal }">
            <div class="modal-box">
                <h3 class="font-bold text-lg">Confirm Changes</h3>
                <div class="py-4">
                    <p class="mb-4">You are about to make the following changes:</p>
                    <div class="bg-base-200 p-4 rounded-lg space-y-2 text-sm">
                        <div x-show="changes.status" class="flex justify-between">
                            <span>Status:</span>
                            <span>
                                <span class="text-base-content/50" x-text="originalData.status"></span>
                                <i class="fas fa-arrow-right mx-2"></i>
                                <span class="font-semibold" x-text="form.status"></span>
                            </span>
                        </div>
                        <div x-show="changes.assigned_to" class="flex justify-between">
                            <span>Assignment:</span>
                            <span>
                                <span class="text-base-content/50"
                                    x-text="getTeamName(originalData.assigned_to) || 'Unassigned'"></span>
                                <i class="fas fa-arrow-right mx-2"></i>
                                <span class="font-semibold" x-text="getTeamName(form.assigned_to) || 'Unassigned'"></span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="modal-action">
                    <button @click="showConfirmModal = false" class="btn">Cancel</button>
                    <button @click="confirmSubmit()" class="btn btn-primary">Confirm</button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function editTicket() {
                return {
                    loading: false,
                    showConfirmModal: false,
                    teams: @json($teams),
                    originalData: {},
                    form: {
                        requester_name: '',
                        problem_detail: '',
                        definition_of_done: '',
                        status: 'open',
                        assigned_to: ''
                    },
                    errors: {},

                    init() {
                        const ticket = @json($ticket);
                        this.originalData = {
                            requester_name: ticket.requester_name,
                            problem_detail: ticket.problem_detail,
                            definition_of_done: ticket.definition_of_done,
                            status: ticket.status,
                            assigned_to: ticket.assigned_to || ''
                        };

                        // Copy original data to form
                        Object.assign(this.form, this.originalData);
                    },

                    get hasChanges() {
                        return Object.keys(this.form).some(key =>
                            this.form[key] !== this.originalData[key]
                        );
                    },

                    get changes() {
                        const changes = {};
                        Object.keys(this.form).forEach(key => {
                            if (this.form[key] !== this.originalData[key]) {
                                changes[key] = true;
                            }
                        });
                        return changes;
                    },

                    getTeamName(teamId) {
                        if (!teamId) return null;
                        const team = this.teams.find(t => t.id == teamId);
                        return team ? team.name : null;
                    },

                    resetForm() {
                        Object.assign(this.form, this.originalData);
                        this.errors = {};
                    },

                    async submitForm() {
                        // Show confirmation if status or assignment is changing
                        if (this.changes.status || this.changes.assigned_to) {
                            this.showConfirmModal = true;
                            return;
                        }

                        await this.performSubmit();
                    },

                    async confirmSubmit() {
                        this.showConfirmModal = false;
                        await this.performSubmit();
                    },

                    async performSubmit() {
                        this.loading = true;
                        this.errors = {};

                        try {
                            const formData = new FormData();
                            formData.append('_token', window.csrfToken);
                            formData.append('_method', 'PUT');

                            Object.keys(this.form).forEach(key => {
                                if (this.form[key] !== null && this.form[key] !== undefined) {
                                    formData.append(key, this.form[key]);
                                }
                            });

                            const response = await fetch(`/tickets/{{ $ticket->id }}`, {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'Accept': 'application/json'
                                }
                            });

                            if (response.ok) {
                                window.location.href = `/tickets/{{ $ticket->id }}`;
                            } else {
                                const data = await response.json();
                                if (data.errors) {
                                    this.errors = data.errors;
                                } else {
                                    this.$parent.showAlert('error', data.message || 'Failed to update ticket');
                                }
                            }
                        } catch (error) {
                            this.$parent.showAlert('error', 'An error occurred while updating the ticket');
                        }

                        this.loading = false;
                    },

                    clearErrors(field) {
                        if (this.errors[field]) {
                            delete this.errors[field];
                        }
                    }
                }
            }
        </script>
    @endpush
@endsection
