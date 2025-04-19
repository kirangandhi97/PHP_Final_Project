<title>MidwayCafe</title>
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/short.jpg') }}">

<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <img width="100px" class="mx-auto" src="{{ asset('assets/images/logo.png') }}">
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600 text-center">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <x-jet-label for="email" value="{{ __('Email') }}" class="text-base font-semibold" />
                <x-jet-input id="email" class="block mt-1 w-full rounded-lg shadow-sm" type="email" name="email"
                    :value="old('email')" required autofocus />
            </div>

            <div class="mb-4">
                <x-jet-label for="password" value="{{ __('Password') }}" class="text-base font-semibold" />
                <x-jet-input id="password" class="block mt-1 w-full rounded-lg shadow-sm" type="password"
                    name="password" required autocomplete="current-password" />
            </div>

            <div class="flex items-center justify-between mb-4">
                <label for="remember_me" class="flex items-center text-sm">
                    <x-jet-checkbox id="remember_me" name="remember" class="mr-2" />
                    {{ __('Remember me') }}
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm text-blue-500 hover:underline" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <div class="flex justify-center">
                <x-jet-button class="w-full justify-center py-2">
                    {{ __('Log in') }}
                </x-jet-button>
            </div>

            <div class="mt-6 text-center text-sm text-gray-600">
                <span>Or</span><br>
                <a href="/register" class="text-blue-500 hover:underline font-medium">Register Now</a>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>