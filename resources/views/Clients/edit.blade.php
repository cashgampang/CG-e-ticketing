@extends('layouts.app')

@section('title', 'Edit Ticket #' . $ticket->id)

@section('content')
    <div x-data="editTicket()" x-init="init()" class="min-h-screen bg-base-200 py-4 sm:py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="flex items-center gap-4 mb-6">
                <a href="{{ route('tickets.show', $ticket->id) }}"
                    class="p-2 rounded-lg bg-base-300 hover:bg-base-content/20 transition-colors">
                    <svg class="w-5 h-5 text-base-content" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-base-content">
                        Edit Ticket #{{ $ticket->id }}
                    </h1>
                    <p class="text-base-content/70 mt-1">Update ticket information and status</p>
                </div>
            </div>

            <!-- Form Card -->
            <div class="bg-base-100 rounded-lg shadow-sm border border-base-300">
                <div class="p-4 sm:p-6">
                    <form @submit.prevent="submitForm()" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Added role-based conditional rendering for assignment section -->
                        @if (auth()->user()->role === 'IT')
                            <!-- Status and Assignment Row -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Status -->
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-base-content/70">
                                        Status
                                    </label>
                                    <select name="status" x-model="form.status"
                                        class="w-full px-4 py-3 border border-base-300 bg-base-100 text-base-content rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors"
                                        :class="{ 'border-error focus:ring-error focus:border-error': errors.status }"
                                        required>
                                        <option value="open">Open</option>
                                        <option value="in_progress">In Progress</option>
                                        <option value="resolved">Resolved</option>
                                        <option value="closed">Closed</option>
                                    </select>
                                    <div x-show="errors.status" class="text-sm text-error" x-text="errors.status"></div>
                                </div>

                                <!-- Assignment -->
                                <div class="space-y-2">
                                    <label class="block text-sm font-medium text-base-content/70">
                                        Assigned To
                                    </label>
                                    <select name="assigned_to" x-model="form.assigned_to"
                                        class="w-full px-4 py-3 border border-base-300 bg-base-100 text-base-content rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors"
                                        :class="{ 'border-error focus:ring-error focus:border-error': errors.assigned_to }">
                                        <option value="">Unassigned</option>
                                        <template x-for="team in teams" :key="team.id">
                                            <option :value="team.id" x-text="team.name"></option>
                                        </template>
                                    </select>
                                    <div x-show="errors.assigned_to" class="text-sm text-error" x-text="errors.assigned_to">
                                    </div>
                                </div>
                            </div>
                        @else
                            <!-- Status Only for Regular Users -->
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-base-content/70">
                                    Status
                                </label>
                                <select name="status" x-model="form.status"
                                    class="w-full px-4 py-3 border border-base-300 bg-base-200 text-base-content/50 rounded-lg transition-colors"
                                    disabled>
                                    <option value="open">Open</option>
                                    <option value="in_progress">In Progress</option>
                                    <option value="resolved">Resolved</option>
                                    <option value="closed">Closed</option>
                                </select>
                                <p class="text-sm text-base-content/50">Status can only be changed by IT staff</p>
                            </div>
                        @endif

                        <!-- Requester Name -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-base-content/70">
                                Requester Name
                                <span class="text-error">*</span>
                            </label>
                            <input type="text" name="requester_name" x-model="form.requester_name"
                                placeholder="Enter requester's full name"
                                class="w-full px-4 py-3 border border-base-300 bg-base-100 text-base-content rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors"
                                :class="{ 'border-error focus:ring-error focus:border-error': errors.requester_name }"
                                required maxlength="100" />
                            <div x-show="errors.requester_name" class="text-sm text-error" x-text="errors.requester_name">
                            </div>
                        </div>

                        <!-- Problem Detail -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-base-content/70">
                                Problem Detail
                                <span class="text-error">*</span>
                            </label>
                            <textarea name="problem_detail" x-model="form.problem_detail"
                                class="w-full px-4 py-3 border border-base-300 bg-base-100 text-base-content rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors h-32 resize-none"
                                :class="{ 'border-error focus:ring-error focus:border-error': errors.problem_detail }"
                                placeholder="Describe the problem in detail..." required></textarea>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-base-content/50"
                                    x-text="`${form.problem_detail.length} characters`"></span>
                                <div x-show="errors.problem_detail" class="text-sm text-error"
                                    x-text="errors.problem_detail"></div>
                            </div>
                        </div>

                        <!-- Definition of Done -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-base-content/70">
                                Definition of Done
                                <span class="text-error">*</span>
                            </label>
                            <textarea name="definition_of_done" x-model="form.definition_of_done"
                                class="w-full px-4 py-3 border border-base-300 bg-base-100 text-base-content rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors h-32 resize-none"
                                :class="{ 'border-error focus:ring-error focus:border-error': errors.definition_of_done }"
                                placeholder="Describe what needs to be accomplished to resolve this issue..." required></textarea>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-base-content/50"
                                    x-text="`${form.definition_of_done.length} characters`"></span>
                                <div x-show="errors.definition_of_done" class="text-sm text-error"
                                    x-text="errors.definition_of_done"></div>
                            </div>
                        </div>

                        <!-- Changes Summary -->
                        <div x-show="hasChanges" x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            class="bg-base-200 border border-base-300 rounded-lg p-4">
                            <h3 class="font-semibold text-base-content mb-3 flex items-center gap-2">
                                <svg class="w-5 h-5 text-base-content/70" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z">
                                    </path>
                                </svg>
                                Changes Detected
                            </h3>
                            <div class="text-sm space-y-2">
                                <div x-show="changes.status" class="flex justify-between">
                                    <span>Status:</span>
                                    <span>
                                        <span class="text-base-content/50" x-text="originalData.status"></span>
                                        <svg class="w-4 h-4 inline mx-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                        </svg>
                                        <span class="font-semibold" x-text="form.status"></span>
                                    </span>
                                </div>
                                <div x-show="changes.assigned_to" class="flex justify-between">
                                    <span>Assignment:</span>
                                    <span>
                                        <span class="text-base-content/50"
                                            x-text="getTeamName(originalData.assigned_to) || 'Unassigned'"></span>
                                        <svg class="w-4 h-4 inline mx-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                        </svg>
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

                        <!-- Form Actions -->
                        <div class="flex flex-col sm:flex-row gap-3 justify-end pt-4 border-t border-base-300">
                            <a href="{{ route('tickets.show', $ticket->id) }}"
                                class="px-6 py-3 border border-base-300 text-base-content rounded-lg font-medium hover:bg-base-200 transition-colors text-center">
                                Cancel
                            </a>
                            <button type="button" @click="resetForm()"
                                class="px-6 py-3 border border-base-300 text-base-content rounded-lg font-medium hover:bg-base-200 transition-colors"
                                :disabled="!hasChanges" :class="{ 'opacity-50 cursor-not-allowed': !hasChanges }">
                                Reset Changes
                            </button>
                            <button type="submit"
                                class="px-6 py-3 bg-neutral hover:bg-neutral-focus text-neutral-content rounded-lg font-medium transition-colors flex items-center justify-center gap-2"
                                :disabled="loading || !hasChanges"
                                :class="{ 'opacity-50 cursor-not-allowed': loading || !hasChanges }">
                                <span x-show="!loading" class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4">
                                        </path>
                                    </svg>
                                    Save Changes
                                </span>
                                <span x-show="loading" class="flex items-center gap-2">
                                    <svg class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="m4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                        </path>
                                    </svg>
                                    Saving...
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Confirmation Modal -->
        <div x-show="showConfirmModal"
            class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100">
            <div class="bg-base-100 rounded-lg shadow-2xl max-w-md w-full mx-4 p-6"
                @click.away="showConfirmModal = false">
                <h3 class="font-bold text-lg text-base-content mb-4">Confirm Changes</h3>
                <div class="mb-6">
                    <p class="mb-4 text-base-content/80">You are about to make the following changes:</p>
                    <div class="bg-base-200 p-4 rounded-lg space-y-2 text-sm">
                        <div x-show="changes.status" class="flex justify-between">
                            <span>Status:</span>
                            <span>
                                <span class="text-base-content/50" x-text="originalData.status"></span>
                                <svg class="w-4 h-4 inline mx-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                                <span class="font-semibold" x-text="form.status"></span>
                            </span>
                        </div>
                        <div x-show="changes.assigned_to" class="flex justify-between">
                            <span>Assignment:</span>
                            <span>
                                <span class="text-base-content/50"
                                    x-text="getTeamName(originalData.assigned_to) || 'Unassigned'"></span>
                                <svg class="w-4 h-4 inline mx-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                                <span class="font-semibold" x-text="getTeamName(form.assigned_to) || 'Unassigned'"></span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="flex gap-3">
                    <button @click="showConfirmModal = false"
                        class="flex-1 px-4 py-3 border border-base-300 text-base-content rounded-lg font-medium hover:bg-base-200 transition-colors">
                        Cancel
                    </button>
                    <button @click="confirmSubmit()"
                        class="flex-1 px-4 py-3 bg-neutral hover:bg-neutral-focus text-neutral-content rounded-lg font-medium transition-colors">
                        Confirm
                    </button>
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
                            const response = await fetch(`/tickets/{{ $ticket->id }}`, {
                                method: 'PUT',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': window.csrfToken
                                },
                                body: JSON.stringify(this.form)
                            });

                            const data = await response.json();
                            console.log(data);

                            if (data.success) {
                                window.location.href = `/tickets/{{ $ticket->id }}`;
                                return;
                                if (window.Alpine && window.Alpine.store) {
                                    window.Alpine.store('app').showAlert('success', data.message ||
                                        'Ticket updated successfully');
                                } else {
                                    // Fallback to parent component alert
                                    const appComponent = document.querySelector('[x-data*="app()"]').__x.$data;
                                    if (appComponent && appComponent.showAlert) {
                                        appComponent.showAlert('success', data.message || 'Ticket updated successfully');
                                    }
                                }

                                Object.assign(this.originalData, this.form);

                                // Optional: redirect after a delay to show the success message
                                setTimeout(() => {
                                    window.location.href = `/tickets/{{ $ticket->id }}`;
                                }, 1500);
                            } else {
                                if (data.errors) {
                                    this.errors = data.errors;
                                } else {
                                    const appComponent = document.querySelector('[x-data*="app()"]').__x.$data;
                                    if (appComponent && appComponent.showAlert) {
                                        appComponent.showAlert('error', data.message || 'Failed to update ticket');
                                    }
                                }
                            }
                        } catch (error) {
                            console.error('[v0] Edit ticket error:', error);
                            const appComponent = document.querySelector('[x-data*="app()"]').__x.$data;
                            if (appComponent && appComponent.showAlert) {
                                appComponent.showAlert('error', 'Network error occurred while updating the ticket');
                            }
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
