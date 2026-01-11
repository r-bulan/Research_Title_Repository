<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title . ' - ' : '' }}CCS Research Title Repository</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
</head>
<body class="font-figtree antialiased bg-gray-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white border-r border-gray-200 shadow-sm">
            <div class="p-6">
                <h1 class="text-xl font-bold text-gray-900">CCS Repository</h1>
                <p class="text-xs text-gray-500 mt-1">Research Management</p>
            </div>

            <nav class="mt-8 space-y-2 px-4">
                <!-- Dashboard Link -->
                <a 
                    href="{{ route('dashboard') }}" 
                    class="block px-4 py-2 rounded-lg transition {{ request()->routeIs('dashboard') ? 'bg-blue-100 text-blue-700 font-semibold' : 'text-gray-700 hover:bg-gray-100' }}"
                >
                    📊 Dashboard
                </a>

                <!-- Research Titles Link -->
                <a 
                    href="{{ route('research_titles.index') }}" 
                    class="block px-4 py-2 rounded-lg transition {{ request()->routeIs('research_titles.*') && !request()->routeIs('research_titles.trash') ? 'bg-blue-100 text-blue-700 font-semibold' : 'text-gray-700 hover:bg-gray-100' }}"
                >
                    📚 Research Titles
                </a>

                <!-- Categories Link -->
                <a 
                    href="{{ route('categories.index') }}" 
                    class="block px-4 py-2 rounded-lg transition {{ request()->routeIs('categories.*') ? 'bg-blue-100 text-blue-700 font-semibold' : 'text-gray-700 hover:bg-gray-100' }}"
                >
                    📂 Categories
                </a>

                <!-- Trash Link -->
                <a 
                    href="{{ route('research_titles.trash') }}" 
                    class="block px-4 py-2 rounded-lg transition {{ request()->routeIs('research_titles.trash') ? 'bg-blue-100 text-blue-700 font-semibold' : 'text-gray-700 hover:bg-gray-100' }}"
                >
                    🗑️ Trash
                </a>
            </nav>

            <!-- Bottom Section -->
            <div class="absolute bottom-0 left-0 w-64 p-4 border-t border-gray-200">
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button 
                        type="submit" 
                        class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-medium text-sm"
                    >
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-auto">
            <!-- Top Header -->
            <header class="bg-white border-b border-gray-200 shadow-sm">
                <div class="px-8 py-4">
                    <h2 class="text-2xl font-semibold text-gray-900">{{ isset($title) ? $title : 'Dashboard' }}</h2>
                </div>
            </header>

            <!-- Content Area -->
            <div class="p-8">
                <!-- Flash Messages -->
                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                        ✓ {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                        ✗ {{ session('error') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Page Content -->
                {{ $slot }}
            </div>
        </main>
    </div>

    <!-- Confirmation Dialogs -->
    <script>
        function confirmDelete(form) {
            if (confirm('Are you sure you want to delete this? This action cannot be undone.')) {
                form.submit();
            }
        }

        function confirmRestore(button) {
            if (confirm('Are you sure you want to restore this research title?')) {
                button.form.submit();
            }
        }

        function confirmForceDelete(form) {
            if (confirm('Are you sure you want to permanently delete this? This action cannot be undone.')) {
                form.submit();
            }
        }
    </script>
</body>
</html>
