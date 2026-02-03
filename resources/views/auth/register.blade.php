<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('register') }}" class="flex flex-wrap items-center gap-4 bg-white p-6 rounded-lg shadow-md max-w-4xl mx-auto">
        @csrf

        <!-- Name -->
        <div class="flex flex-col flex-1 min-w-[200px]">
            <x-input-label for="name" :value="__('Name')" class="mb-1 text-blue-900 font-semibold"/>
            <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" class="block w-full rounded border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200"/>
            <x-input-error :messages="$errors->get('name')" class="mt-1 text-red-600 text-sm"/>
        </div>

        <!-- Email Address -->
        <div class="flex flex-col flex-1 min-w-[200px]">
            <x-input-label for="email" :value="__('Email')" class="mb-1 text-blue-900 font-semibold"/>
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" class="block w-full rounded border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200"/>
            <x-input-error :messages="$errors->get('email')" class="mt-1 text-red-600 text-sm"/>
        </div>

        <!-- Password -->
        <div class="flex flex-col flex-1 min-w-[200px]">
            <x-input-label for="password" :value="__('Password')" class="mb-1 text-blue-900 font-semibold"/>
            <x-text-input id="password" type="password" name="password" required autocomplete="new-password" class="block w-full rounded border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200"/>
            <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-600 text-sm"/>
        </div>

        <!-- Confirm Password -->
        <div class="flex flex-col flex-1 min-w-[200px]">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="mb-1 text-blue-900 font-semibold"/>
            <x-text-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="block w-full rounded border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200"/>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-red-600 text-sm"/>
        </div>

        <!-- Submit & Login Link -->
        <div class="flex flex-col sm:flex-row items-center gap-2 mt-2 sm:mt-0">
            <x-primary-button class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded">
                {{ __('Register') }}
            </x-primary-button>

            <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-gray-900 underline">
                {{ __('Already registered?') }}
            </a>
        </div>

    </form>
</x-guest-layout>
