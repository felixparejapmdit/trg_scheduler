<x-guest-layout>
    <!-- Session Status -->
    
    <h2 class="text-center" style="color:#0a2d2e;font-size:30px;">TRG Scheduler</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="text" name="email" :value="old('email')" required autofocus autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
   
        <!-- Username -->
        <!-- <div>
                <label for="username">{{ __('Username') }}</label>
                <input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autofocus autocomplete="username">
                @error('username')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
        </div> -->

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <div class="flex items-center justify-center mt-4">

            <x-primary-button class="ms-3" style="width:200px;justify-content: center; background-color:#007bff;">
                {{ __('Log in') }}
            </x-primary-button>

        </div>
    </form>
</x-guest-layout>