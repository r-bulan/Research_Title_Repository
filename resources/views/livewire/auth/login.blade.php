<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('Login') }} - Research Title Repository</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
</head>
<body class="font-figtree antialiased bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md px-4">
        <!-- Logo & Header -->
        <div class="text-center mb-8">
            <div class="inline-block px-4 py-2 bg-blue-600 text-white rounded-lg mb-4">
                <h1 class="text-2xl font-bold">Research TItle Repository</h1>
            </div>
        </div>

        <!-- Login Card -->
        <div class="bg-white rounded-lg shadow-lg border border-gray-100 p-8">
            <!-- Title -->
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-900">{{ __('Welcome Back') }}</h2>
                <p class="text-gray-600 text-sm mt-2">{{ __('Enter your credentials to access the repository') }}</p>
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg text-sm">
                    ✓ {{ session('status') }}
                </div>
            @endif

            <!-- Login Form -->
            <form method="POST" action="{{ route('login.store') }}" class="space-y-6">
                @csrf

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
                        autofocus
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
                    <div class="flex justify-between items-center mb-2">
                        <label for="password" class="block text-sm font-medium text-gray-700">
                            {{ __('Password') }}
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-blue-600 hover:text-blue-700 text-xs font-medium">
                                {{ __('Forgot password?') }}
                            </a>
                        @endif
                    </div>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        required
                        autocomplete="current-password"
                        placeholder="••••••••"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition text-sm @error('password') border-red-500 @enderror"
                    />
                    @error('password')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <input
                        id="remember"
                        name="remember"
                        type="checkbox"
                        {{ old('remember') ? 'checked' : '' }}
                        class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-2 focus:ring-blue-500 cursor-pointer"
                    />
                    <label for="remember" class="ml-2 text-sm text-gray-600 cursor-pointer">
                        {{ __('Remember me') }}
                    </label>
                </div>

                <!-- Login Button -->
                <button
                    type="submit"
                    class="w-full px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition text-sm"
                >
                    {{ __('Log In') }}
                </button>
            </form>

            <!-- Divider -->
            <div class="my-6 border-t border-gray-200"></div>

            <!-- Sign Up Link -->
            @if (Route::has('register'))
                <div class="text-center">
                    <p class="text-gray-600 text-sm">
                        {{ __('Don\'t have an account?') }}
                        <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-700 font-medium">
                            {{ __('Sign up here') }}
                        </a>
                    </p>
                </div>
            @endif
        </div>

        <!-- Footer Info -->
        <div class="text-center mt-8">
            <p class="text-gray-500 text-xs">
                {{ __(' Research Title Repository') }} © {{ date('Y') }}
            </p>
        </div>
    </div>

    <!-- Loading State -->
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
    </style>
</body>
</html>
