<x-guest-layout>
    <div>
        <img src="assets/img/inti-logo.png" alt="inti-logo">
        <div class="flex items-center mb-2">
            <a href="{{ route('login') }}" class="flex items-center text-gray-700 hover:text-gray-900">
                <span class="material-icons">arrow_back</span>
            </a>
            <p class="text-xl font-bold text-center flex-1 py-4">Forgot Password</p>
        </div>
    </div>

    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
