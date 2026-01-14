<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title . ' - ' : '' }} Research Title Repository</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-figtree antialiased bg-gray-50">
    <div class="flex h-screen flex-col lg:flex-row">

        <!-- Mobile Menu Button -->
        <button id="sidebar-toggle" class="lg:hidden fixed top-4 left-4 z-50 p-2 text-gray-700 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 transition shadow-md" type="button" aria-label="Toggle sidebar menu">
            <svg id="menu-icon" class="w-6 h-6 block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
            <svg id="close-icon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <!-- Sidebar -->
        <aside id="sidebar" class="w-64 bg-white border-r border-gray-200 shadow-lg fixed h-screen overflow-y-auto z-40 lg:relative lg:z-auto lg:shadow-none transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">
            <div class="p-6 border-b border-gray-200">
                <h1 class="text-xl font-bold text-gray-900">CCS Repository</h1>
                <p class="text-xs text-gray-500 mt-1">Research Management</p>
            </div>

            <nav class="mt-8 space-y-2 px-4 pb-24">
                <a href="{{ route('dashboard') }}" class="block px-4 py-2 rounded-lg transition {{ request()->routeIs('dashboard') ? 'bg-blue-100 text-blue-700 font-semibold' : 'text-gray-700 hover:bg-gray-100' }}">📊 Dashboard</a>

                <a href="{{ route('research_titles.index') }}" class="block px-4 py-2 rounded-lg transition {{ request()->routeIs('research_titles.index','research_titles.create','research_titles.show','research_titles.edit') ? 'bg-blue-100 text-blue-700 font-semibold' : 'text-gray-700 hover:bg-gray-100' }}">📚 Research Titles</a>

                <a href="{{ route('categories.index') }}" class="block px-4 py-2 rounded-lg transition {{ request()->routeIs('categories.*') ? 'bg-blue-100 text-blue-700 font-semibold' : 'text-gray-700 hover:bg-gray-100' }}">📂 Categories</a>

                <a href="{{ route('research_titles.trash') }}" class="block px-4 py-2 rounded-lg transition {{ request()->routeIs('research_titles.trash') ? 'bg-blue-100 text-blue-700 font-semibold' : 'text-gray-700 hover:bg-gray-100' }}">🗑️ Trash</a>
            </nav>

            <!-- Bottom Section -->
            <div class="absolute bottom-0 left-0 w-64 p-4 border-t border-gray-200 bg-white">
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-medium text-sm">Logout</button>
                </form>
            </div>
        </aside>

        <!-- Mobile overlay -->
        <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden lg:hidden" role="button" tabindex="0" aria-label="Close sidebar"></div>

        <!-- Main Content -->
        <main class="flex-1 overflow-auto pb-20 w-full">
            <!-- Top Header -->
            <header class="bg-white border-b border-gray-200 shadow-sm sticky top-0 z-10">
                <div class="px-4 lg:px-8 py-4">
                    <h2 class="text-xl lg:text-2xl font-semibold text-gray-900 pl-12 lg:pl-0">{{ $title ?? 'Dashboard' }}</h2>
                </div>
            </header>

            <!-- Content Area -->
            <div class="p-4 lg:p-8">

                {{-- Success Message --}}
                @if (session('success'))
                <div id="success-alert" class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg flex justify-between items-center animate-fade-in text-sm lg:text-base" role="alert">
                    <div class="flex items-center gap-2">
                        <span class="text-lg">✓</span>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button type="button" onclick="dismissAlert('success-alert')" class="text-green-700 hover:text-green-900 font-bold text-lg">&times;</button>
                </div>
                @endif

                {{-- Error Message --}}
                @if (session('error'))
                <div id="error-alert" class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg flex justify-between items-center text-sm lg:text-base" role="alert">
                    <div class="flex items-center gap-2">
                        <span class="text-lg">✗</span>
                        <span>{{ session('error') }}</span>
                    </div>
                    <button type="button" onclick="dismissAlert('error-alert')" class="text-red-700 hover:text-red-900 font-bold text-lg">&times;</button>
                </div>
                @endif

                {{-- Validation Errors --}}
                @if ($errors->any())
                <div id="errors-alert" class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg text-sm lg:text-base" role="alert">
                    <div class="flex justify-between items-start mb-2">
                        <div class="flex items-center gap-2">
                            <span class="text-lg">⚠️</span>
                            <strong>Validation Errors:</strong>
                        </div>
                        <button type="button" onclick="dismissAlert('errors-alert')" class="text-red-700 hover:text-red-900 font-bold">&times;</button>
                    </div>
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {{ $slot }}

            </div>
        </main>
    </div>

    <!-- Inline CSS for animations and scrollbars -->
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in { animation: fadeIn 0.3s ease-in-out; }

        #sidebar::-webkit-scrollbar { width: 6px; }
        #sidebar::-webkit-scrollbar-track { background: transparent; }
        #sidebar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }

        #sidebar, #sidebar-overlay { transition: all 0.3s ease-in-out; }
    </style>

</body>
</html>
