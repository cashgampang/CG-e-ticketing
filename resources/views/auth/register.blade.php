<x-guest-layout>
    <!-- Updated background gradient and container structure to match login form exactly -->
    <div
        class="min-h-screen flex items-center justify-center bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 p-4">
        <div class="w-full max-w-sm sm:max-w-md space-y-6">
            <!-- Updated branding section to match login form layout and typography -->
            <div class="text-center space-y-4">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 leading-tight">ILW Software Request</h1>
                    <h2 class="text-lg sm:text-xl font-semibold text-blue-600">Ticketing System</h2>
                    <p class="text-sm text-gray-600 mt-2">Create your account to get started</p>
                </div>
            </div>

            <!-- Updated card styling to match login form with backdrop blur and rounded-3xl -->
            <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-2xl border border-white/20 p-6 sm:p-8 space-y-6">
                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <!-- Updated all input styling to match login form exactly -->
                    <div class="space-y-2">
                        <x-input-label for="name" :value="__('Full Name')" class="text-sm font-medium text-gray-700" />
                        <x-text-input id="name"
                            class="block w-full px-4 py-3.5 bg-gray-50/50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 text-gray-900 placeholder-gray-400"
                            type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                            placeholder="Enter your full name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-1" />
                    </div>

                    <div class="space-y-2">
                        <x-input-label for="email" :value="__('Email Address')" class="text-sm font-medium text-gray-700" />
                        <x-text-input id="email"
                            class="block w-full px-4 py-3.5 bg-gray-50/50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 text-gray-900 placeholder-gray-400"
                            type="email" name="email" :value="old('email')" required autocomplete="username"
                            placeholder="your@email.com" />
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    <div class="space-y-2">
                        <x-input-label for="password" :value="__('Password')" class="text-sm font-medium text-gray-700" />
                        <x-text-input id="password"
                            class="block w-full px-4 py-3.5 bg-gray-50/50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 text-gray-900 placeholder-gray-400"
                            type="password" name="password" required autocomplete="new-password"
                            placeholder="Create a secure password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>

                    <div class="space-y-2">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')"
                            class="text-sm font-medium text-gray-700" />
                        <x-text-input id="password_confirmation"
                            class="block w-full px-4 py-3.5 bg-gray-50/50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 text-gray-900 placeholder-gray-400"
                            type="password" name="password_confirmation" required autocomplete="new-password"
                            placeholder="Confirm your password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                    </div>

                    <!-- Updated button styling to match login form with gradient and hover effects -->
                    <x-primary-button
                        class="w-full mt-6 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 focus:ring-blue-500/20 py-3.5 px-4 text-white font-semibold rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        {{ __('Create Account') }}
                    </x-primary-button>
                </form>

                <!-- Updated login link section to match login form styling -->
                <div class="text-center pt-4 border-t border-gray-100">
                    <p class="text-sm text-gray-600">
                        Already have an account?
                        <a href="{{ route('login') }}"
                            class="font-semibold text-blue-600 hover:text-blue-700 transition-colors ml-1">
                            Sign in here
                        </a>
                    </p>
                </div>
            </div>

            <!-- Updated footer to match login form -->
            <div class="text-center">
                <p class="text-xs text-gray-500">
                    © {{ date('Y') }} ILW Software. All rights reserved.
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
