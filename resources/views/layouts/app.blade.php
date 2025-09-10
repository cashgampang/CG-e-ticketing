<!DOCTYPE html>
<html lang="en" x-data="app()" x-cloak :data-theme="darkMode ? 'dark' : 'light'">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'ILW Software Ticketing System')</title>

    <!-- Tailwind CSS + DaisyUI -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.19/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Added SweetAlert2 CDN for proper Toast notifications -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="min-h-screen bg-base-100">
    <!-- Navbar -->
    <div class="navbar bg-base-300 shadow-lg">
        <div class="navbar-start">
            <div class="dropdown">
                <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
                    <i class="fas fa-bars text-xl"></i>
                </div>
                <ul tabindex="0"
                    class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                    <li><a href="{{ route('tickets.index') }}"><i class="fas fa-ticket-alt mr-2"></i>My Tickets</a></li>

                    @auth
                        @if (auth()->user()->role === 'IT')
                            <li><a href="{{ route('tickets.index') }}?all=1"><i class="fas fa-list mr-2"></i>All Tickets</a>
                            </li>
                            <li><a href="{{ route('teams.index') }}"><i class="fas fa-users mr-2"></i>Teams</a></li>
                            <li><a href="#"><i class="fas fa-chart-bar mr-2"></i>Reports</a></li>
                        @endif

                        @if (auth()->user()->role === 'admin')
                            <li><a href="#"><i class="fas fa-users-cog mr-2"></i>User Management</a></li>
                            <li><a href="#"><i class="fas fa-cogs mr-2"></i>System Settings</a></li>
                        @endif
                    @endauth
                </ul>
            </div>
            <a href="{{ route('tickets.index') }}" class="btn btn-ghost text-xl">
                <i class="fas fa-code mr-2"></i>
                <span class="hidden lg:inline">ILW CodeReq Ticketing</span>
                <span class="inline lg:hidden">ILW-CRT</span>
            </a>
        </div>

        <div class="navbar-center hidden lg:flex">
            <ul class="menu menu-horizontal px-1">
                <li><a href="{{ route('tickets.index') }}" class="btn btn-ghost"><i
                            class="fas fa-ticket-alt mr-2"></i>My Tickets</a></li>

                @auth
                    @if (auth()->user()->role === 'IT')
                        <li><a href="{{ route('tickets.index') }}?all=1" class="btn btn-ghost"><i
                                    class="fas fa-list mr-2"></i>All Tickets</a></li>
                        <li><a href="{{ route('teams.index') }}" class="btn btn-ghost"><i
                                    class="fas fa-users mr-2"></i>Teams</a></li>
                        <li><a href="#" class="btn btn-ghost"><i class="fas fa-chart-bar mr-2"></i>Reports</a></li>
                    @endif

                    @if (auth()->user()->role === 'admin')
                        <li><a href="#" class="btn btn-ghost"><i class="fas fa-users-cog mr-2"></i>Users</a></li>
                        <li><a href="#" class="btn btn-ghost"><i class="fas fa-cogs mr-2"></i>Settings</a></li>
                    @endif
                @endauth
            </ul>
        </div>

        <div class="navbar-end">
            @auth
                <div class="dropdown dropdown-end">
                    <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                        <div class="w-10 rounded-full bg-blue-500 text-primary-content flex items-center justify-center">
                            <i class="fas fa-user text-xl pt-1"></i>
                        </div>
                    </div>

                    <ul tabindex="0"
                        class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                        <li class="menu-title flex items-center gap-2">
                            <span>{{ auth()->user()->name }}</span>
                            <span
                                class="badge badge-sm badge-{{ auth()->user()->role === 'IT' ? '' : (auth()->user()->role === 'admin' ? 'secondary' : 'bg-blue-500') }}">
                                @if (auth()->user()->role === 'IT')
                                    <i class="fas fa-laptop-code"></i>
                                @elseif(auth()->user()->role === 'admin')
                                    <i class="fas fa-user-shield"></i>
                                @else
                                    <i class="fas fa-user"></i>
                                @endif
                            </span>
                        </li>
                        <li><a href="#"><i class="fas fa-user mr-2"></i>Profile</a></li>
                        <li><a href="#"><i class="fas fa-cog mr-2"></i>Settings</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" class="w-full">
                                @csrf
                                <button type="submit" class="w-full text-left">
                                    <i class="fas fa-sign-out-alt mr-2"></i>Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <a href="{{ route('login') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-sign-in-alt mr-2"></i>Login
                </a>
            @endauth

            <!-- Fixed theme toggle button with proper Alpine.js binding -->
            <button @click="toggleDarkMode()" class="btn btn-ghost btn-circle ml-2">
                <i x-show="!darkMode" class="fas fa-moon text-lg"></i>
                <i x-show="darkMode" class="fas fa-sun text-lg"></i>
            </button>
        </div>
    </div>

    <!-- Alert Messages -->
    <div x-show="alert.show" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform -translate-y-2"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 transform translate-y-0"
        x-transition:leave-end="opacity-0 transform -translate-y-2" class="fixed top-20 right-4 z-50">
        <div :class="alert.type === 'success' ? 'alert-success' : alert.type === 'error' ? 'alert-error' : 'alert-info'"
            class="alert shadow-lg max-w-sm">
            <div>
                <i x-show="alert.type === 'success'" class="fas fa-check-circle"></i>
                <i x-show="alert.type === 'error'" class="fas fa-exclamation-circle"></i>
                <i x-show="alert.type === 'info'" class="fas fa-info-circle"></i>
                <span x-text="alert.message"></span>
            </div>
            <button @click="hideAlert()" class="btn btn-sm btn-ghost">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>

    <!-- Laravel Flash Messages -->
    @if (session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform -translate-y-2"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform translate-y-0"
            x-transition:leave-end="opacity-0 transform -translate-y-2" class="fixed top-20 right-4 z-50">
            <div class="alert alert-success shadow-lg max-w-sm">
                <div>
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('success') }}</span>
                </div>
                <button @click="show = false" class="btn btn-sm btn-ghost">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform -translate-y-2"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform translate-y-0"
            x-transition:leave-end="opacity-0 transform -translate-y-2" class="fixed top-20 right-4 z-50">
            <div class="alert alert-error shadow-lg max-w-sm">
                <div>
                    <i class="fas fa-exclamation-circle"></i>
                    <span>{{ session('error') }}</span>
                </div>
                <button @click="show = false" class="btn btn-sm btn-ghost">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-6">
        @yield('content')
    </main>

    <script>
        // Setup CSRF token for AJAX requests
        window.csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        function app() {
            return {
                // Initialize darkMode from localStorage
                darkMode: localStorage.getItem('darkMode') === 'true',
                alert: {
                    show: false,
                    type: 'info',
                    message: ''
                },
                @auth
                userRole: '{{ auth()->user()->role }}',
                userName: '{{ auth()->user()->name }}',
            @else
                userRole: null,
                userName: null,
            @endauth

            init() {
                    this.$nextTick(() => {
                        console.log('[v0] App initialized with darkMode:', this.darkMode);
                        // Force theme update on initialization
                        this.updateTheme();
                    });
                },

                toggleDarkMode() {
                    this.darkMode = !this.darkMode;
                    localStorage.setItem('darkMode', this.darkMode.toString());

                    this.updateTheme();

                    // Show feedback using SweetAlert if available
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2000,
                            icon: 'success',
                            title: `Switched to ${this.darkMode ? 'Dark' : 'Light'} mode`
                        });
                    }

                    console.log('[v0] Theme toggled to:', this.darkMode ? 'Dark' : 'Light');
                },

                updateTheme() {
                    const html = document.documentElement;
                    html.setAttribute('data-theme', this.darkMode ? 'dark' : 'light');
                },

                showAlert(type, message) {
                    this.alert = {
                        show: true,
                        type: type,
                        message: message
                    };

                    setTimeout(() => {
                        this.hideAlert();
                    }, 5000);
                },

                hideAlert() {
                    this.alert.show = false;
                },

                isIT() {
                    return this.userRole === 'IT';
                },

                isAdmin() {
                    return this.userRole === 'admin';
                },

                isUser() {
                    return this.userRole === 'user';
                },

                canManageTickets() {
                    return this.isIT() || this.isAdmin();
                },

                canAssignTeams() {
                    return this.isIT() || this.isAdmin();
                }
        }
        }

        document.addEventListener('alpine:init', () => {
            console.log('[v0] Alpine.js initialized successfully');
        });

        document.addEventListener('alpine:initialized', () => {
            console.log('[v0] Alpine.js fully initialized');
        });
    </script>

    @stack('scripts')
</body>

</html>
