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
    <div class="flex h-screen bg-gray-50 flex-col lg:flex-row">
        <!-- Mobile Menu Button -->
        <button id="sidebar-toggle" class="lg:hidden fixed top-4 left-4 z-30 p-2 text-gray-700 bg-white rounded-lg border border-gray-200">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>

        <!-- Sidebar -->
        <aside id="sidebar" class="w-64 bg-white border-r border-gray-200 shadow-sm fixed h-screen overflow-y-auto z-20 lg:relative lg:w-64 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">
            <div class="p-6 border-b border-gray-200">
                <h1 class="text-xl font-bold text-gray-900">CCS Repository</h1>
                <p class="text-xs text-gray-500 mt-1">Research Management</p>
            </div>

            <nav class="mt-8 space-y-2 px-4 pb-24">
                <a 
                    href="{{ route('dashboard') }}" 
                    class="block px-4 py-2 rounded-lg transition {{ request()->routeIs('dashboard') ? 'bg-blue-100 text-blue-700 font-semibold' : 'text-gray-700 hover:bg-gray-100' }}"
                >
                    📊 Dashboard
                </a>

                <a 
                    href="{{ route('research_titles.index') }}" 
                    class="block px-4 py-2 rounded-lg transition {{ request()->routeIs('research_titles.index', 'research_titles.create', 'research_titles.show', 'research_titles.edit') ? 'bg-blue-100 text-blue-700 font-semibold' : 'text-gray-700 hover:bg-gray-100' }}"
                >
                    📚 Research Titles
                </a>

                <a 
                    href="{{ route('categories.index') }}" 
                    class="block px-4 py-2 rounded-lg transition {{ request()->routeIs('categories.*') ? 'bg-blue-100 text-blue-700 font-semibold' : 'text-gray-700 hover:bg-gray-100' }}"
                >
                    📂 Categories
                </a>

                <a 
                    href="{{ route('research_titles.trash') }}" 
                    class="block px-4 py-2 rounded-lg transition {{ request()->routeIs('research_titles.trash') ? 'bg-blue-100 text-blue-700 font-semibold' : 'text-gray-700 hover:bg-gray-100' }}"
                >
                    🗑️ Trash
                </a>
            </nav>

            <!-- Bottom Section -->
            <div class="absolute bottom-0 left-0 w-64 p-4 border-t border-gray-200 bg-white">
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

        <!-- Mobile overlay -->
        <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-10 hidden lg:hidden" onclick="toggleSidebar()"></div>

        <!-- Main Content -->
        <main class="flex-1 overflow-auto pb-20 lg:ml-0 w-full">
            <!-- Top Header -->
            <header class="bg-white border-b border-gray-200 shadow-sm sticky top-0 z-10">
                <div class="px-4 lg:px-8 py-4">
                    <h2 class="text-xl lg:text-2xl font-semibold text-gray-900">{{ $title ?? 'Dashboard' }}</h2>
                </div>
            </header>

            <!-- Content Area -->
            <div class="p-4 lg:p-8">
                <!-- Success Flash Message -->
                @if (session('success'))
                    <div id="success-alert" class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg flex justify-between items-center animate-fade-in text-sm lg:text-base">
                        <div class="flex items-center gap-2">
                            <span class="text-lg">✓</span>
                            <span>{{ session('success') }}</span>
                        </div>
                        <button onclick="dismissAlert('success-alert')" class="text-green-700 hover:text-green-900 font-bold text-lg">&times;</button>
                    </div>
                @endif

                <!-- Error Flash Message -->
                @if (session('error'))
                    <div id="error-alert" class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg flex justify-between items-center text-sm lg:text-base">
                        <div class="flex items-center gap-2">
                            <span class="text-lg">✗</span>
                            <span>{{ session('error') }}</span>
                        </div>
                        <button onclick="dismissAlert('error-alert')" class="text-red-700 hover:text-red-900 font-bold text-lg">&times;</button>
                    </div>
                @endif

                <!-- Validation Errors -->
                @if ($errors->any())
                    <div id="errors-alert" class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg text-sm lg:text-base">
                        <div class="flex justify-between items-start mb-2">
                            <div class="flex items-center gap-2">
                                <span class="text-lg">⚠️</span>
                                <strong>Validation Errors:</strong>
                            </div>
                            <button onclick="dismissAlert('errors-alert')" class="text-red-700 hover:text-red-900 font-bold">&times;</button>
                        </div>
                        <ul class="list-disc list-inside space-y-1">
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

    <!-- CSS for animations -->
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.3s ease-in-out;
        }

        /* Hide scrollbar for sidebar on mobile */
        #sidebar::-webkit-scrollbar {
            width: 6px;
        }

        #sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        #sidebar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }
    </style>

    <!-- JavaScript for confirmations and alerts -->
    <script>
        // Toggle sidebar on mobile
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        document.getElementById('sidebar-toggle').addEventListener('click', toggleSidebar);

        // Close sidebar when clicking on a link
        document.querySelectorAll('#sidebar a').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 1024) {
                    toggleSidebar();
                }
            });
        });

        // Auto-dismiss success alerts after 5 seconds
        function autoDismissAlert(id, delay = 5000) {
            setTimeout(() => {
                const alert = document.getElementById(id);
                if (alert) {
                    alert.style.animation = 'fadeIn 0.3s ease-in-out reverse';
                    setTimeout(() => {
                        alert.remove();
                    }, 300);
                }
            }, delay);
        }

        // Manual dismiss function
        function dismissAlert(id) {
            const alert = document.getElementById(id);
            if (alert) {
                alert.style.animation = 'fadeIn 0.3s ease-in-out reverse';
                setTimeout(() => {
                    alert.remove();
                }, 300);
            }
        }

        // Auto-dismiss success alerts
        const successAlert = document.getElementById('success-alert');
        if (successAlert) {
            autoDismissAlert('success-alert', 5000);
        }

        // Delete confirmation
        function confirmDelete(form) {
            if (confirm('⚠️ Are you sure you want to delete this? This action cannot be undone.')) {
                form.submit();
            }
        }

        // Restore confirmation
        function confirmRestore(button) {
            if (confirm('♻️ Are you sure you want to restore this research title?')) {
                button.form.submit();
            }
        }

        // Force delete confirmation
        function confirmForceDelete(form) {
            if (confirm('🔥 Are you sure you want to PERMANENTLY delete this? This action cannot be undone.')) {
                form.submit();
            }
        }
    </script>
</body>
</html>
