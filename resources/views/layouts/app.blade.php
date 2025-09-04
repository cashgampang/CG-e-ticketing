<!DOCTYPE html>
<html lang="en" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" :data-theme="darkMode ? 'dark' : 'light'">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Ticket System')</title>

    <!-- Tailwind CSS + DaisyUI -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.19/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="min-h-screen bg-base-100">
    <div x-data="app()" x-cloak>
        <!-- Navbar -->
        <div class="navbar bg-base-300 shadow-lg">
            <div class="navbar-start">
                <div class="dropdown">
                    <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
                        <i class="fas fa-bars text-xl"></i>
                    </div>
                    <ul tabindex="0"
                        class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                        <li><a href="{{ route('tickets.index') }}"><i class="fas fa-ticket-alt mr-2"></i>Tickets</a>
                        </li>
                        <li><a href="{{ route('teams.index') }}"><i class="fas fa-users mr-2"></i>Teams</a></li>
                    </ul>
                </div>
                <a href="{{ route('tickets.index') }}" class="btn btn-ghost text-xl">
                    <i class="fas fa-bug mr-2"></i>Ticket System
                </a>
            </div>

            <div class="navbar-center hidden lg:flex">
                <ul class="menu menu-horizontal px-1">
                    <li><a href="{{ route('tickets.index') }}" class="btn btn-ghost"><i
                                class="fas fa-ticket-alt mr-2"></i>Tickets</a></li>
                    <li><a href="{{ route('teams.index') }}" class="btn btn-ghost"><i
                                class="fas fa-users mr-2"></i>Teams</a></li>
                </ul>
            </div>

            <div class="navbar-end">
                <!-- Theme Toggle -->
                <button @click="toggleDarkMode()" class="btn btn-ghost btn-circle">
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
    </div>

    <script>
        // Setup CSRF token for AJAX requests
        window.csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Global SweetAlert configurations
        window.Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        // Wait for Alpine.js to be ready
        document.addEventListener('alpine:init', () => {
            console.log('Alpine.js is ready!');
        });

        function app() {
            return {
                darkMode: localStorage.getItem('darkMode') === 'true',
                alert: {
                    show: false,
                    type: 'info',
                    message: ''
                },

                init() {
                    // Force re-render after initialization
                    this.$nextTick(() => {
                        console.log('App initialized with darkMode:', this.darkMode);
                    });
                },

                toggleDarkMode() {
                    this.darkMode = !this.darkMode;
                    localStorage.setItem('darkMode', this.darkMode.toString());

                    // Show feedback using SweetAlert
                    window.Toast.fire({
                        icon: 'success',
                        title: `Switched to ${this.darkMode ? 'Dark' : 'Light'} mode`
                    });

                    // Force update
                    this.$nextTick(() => {
                        console.log('Theme toggled to:', this.darkMode);
                    });
                },

                showAlert(type, message) {
                    // Use SweetAlert instead of custom alert
                    const iconType = type === 'error' ? 'error' : type === 'warning' ? 'warning' : 'success';

                    window.Toast.fire({
                        icon: iconType,
                        title: message
                    });

                    // Keep the old system as fallback
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

                // Global AJAX helper
                async makeRequest(url, options = {}) {
                    try {
                        const defaultOptions = {
                            headers: {
                                'X-CSRF-TOKEN': window.csrfToken,
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        };

                        const response = await fetch(url, {
                            ...defaultOptions,
                            ...options,
                            headers: {
                                ...defaultOptions.headers,
                                ...(options.headers || {})
                            }
                        });

                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }

                        const data = await response.json();
                        return {
                            success: true,
                            data
                        };
                    } catch (error) {
                        console.error('Request failed:', error);
                        return {
                            success: false,
                            error: error.message
                        };
                    }
                },

                // Global confirm dialog
                async confirmAction(title, text, confirmButtonText = 'Yes, do it!') {
                    const result = await Swal.fire({
                        title: title,
                        text: text,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: confirmButtonText,
                        cancelButtonText: 'Cancel'
                    });

                    return result.isConfirmed;
                }
            }
        }
    </script>

    @stack('scripts')
    <!-- Tambahkan ini sebelum closing body tag di app.blade.php untuk debugging -->

    @if (config('app.debug'))
        <!-- Debug Panel (hanya muncul di development) -->
        <div x-data="{ showDebug: false }" class="fixed bottom-4 right-4 z-[9999]">
            <button @click="showDebug = !showDebug" class="btn btn-circle btn-sm btn-accent" title="Debug Panel">
                <i class="fas fa-bug"></i>
            </button>

            <div x-show="showDebug" x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95" class="card bg-base-200 shadow-xl w-80 mb-2">
                <div class="card-body p-4">
                    <h3 class="card-title text-sm">Alpine.js Debug</h3>

                    <div class="text-xs space-y-2">
                        <div>
                            <strong>Alpine Version:</strong>
                            <span x-text="Alpine.version || 'Not loaded'"></span>
                        </div>

                        <div>
                            <strong>Dark Mode:</strong>
                            <span x-text="$root.darkMode ? 'Dark' : 'Light'"></span>
                        </div>

                        <div>
                            <strong>CSRF Token:</strong>
                            <span x-text="window.csrfToken ? '✓ Loaded' : '✗ Missing'"></span>
                        </div>

                        <div>
                            <strong>SweetAlert:</strong>
                            <span x-text="typeof Swal !== 'undefined' ? '✓ Loaded' : '✗ Missing'"></span>
                        </div>

                        <div>
                            <strong>Current Route:</strong>
                            <span class="text-xs">{{ request()->route()->getName() ?? 'No route name' }}</span>
                        </div>

                        <div>
                            <strong>User Agent:</strong>
                            <span
                                x-text="navigator.userAgent.includes('Chrome') ? 'Chrome' : 
                                  navigator.userAgent.includes('Firefox') ? 'Firefox' : 
                                  navigator.userAgent.includes('Safari') ? 'Safari' : 'Other'"></span>
                        </div>
                    </div>

                    <div class="card-actions justify-end mt-3">
                        <button @click="testAlert()" class="btn btn-xs btn-primary">Test Alert</button>
                        <button @click="testTheme()" class="btn btn-xs btn-secondary">Test Theme</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Debug functions
            function testAlert() {
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        title: 'Test Alert',
                        text: 'SweetAlert is working!',
                        icon: 'success',
                        timer: 2000
                    });
                } else {
                    alert('SweetAlert not loaded!');
                }
            }

            function testTheme() {
                const root = document.querySelector('[x-data]');
                if (root && root._x_dataStack) {
                    const app = root._x_dataStack[0];
                    app.toggleDarkMode();
                } else {
                    console.error('Alpine.js app instance not found');
                }
            }

            // Console debugging
            console.log('Alpine.js Debug Info:', {
                alpineVersion: typeof Alpine !== 'undefined' ? Alpine.version : 'Not loaded',
                sweetAlert: typeof Swal !== 'undefined' ? 'Loaded' : 'Missing',
                csrfToken: window.csrfToken ? 'Present' : 'Missing',
                darkMode: localStorage.getItem('darkMode')
            });

            // Listen for Alpine events
            document.addEventListener('alpine:init', () => {
                console.log('✅ Alpine.js initialized successfully');
            });

            document.addEventListener('alpine:initialized', () => {
                console.log('✅ Alpine.js fully initialized');
            });
        </script>
    @endif
</body>

</html>
