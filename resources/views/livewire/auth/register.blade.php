<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('Register') }} -  Research Title Repository</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
</head>
<body class="font-figtree antialiased bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md px-4">
        <!-- Logo & Header -->
        <div class="text-center mb-8">
            <div class="inline-block px-4 py-2 bg-blue-600 text-white rounded-lg mb-4">
                <h1 class="text-2xl font-bold">Research Title Repository</h1>
            </div>
=
        </div>

        <!-- Register Card -->
        <div class="bg-white rounded-lg shadow-lg border border-gray-100 p-8">
            <!-- Title -->
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-900">{{ __('Create Account') }}</h2>
                <p class="text-gray-600 text-sm mt-2">{{ __('Join the research community') }}</p>
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg text-sm">
                    ✓ {{ session('status') }}
                </div>
            @endif

            <!-- Register Form -->
            <form method="POST" action="{{ route('register.store') }}" class="space-y-6">
                @csrf

                <!-- Full Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ __('Full Name') }}
                    </label>
                    <input
                        id="name"
                        name="name"
                        type="text"
                        value="{{ old('name') }}"
                        required
                        autofocus
                        autocomplete="name"
                        placeholder="John Doe"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition text-sm @error('name') border-red-500 @enderror"
                    />
                    @error('name')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ __('Email Address') }}
                    </label>
                    <input
                        id="email"
                        name="email"
                        type="email"
                        value="{{ old('email') }}"
                        required
                        autocomplete="email"
                        placeholder="email@example.com"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition text-sm @error('email') border-red-500 @enderror"
                    />
                    @error('email')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ __('Password') }}
                    </label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        required
                        autocomplete="new-password"
                        placeholder="••••••••"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition text-sm @error('password') border-red-500 @enderror"
                    />
                    @error('password')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ __('Confirm Password') }}
                    </label>
                    <input
                        id="password_confirmation"
                        name="password_confirmation"
                        type="password"
                        required
                        autocomplete="new-password"
                        placeholder="••••••••"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition text-sm @error('password_confirmation') border-red-500 @enderror"
                    />
                    @error('password_confirmation')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Terms & Conditions (Optional) -->
                <div class="flex items-start">
                    <input
                        id="agree"
                        name="agree"
                        type="checkbox"
                        required
                        class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-2 focus:ring-blue-500 cursor-pointer mt-1"
                    />
                    <label for="agree" class="ml-2 text-sm text-gray-600 cursor-pointer">
                        {{ __('I agree to the terms and conditions') }}
                    </label>
                </div>

                <!-- Register Button -->
                <button
                    type="submit"
                    class="w-full px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition text-sm"
                >
                    {{ __('Create Account') }}
                </button>
            </form>

            <!-- Divider -->
            <div class="my-6 border-t border-gray-200"></div>

            <!-- Login Link -->
            <div class="text-center">
                <p class="text-gray-600 text-sm">
                    {{ __('Already have an account?') }}
                    <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-700 font-medium">
                        {{ __('Log in here') }}
                    </a>
                </p>
            </div>
        </div>

        <!-- Footer Info -->
        <div class="text-center mt-8">
            <p class="text-gray-500 text-xs">
                {{ __(' Research Title Repository') }} © {{ date('Y') }}
            </p>
            <p class="text-gray-500 text-xs mt-2">
                {{ __('Secure and private registration') }}
            </p>
        </div>
    </div>

    <!-- Styles -->
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        body {
            animation: fadeIn 0.3s ease-in-out;
        }

        input:focus {
            outline: none;
        }

        input::placeholder {
            color: #d1d5db;
        }

        input[type="checkbox"]:checked {
            background-color: #2563eb;
            border-color: #2563eb;
        }
    </style>
</body>
</html>
