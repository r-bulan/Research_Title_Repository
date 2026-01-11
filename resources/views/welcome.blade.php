<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CCS Research Title Repository</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex flex-col items-center justify-center">
        <div class="text-center">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">CCS Research Title Repository</h1>
            <p class="text-lg text-gray-600 mb-8">A focused system for College of Computer Studies research management</p>
            
            @auth
                <a href="{{ route('dashboard') }}" class="inline-block px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 mr-4">
                    Go to Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="inline-block px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 mr-4">
                    Login
                </a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="inline-block px-6 py-3 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">
                        Register
                    </a>
                @endif
            @endauth
        </div>
    </div>
</body>
</html>
