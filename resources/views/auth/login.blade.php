<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 p-4">
        <div class="w-full max-w-sm sm:max-w-md space-y-6">
            <!-- Added ILW Software Ticketing System title with better branding -->
            <div class="text-center space-y-4">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 leading-tight">ILW Software Request</h1>
                    <h2 class="text-lg sm:text-xl font-semibold text-blue-600">Ticketing System</h2>
                    <p class="text-sm text-gray-600 mt-2">Sign in to manage your tickets</p>
                </div>
            </div>

            <!-- Redesigned login card with softer styling and better mobile responsiveness -->
            <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-2xl border border-white/20 p-6 sm:p-8 space-y-6">
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <!-- Improved input styling with better spacing and focus states -->
                    <div class="space-y-2">
                        <x-input-label for="email" :value="__('Email Address')" class="text-sm font-medium text-gray-700" />
                        <x-text-input id="email" 
                            class="block w-full px-4 py-3.5 bg-gray-50/50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 text-gray-900 placeholder-gray-400" 
                            type="email" 
                            name="email" 
                            :value="old('email')" 
                            required 
                            autofocus 
                            autocomplete="username"
                            placeholder="your@email.com" />
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    <div class="space-y-2">
                        <x-input-label for="password" :value="__('Password')" class="text-sm font-medium text-gray-700" />
                        <x-text-input id="password" 
                            class="block w-full px-4 py-3.5 bg-gray-50/50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 text-gray-900 placeholder-gray-400"
                            type="password"
                            name="password"
                            required 
                            autocomplete="current-password"
                            placeholder="Enter your password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>

                    <!-- Better layout for remember me and forgot password -->
                    <div class="flex items-center justify-between text-sm" style="margin-top: 10px; margin-bottom: 20px">
                        <label for="remember_me" class="flex items-center group cursor-pointer">
                            <input id="remember_me" type="checkbox" 
                                class="h-4 w-4 text-blue-600 focus:ring-blue-500/20 border-gray-300 rounded transition-colors" 
                                name="remember">
                            <span class="ml-2 text-gray-600 group-hover:text-gray-900 transition-colors">Remember me</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-blue-600 hover:text-blue-700 font-medium transition-colors" 
                               href="{{ route('password.request') }}">
                                Forgot password?
                            </a>
                        @endif
                    </div>

                    <!-- Enhanced button styling with better visual hierarchy -->
                    <x-primary-button class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 focus:ring-blue-500/20 py-3.5 px-4 text-white font-semibold rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 mt-8">
                        {{ __('Sign In') }}
                    </x-primary-button>
                </form>

                <!-- Improved registration section styling -->
                <div class="text-center pt-4 border-t border-gray-100">
                    <p class="text-sm text-gray-600">
                        Don't have an account?
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" 
                               class="font-semibold text-blue-600 hover:text-blue-700 transition-colors ml-1">
                                Create Account
                            </a>
                        @else
                            <span class="font-medium text-gray-400 ml-1">Contact admin for access</span>
                        @endif
                    </p>
                </div>
            </div>

            <!-- Updated footer with better spacing -->
            <div class="text-center">
                <p class="text-xs text-gray-500">
                    © {{ date('Y') }} ILW Software. All rights reserved.
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
