<x-app-layout title="Trash">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900"> Trashed Research Titles</h1>
        <a href="{{ route('research_titles.index') }}" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium">
             Back to Research Titles
        </a>
    </div>

    <!-- Search and Filter -->
    <div class="bg-white rounded-lg shadow-sm border border-neutral-200 p-6 mb-6">
        <form method="GET" action="{{ route('research_titles.trash') }}" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}" 
                        placeholder="Title, author, or email"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    >
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                    <select name="category_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
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
                </div>
                <div class="flex items-end">
                    <a href="{{ route('research_titles.trash') }}" class="w-full px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition text-center font-medium">
                         Clear Filters
                    </a>
                </div>
            </div>

            <!-- Active Filters Display -->
            @if (request('search') || request('category_id'))
                <div class="mt-4 p-3 bg-orange-50 border border-orange-200 rounded-lg">
                    <p class="text-sm text-orange-800">
                        <strong>Active Filters:</strong>
                        @if (request('search'))
                            <span class="inline-block ml-2 px-3 py-1 bg-orange-100 text-orange-700 rounded-full text-xs">
                                Search: "{{ request('search') }}" 
                                <a href="{{ route('research_titles.trash', array_merge(request()->query(), ['search' => null])) }}" class="ml-1 font-bold">✕</a>
                            </span>
                        @endif
                        @if (request('category_id'))
                            <span class="inline-block ml-2 px-3 py-1 bg-orange-100 text-orange-700 rounded-full text-xs">
                                Category: "{{ $categories->find(request('category_id'))->name ?? 'Unknown' }}" 
                                <a href="{{ route('research_titles.trash', array_merge(request()->query(), ['category_id' => null])) }}" class="ml-1 font-bold">✕</a>
                            </span>
                        @endif
                    </p>
                </div>
            @endif
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
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Deleted On</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-neutral-200">
                @forelse ($researchTitles as $title)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                @if ($title->photo)
                                    <img src="{{ $title->photo_url }}" alt="{{ $title->author_name }}" class="w-10 h-10 rounded-full object-cover border-2 border-gray-200 opacity-60">
                                @else
                                    <div class="w-10 h-10 rounded-full bg-gray-400 flex items-center justify-center text-white text-xs font-bold shadow-md opacity-60">
                                        {{ $title->initials }}
                                    </div>
                                @endif
                                <span class="text-gray-900 font-medium">{{ $title->author_name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-900">{{ Str::limit($title->title, 50) }}</td>
                        <td class="px-6 py-4">
                            <span class="inline-block px-3 py-1 bg-gray-100 text-gray-700 text-xs rounded-full font-medium">
                                {{ $title->category->name }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-gray-600 text-sm">
                            <div>
                                <div>{{ $title->deleted_at->format('M d, Y') }}</div>
                                <div class="text-xs text-gray-500">{{ $title->deleted_at->diffForHumans() }}</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 space-x-2">
                            <!-- Restore Form (FIXED) -->
                            <form method="POST" action="{{ route('research_titles.restore', $title->id) }}" style="display:inline;">
                                @csrf
                                <button 
                                    type="button" 
                                    onclick="confirmRestore(this.form)" 
                                    class="text-green-600 hover:text-green-800 text-sm font-medium hover:underline"
                                >
                                     Restore
                                </button>
                            </form>

                            <!-- Force Delete Form (CORRECT) -->
                            <form method="POST" action="{{ route('research_titles.forceDelete', $title->id) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button 
                                    type="button" 
                                    onclick="confirmForceDelete(this.form)" 
                                    class="text-red-600 hover:text-red-800 text-sm font-medium hover:underline"
                                >
                                     Delete Permanently
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                            <div class="flex flex-col items-center gap-2">
                                <span class="text-5xl">✅</span>
                                <span class="text-lg font-medium">No trashed research titles</span>
                                <p class="text-sm">Your trash is clean!</p>
                                <a href="{{ route('research_titles.index') }}" class="text-blue-600 hover:underline font-medium text-sm mt-4">Go to active titles</a>
                            </div>
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
