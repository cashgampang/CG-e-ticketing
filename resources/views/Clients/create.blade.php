@extends('layouts.app')

@section('title', 'Create New Ticket')

@section('content')
    <div x-data="createTicket()">
        <!-- Header -->
        <div class="flex items-center gap-4 mb-6">
            <a href="{{ route('tickets.index') }}" class="btn btn-ghost btn-circle">
                <i class="fas fa-arrow-left text-xl"></i>
            </a>
            <div>
                <h1 class="text-3xl font-bold text-base-content">
                    <i class="fas fa-plus-circle mr-3"></i>Create New Ticket
                </h1>
                <p class="text-base-content/70 mt-1">Submit a new support request</p>
            </div>
        </div>

        <!-- Alert Messages -->
        <div x-show="alert.show" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform -translate-y-2"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform translate-y-0"
            x-transition:leave-end="opacity-0 transform -translate-y-2" class="max-w-4xl mx-auto mb-6">
            <div class="alert" :class="alert.type === 'success' ? 'alert-success' : 'alert-error'">
                <i class="fas" :class="alert.type === 'success' ? 'fa-check-circle' : 'fa-exclamation-triangle'"></i>
                <span x-text="alert.message"></span>
                <button @click="hideAlert()" class="btn btn-ghost btn-sm">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>

        <!-- Form Card -->
        <div class="max-w-4xl mx-auto">
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <form @submit.prevent="submitForm()" class="space-y-6">

                        <!-- Requester Name -->
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-semibold">
                                    <i class="fas fa-user mr-2"></i>Requester Name
                                </span>
                                <span class="label-text-alt text-error">Required</span>
                            </label>
                            <input type="text" name="requester_name" value="{{ Auth::user()->name }}"
                                {{-- ambil dari user login --}} readonly
                                class="input input-bordered bg-base-200 cursor-not-allowed" />
                            <div x-show="errors.requester_name" class="label">
                                <span class="label-text-alt text-error" x-text="errors.requester_name?.[0]"></span>
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
                            <textarea name="problem_detail" x-model="form.problem_detail" @input="clearErrors('problem_detail')"
                                class="textarea textarea-bordered h-32" :class="{ 'textarea-error': errors.problem_detail }"
                                placeholder="Describe the problem you're experiencing in detail..." required></textarea>
                            <div class="label">
                                <span class="label-text-alt" x-text="`${form.problem_detail.length} characters`"></span>
                                <span x-show="errors.problem_detail" class="label-text-alt text-error"
                                    x-text="errors.problem_detail?.[0]"></span>
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
                            <textarea name="definition_of_done" x-model="form.definition_of_done" @input="clearErrors('definition_of_done')"
                                class="textarea textarea-bordered h-32" :class="{ 'textarea-error': errors.definition_of_done }"
                                placeholder="Describe what needs to be accomplished to resolve this issue..." required></textarea>
                            <div class="label">
                                <span class="label-text-alt" x-text="`${form.definition_of_done.length} characters`"></span>
                                <span x-show="errors.definition_of_done" class="label-text-alt text-error"
                                    x-text="errors.definition_of_done?.[0]"></span>
                            </div>
                        </div>

                        <!-- Preview Card -->
                        <div x-show="form.requester_name || form.problem_detail || form.definition_of_done"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100" class="card bg-base-200 border">
                            <div class="card-body">
                                <h3 class="card-title text-lg">
                                    <i class="fas fa-eye mr-2"></i>Preview
                                </h3>

                                <div class="space-y-4">
                                    <div x-show="form.requester_name">
                                        <div class="text-sm font-semibold text-base-content/70">Requester:</div>
                                        <div x-text="form.requester_name" class="font-medium"></div>
                                    </div>

                                    <div x-show="form.problem_detail">
                                        <div class="text-sm font-semibold text-base-content/70">Problem:</div>
                                        <div x-text="form.problem_detail" class="text-sm"></div>
                                    </div>

                                    <div x-show="form.definition_of_done">
                                        <div class="text-sm font-semibold text-base-content/70">Definition of Done:</div>
                                        <div x-text="form.definition_of_done" class="text-sm"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex flex-col sm:flex-row gap-4 justify-end">
                            <a href="{{ route('tickets.index') }}" class="btn btn-ghost">
                                <i class="fas fa-times mr-2"></i>Cancel
                            </a>
                            <button type="submit" class="btn btn-primary" :disabled="loading">
                                <span x-show="!loading" class="flex items-center">
                                    <i class="fas fa-paper-plane mr-2"></i>Create Ticket
                                </span>
                                <span x-show="loading" class="flex items-center">
                                    <span class="loading loading-spinner loading-sm mr-2"></span>Creating...
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function createTicket() {
                return {
                    loading: false,
                    form: {
                        requester_name: '{{ Auth::user()->name }}', // default dari user login
                        problem_detail: '',
                        definition_of_done: ''
                    },
                    errors: {},
                    alert: {
                        show: false,
                        type: 'success',
                        message: ''
                    },

                    async submitForm() {
                        this.loading = true;
                        this.errors = {};
                        this.hideAlert();

                        try {
                            const response = await fetch('{{ route('tickets.store') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                        'content'),
                                    'X-Requested-With': 'XMLHttpRequest'
                                },
                                body: JSON.stringify(this.form)
                            });

                            const data = await response.json();

                            if (response.ok) {
                                this.showAlert('success', 'Ticket created successfully!');

                                // Reset form
                                this.form = {
                                    requester_name: '{{ Auth::user()->name }}', // default dari user login
                                    problem_detail: '',
                                    definition_of_done: ''
                                };

                                // Redirect after showing success message
                                setTimeout(() => {
                                    window.location.href = '{{ route('tickets.index') }}';
                                }, 2000);
                            } else {
                                if (data.errors) {
                                    this.errors = data.errors;

                                    // Show first validation error
                                    const firstError = Object.values(data.errors)[0][0];
                                    this.showAlert('error', firstError);
                                } else {
                                    this.showAlert('error', data.message || 'Failed to create ticket');
                                }
                            }
                        } catch (error) {
                            console.error('Submit error:', error);
                            this.showAlert('error', 'Network error occurred. Please try again.');
                        }

                        this.loading = false;
                    },

                    showAlert(type, message) {
                        this.alert = {
                            show: true,
                            type: type,
                            message: message
                        };
                    },

                    hideAlert() {
                        this.alert.show = false;
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
