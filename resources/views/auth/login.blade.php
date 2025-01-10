<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>
        <div class="mb-4  text-gray-900">
        ورود به حساب کاربری       </div>
        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="auth" value="ایمیل" />
                <x-input id="auth" class="block mt-1 w-full" type="text" name="auth" :value="old('auth')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="رمزعبور" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" checked/>
                    <span class="ms-2 text-sm text-gray-600">مرا به یاد بسپار</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        گذرواژه ات را فراموش کرده‌ای؟
                    </a>
                @endif

                <x-button class="ms-4">
                    ورود
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
