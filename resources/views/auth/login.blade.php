<x-guest-layout>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-[#2b79f6]" />
            <x-text-input id="email"
                class="block mt-1 w-full text-[#2b79f6] !bg-transparent focus:!bg-transparent rounded-md shadow-inner"
                type="email" name="email" :value="old('email')" required autofocus autocomplete="username" /> 
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-[#2b79f6]" />
            <x-text-input id="password" class="block text-[#2b79f6] mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded text-[#2b79f6] shadow-sm focus:ring-indigo-500"
                    name="remember">
                <span class="ms-2 text-sm text-[#2b79f6]">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-[#2b79f6] hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-indigo-500"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
