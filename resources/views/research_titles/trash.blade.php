<x-app-layout :title="'Trash'">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Trashed Research Titles</h1>
        <a href="{{ route('research_titles.index') }}" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium">
            ← Back to Research Titles
        </a>
    </div>

    <!-- Search and Filter -->
    <div class="bg-white rounded-lg shadow-sm border border-neutral-200 p-6 mb-6">
        <form method="GET" action="{{ route('research_titles.trash') }}" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}" 
                        placeholder="Title, author, or email"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                    >
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                    <select name="category_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-end gap-2">
                    <button type="submit" class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium">
                        Search
                    </button>
                    <a href="{{ route('research_titles.trash') }}" class="flex-1 px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition text-center font-medium">
                        Clear
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- Trashed Items Table -->
    <div class="bg-white rounded-lg shadow-sm border border-neutral-200 overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-neutral-200">
                <tr>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Author</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Title</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Category</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Deleted</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-neutral-200">
                @forelse ($researchTitles as $title)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                @if ($title->photo)
                                    <img src="{{ $title->photo_url }}" alt="{{ $title->author_name }}" class="w-10 h-10 rounded-full object-cover">
                                @else
                                    <div class="w-10 h-10 rounded-full bg-gray-400 flex items-center justify-center text-white text-xs font-bold">
                                        {{ $title->initials }}
                                    </div>
                                @endif
                                <span class="text-gray-900 font-medium">{{ $title->author_name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-900">{{ Str::limit($title->title, 40) }}</td>
                        <td class="px-6 py-4">
                            <span class="inline-block px-3 py-1 bg-blue-100 text-blue-700 text-xs rounded-full font-medium">
                                {{ $title->category->name }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-gray-600 text-sm">{{ $title->deleted_at->format('M d, Y') }}</td>
                        <td class="px-6 py-4 space-x-2">
                            <form method="POST" action="{{ route('research_titles.restore', $title->id) }}" style="display:inline;">
                                @csrf
                                <button 
                                    type="button" 
                                    onclick="confirmRestore(this)" 
                                    class="text-green-600 hover:text-green-800 text-sm font-medium"
                                >
                                    Restore
                                </button>
                            </form>
                            <form method="DELETE" action="{{ route('research_titles.forceDelete', $title->id) }}" style="display:inline;">
                                @csrf
                                <button 
                                    type="button" 
                                    onclick="confirmForceDelete(this.form)" 
                                    class="text-red-600 hover:text-red-800 text-sm font-medium"
                                >
                                    Delete Permanently
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                            No trashed research titles. <a href="{{ route('research_titles.index') }}" class="text-blue-600 hover:underline font-medium">Go to active titles</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if ($researchTitles->hasPages())
        <div class="mt-6">
            {{ $researchTitles->links() }}
        </div>
    @endif
</x-app-layout>
