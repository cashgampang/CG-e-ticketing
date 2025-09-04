@extends('layouts.app')

@section('title', 'Teams')

@section('content')
    <div x-data="teamsList()" x-init="init()">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <div>
                <h1 class="text-3xl font-bold text-base-content">
                    <i class="fas fa-users mr-3"></i>Teams
                </h1>
                <p class="text-base-content/70 mt-1">Manage development team members</p>
            </div>

            <button @click="showAddModal = true" class="btn btn-primary">
                <i class="fas fa-user-plus mr-2"></i>Add Team Member
            </button>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="stat bg-base-200 rounded-lg">
                <div class="stat-figure text-primary">
                    <i class="fas fa-users text-2xl"></i>
                </div>
                <div class="stat-title">Total Members</div>
                <div class="stat-value text-primary" x-text="teams.length"></div>
            </div>

            <div class="stat bg-base-200 rounded-lg">
                <div class="stat-figure text-warning">
                    <i class="fas fa-tasks text-2xl"></i>
                </div>
                <div class="stat-title">Active Tickets</div>
                <div class="stat-value text-warning" x-text="totalActiveTickets"></div>
            </div>

            <div class="stat bg-base-200 rounded-lg">
                <div class="stat-figure text-success">
                    <i class="fas fa-chart-line text-2xl"></i>
                </div>
                <div class="stat-title">Avg Load</div>
                <div class="stat-value text-success" x-text="averageLoad.toFixed(1)"></div>
            </div>
        </div>

        <!-- Teams Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <template x-for="team in teams" :key="team.id">
                <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow">
                    <div class="card-body">
                        <div class="flex items-start justify-between">
                            <div class="flex items-center">
                                <div class="avatar placeholder mr-3">
                                    <div class="bg-primary text-primary-content rounded-full w-12">
                                        <span class="text-lg font-semibold"
                                            x-text="team.name.charAt(0).toUpperCase()"></span>
                                    </div>
                                </div>
                                <div>
                                    <h2 class="card-title" x-text="team.name"></h2>
                                    <p class="text-sm text-base-content/70">Team Member</p>
                                </div>
                            </div>

                            <div class="dropdown dropdown-end">
                                <div tabindex="0" role="button" class="btn btn-ghost btn-sm btn-circle">
                                    <i class="fas fa-ellipsis-v"></i>
                                </div>
                                <ul tabindex="0"
                                    class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-40">
                                    <li><a :href="`/teams/${team.id}/tickets`"><i class="fas fa-ticket-alt mr-2"></i>View
                                            Tickets</a></li>
                                    <li><a @click="editTeam(team)"><i class="fas fa-edit mr-2"></i>Edit</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="mt-4">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm font-semibold">Active Tickets</span>
                                <span class="badge badge-primary" x-text="team.active_tickets_count || 0"></span>
                            </div>

                            <div class="w-full bg-base-200 rounded-full h-2">
                                <div class="bg-primary h-2 rounded-full transition-all duration-300"
                                    :style="`width: ${getLoadPercentage(team.active_tickets_count)}%`"></div>
                            </div>

                            <div class="flex justify-between text-xs text-base-content/70 mt-1">
                                <span>Load</span>
                                <span x-text="`${getLoadPercentage(team.active_tickets_count)}%`"></span>
                            </div>
                        </div>

                        <div class="card-actions justify-end mt-4">
                            <a :href="`/teams/${team.id}/tickets`" class="btn btn-outline btn-sm">
                                <i class="fas fa-eye mr-2"></i>View Tickets
                            </a>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        <!-- Empty State -->
        <div x-show="teams.length === 0" class="text-center py-12">
            <i class="fas fa-users text-6xl text-base-content/30 mb-4"></i>
            <h3 class="text-2xl font-bold text-base-content/70 mb-2">No Team Members</h3>
            <p class="text-base-content/50 mb-6">Add your first team member to get started</p>
            <button @click="showAddModal = true" class="btn btn-primary">
                <i class="fas fa-user-plus mr-2"></i>Add Team Member
            </button>
        </div>

        <!-- Add Team Member Modal -->
        <div class="modal" :class="{ 'modal-open': showAddModal }">
            <div class="modal-box">
                <h3 class="font-bold text-lg mb-4">
                    <i class="fas fa-user-plus mr-2"></i>Add Team Member
                </h3>

                <form @submit.prevent="addTeamMember()">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">Name</span>
                            <span class="label-text-alt text-error">Required</span>
                        </label>
                        <input type="text" x-model="newTeamName" placeholder="Enter team member name"
                            class="input input-bordered" :class="{ 'input-error': newTeamError }" required
                            maxlength="100" />
                        <div x-show="newTeamError" class="label">
                            <span class="label-text-alt text-error" x-text="newTeamError"></span>
                        </div>
                    </div>

                    <div class="modal-action">
                        <button type="button" @click="cancelAdd()" class="btn">Cancel</button>
                        <button type="submit" :disabled="adding || !newTeamName.trim()" class="btn btn-primary">
                            <span x-show="!adding">Add Member</span>
                            <span x-show="adding" class="loading loading-spinner loading-sm"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Team Member Modal -->
        <div class="modal" :class="{ 'modal-open': showEditModal }">
            <div class="modal-box">
                <h3 class="font-bold text-lg mb-4">
                    <i class="fas fa-edit mr-2"></i>Edit Team Member
                </h3>

                <form @submit.prevent="updateTeamMember()">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-semibold">Name</span>
                            <span class="label-text-alt text-error">Required</span>
                        </label>
                        <input type="text" x-model="editTeamName" placeholder="Enter team member name"
                            class="input input-bordered" :class="{ 'input-error': editTeamError }" required
                            maxlength="100" />
                        <div x-show="editTeamError" class="label">
                            <span class="label-text-alt text-error" x-text="editTeamError"></span>
                        </div>
                    </div>

                    <div class="modal-action">
                        <button type="button" @click="cancelEdit()" class="btn">Cancel</button>
                        <button type="submit" :disabled="updating || !editTeamName.trim()" class="btn btn-primary">
                            <span x-show="!updating">Update Member</span>
                            <span x-show="updating" class="loading loading-spinner loading-sm"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function teamsList() {
                return {
                    teams: @json($teams ?? []),
                    showAddModal: false,
                    showEditModal: false,
                    newTeamName: '',
                    newTeamError: '',
                    editTeamName: '',
                    editTeamError: '',
                    editingTeam: null,
                    adding: false,
                    updating: false,

                    init() {
                        // Initialize any needed data
                    },

                    get totalActiveTickets() {
                        return this.teams.reduce((total, team) => total + (team.active_tickets_count || 0), 0);
                    },

                    get averageLoad() {
                        if (this.teams.length === 0) return 0;
                        return this.totalActiveTickets / this.teams.length;
                    },

                    getLoadPercentage(ticketCount) {
                        const maxLoad = Math.max(...this.teams.map(t => t.active_tickets_count || 0), 5);
                        return Math.min((ticketCount / maxLoad) * 100, 100);
                    },

                    async addTeamMember() {
                        if (!this.newTeamName.trim()) return;

                        this.adding = true;
                        this.newTeamError = '';

                        try {
                            const formData = new FormData();
                            formData.append('_token', window.csrfToken);
                            formData.append('name', this.newTeamName.trim());

                            const response = await fetch('/teams', {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'Accept': 'application/json'
                                }
                            });

                            if (response.ok) {
                                const data = await response.json();
                                this.teams.push({
                                    ...data.data,
                                    active_tickets_count: 0
                                });
                                this.cancelAdd();
                                this.$parent.showAlert('success', 'Team member added successfully');
                            } else {
                                const data = await response.json();
                                if (data.errors && data.errors.name) {
                                    this.newTeamError = data.errors.name[0];
                                } else {
                                    this.newTeamError = 'Failed to add team member';
                                }
                            }
                        } catch (error) {
                            this.newTeamError = 'An error occurred';
                        }

                        this.adding = false;
                    },

                    editTeam(team) {
                        this.editingTeam = team;
                        this.editTeamName = team.name;
                        this.showEditModal = true;
                    },

                    async updateTeamMember() {
                        if (!this.editTeamName.trim() || !this.editingTeam) return;

                        this.updating = true;
                        this.editTeamError = '';

                        try {
                            const formData = new FormData();
                            formData.append('_token', window.csrfToken);
                            formData.append('_method', 'PUT');
                            formData.append('name', this.editTeamName.trim());

                            const response = await fetch(`/teams/${this.editingTeam.id}`, {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'Accept': 'application/json'
                                }
                            });

                            if (response.ok) {
                                const data = await response.json();
                                const index = this.teams.findIndex(t => t.id === this.editingTeam.id);
                                if (index !== -1) {
                                    this.teams[index] = {
                                        ...this.teams[index],
                                        ...data.data
                                    };
                                }
                                this.cancelEdit();
                                this.$parent.showAlert('success', 'Team member updated successfully');
                            } else {
                                const data = await response.json();
                                if (data.errors && data.errors.name) {
                                    this.editTeamError = data.errors.name[0];
                                } else {
                                    this.editTeamError = 'Failed to update team member';
                                }
                            }
                        } catch (error) {
                            this.editTeamError = 'An error occurred';
                        }

                        this.updating = false;
                    },

                    cancelAdd() {
                        this.showAddModal = false;
                        this.newTeamName = '';
                        this.newTeamError = '';
                    },

                    cancelEdit() {
                        this.showEditModal = false;
                        this.editTeamName = '';
                        this.editTeamError = '';
                        this.editingTeam = null;
                    }
                }
            }
        </script>
    @endpush
@endsection
