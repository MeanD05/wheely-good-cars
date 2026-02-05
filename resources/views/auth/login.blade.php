<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="flex flex-wrap items-center gap-4 bg-white p-6 rounded-lg shadow-md max-w-4xl mx-auto">
        @csrf

        <!-- Email Address -->
        <div class="flex flex-col flex-1 min-w-[200px]">
            <x-input-label for="email" :value="__('Email')" class="mb-1 text-blue-900 font-semibold" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" class="block w-full rounded border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200" />
            <x-input-error :messages="$errors->get('email')" class="mt-1 text-red-600 text-sm" />
        </div>

        <!-- Password -->
        <div class="flex flex-col flex-1 min-w-[200px]">
            <x-input-label for="password" :value="__('Password')" class="mb-1 text-blue-900 font-semibold" />
            <x-text-input id="password" type="password" name="password" required autocomplete="current-password" class="block w-full rounded border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200" />
            <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-600 text-sm" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center gap-2">
            <input id="remember_me" type="checkbox" name="remember" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
            <label for="remember_me" class="text-gray-600 text-sm">Remember me</label>
        </div>

        <!-- Submit Button -->
        <div class="flex items-center gap-2">
            <x-primary-button class="bg-black hover:bg-black text-white font-bold py-2 px-4 rounded">
                {{ __('Log in') }}
            </x-primary-button>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm text-gray-600 hover:text-gray-900 underline">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>
    </form>
</x-guest-layout>
