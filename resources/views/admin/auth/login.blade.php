@extends('layouts.auth')

@section('content')

<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-6">
        
        <!-- Login Header -->
        <div class="text-center mb-4">
            <h2 class="text-2xl font-semibold text-gray-700">
                <i class="fa fa-users"></i> {{ __('Sign In') }}
            </h2>
        </div>

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-3">
                @foreach ($errors->all() as $error)
                    <p class="text-sm">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700">{{ __('Email Address') }}</label>
                <div class="relative">
                    <input id="email" type="email" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    <span class="absolute inset-y-0 right-3 flex items-center">
                        <i class="fa fa-envelope text-gray-400"></i>
                    </span>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">{{ __('Password') }}</label>
                <div class="relative">
                    <input id="password" type="password" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 @error('password') border-red-500 @enderror" name="password" required autocomplete="current-password">
                    <button type="button" class="absolute inset-y-0 right-3 flex items-center text-gray-500 hover:text-gray-700 toggle-password">
                        <i class="fa fa-eye"></i>
                    </button>
                </div>
            </div>

            <div class="flex items-center justify-between">
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="remember" id="remember" class="form-checkbox text-blue-600" {{ old('remember') ? 'checked' : '' }}>
                    <span class="text-sm text-gray-700">{{ __('Keep me logged in') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline">{{ __('Forgot Password?') }}</a>
                @endif
            </div>

            <button type="submit" class="w-full py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-400">
                {{ __('Sign In') }}
            </button>
        </form>
    </div>
</div>

<script>
    $(document).ready(function () {
        $(".toggle-password").click(function () {
            let passwordInput = $("#password");
            let icon = $(this).find("i");

            if (passwordInput.attr("type") === "password") {
                passwordInput.attr("type", "text");
                icon.removeClass("fa-eye").addClass("fa-eye-slash");
            } else {
                passwordInput.attr("type", "password");
                icon.removeClass("fa-eye-slash").addClass("fa-eye");
            }
        });
    });
</script>

@endsection
