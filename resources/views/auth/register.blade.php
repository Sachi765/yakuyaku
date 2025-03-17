<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mt-4">
            <div class="flex items-center">
                <x-input-label for="name" :value="__('Name')" />
                <span class="text-red-500">*</span>
            </div>
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- login_id -->
        <div class="mt-4">
            <div class="flex items-center">
                <x-input-label for="login_id" :value="__('LoginID')" />
                <span class="text-red-500">*</span>
            </div>
            <x-text-input id="login_id" class="block mt-1 w-full" type="text" maxlength="5" minlength="5" name="login_id" :value="old('login_id')" required autofocus autocomplete="login_id" />
            <x-input-error :messages="$errors->get('login_id')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <div class="flex items-center">
                <x-input-label for="password" :value="__('Password').' (8文字以上)' " />
                <span class="text-red-500">*</span>
            </div>
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <div class="flex items-center">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <span class="text-red-500">*</span>
            </div>
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4 bg-green-500 hover:bg-green-600">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
