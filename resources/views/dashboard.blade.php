<x-app-layout title="Dashboard">
    <div class="grid auto-rows-min gap-4 md:grid-cols-3">
        <!-- Total Research Titles Card -->
        <div class="overflow-hidden rounded-xl border border-neutral-200 p-6 bg-white shadow-sm dark:border-neutral-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Total CCS Research Titles</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $totalTitles ?? 0 }}</p>
                </div>
                <div class="text-5xl">📚</div>
            </div>
        </div>

        <!-- Active Research Titles Card -->
        <div class="overflow-hidden rounded-xl border border-neutral-200 p-6 bg-white shadow-sm dark:border-neutral-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Active CCS Research Titles</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $activeTitles ?? 0 }}</p>
                </div>
                <div class="text-5xl">✅</div>
            </div>
        </div>

        <!-- Trashed Research Titles Card -->
        <div class="overflow-hidden rounded-xl border border-neutral-200 p-6 bg-white shadow-sm dark:border-neutral-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">Trashed CCS Research Titles</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $trashedTitles ?? 0 }}</p>
                </div>
                <div class="text-5xl">🗑️</div>
            </div>
        </div>
    </div>

    <!-- Content Section -->
    <div class="mt-6 rounded-xl border border-neutral-200 p-6 bg-white shadow-sm">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Dashboard Overview</h2>
        <div class="space-y-3 text-sm text-neutral-600">
            <p>📊 <strong>Total Research Titles:</strong> {{ $totalTitles ?? 0 }} titles in the CCS repository</p>
            <p>✅ <strong>Active Titles:</strong> {{ $activeTitles ?? 0 }} available for viewing and management</p>
            <p>🗑️ <strong>Trashed Titles:</strong> {{ $trashedTitles ?? 0 }} items in recycle bin</p>
            <hr class="my-4">
            <p class="text-xs text-neutral-500">CCS Research Title Repository - College of Computer Studies Department</p>
        </div>
    </div>
</x-app-layout>
