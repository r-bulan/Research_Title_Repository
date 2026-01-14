<x-app-layout title="Research Titles">
    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4 mb-6">
        <h1 class="text-2xl lg:text-3xl font-bold text-gray-900">Research Titles</h1>
        <div class="flex flex-col sm:flex-row gap-2 w-full lg:w-auto">
            <a href="{{ route('research_titles.create') }}" class="px-4 lg:px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium inline-block text-center text-sm lg:text-base">
                 Add Research Title
            </a>
            <a href="{{ route('research_titles.export', request()->query()) }}" class="px-4 lg:px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-medium inline-block text-center text-sm lg:text-base">
                Export PDF
            </a>
        </div>
    </div>

    <!-- Search and Filter -->
    <div class="bg-white rounded-lg shadow-sm border border-neutral-200 p-4 lg:p-6 mb-6 overflow-x-auto">
        <form method="GET" action="{{ route('research_titles.index') }}" class="space-y-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}" 
                        placeholder="Title, author, or email"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                    >
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                    <select name="category_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-end gap-2">
                    <button type="submit" class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium text-sm">
                        Search
                    </button>
                </div>
                <div class="flex items-end">
                    <a href="{{ route('research_titles.index') }}" class="w-full px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition text-center font-medium text-sm">
                        Clear
                    </a>
                </div>
            </div>

            <!-- Active Filters Display -->
            @if (request('search') || request('category_id'))
                <div class="mt-4 p-3 bg-blue-50 border border-blue-200 rounded-lg overflow-x-auto">
                    <p class="text-xs lg:text-sm text-blue-800 whitespace-nowrap">
                        <strong>Filters:</strong>
                        @if (request('search'))
                            <span class="inline-block ml-2 px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs">
                                {{ Str::limit(request('search'), 20) }} <a href="{{ route('research_titles.index', array_merge(request()->query(), ['search' => null])) }}" class="ml-1 font-bold">✕</a>
                            </span>
                        @endif
                        @if (request('category_id'))
                            <span class="inline-block ml-2 px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs">
                                {{ Str::limit($categories->find(request('category_id'))->name ?? 'Unknown', 20) }} <a href="{{ route('research_titles.index', array_merge(request()->query(), ['category_id' => null])) }}" class="ml-1 font-bold">✕</a>
                            </span>
                        @endif
                    </p>
                </div>
            @endif
        </form>
    </div>

    <!-- Research Titles Table - Responsive -->
    <div class="bg-white rounded-lg shadow-sm border border-neutral-200 overflow-x-auto">
        <table class="w-full min-w-full">
            <thead class="bg-gray-50 border-b border-neutral-200">
                <tr>
                    <th class="px-4 lg:px-6 py-4 text-left text-xs lg:text-sm font-semibold text-gray-700">Author</th>
                    <th class="px-4 lg:px-6 py-4 text-left text-xs lg:text-sm font-semibold text-gray-700 hidden sm:table-cell">Title</th>
                    <th class="px-4 lg:px-6 py-4 text-left text-xs lg:text-sm font-semibold text-gray-700 hidden md:table-cell">Category</th>
                    <th class="px-4 lg:px-6 py-4 text-left text-xs lg:text-sm font-semibold text-gray-700 hidden lg:table-cell">Email</th>
                    <th class="px-4 lg:px-6 py-4 text-left text-xs lg:text-sm font-semibold text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-neutral-200">
                @forelse ($researchTitles as $title)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 lg:px-6 py-4">
                            <div class="flex items-center gap-2 lg:gap-3">
                                @if ($title->photo)
                                    <img src="{{ $title->photo_url }}" alt="{{ $title->author_name }}" class="w-8 h-8 lg:w-10 lg:h-10 rounded-full object-cover border-2 border-gray-200">
                                @else
                                    <div class="w-8 h-8 lg:w-10 lg:h-10 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white text-xs font-bold shadow-md">
                                        {{ $title->initials }}
                                    </div>
                                @endif
                                <span class="text-gray-900 font-medium text-xs lg:text-sm line-clamp-1">{{ Str::limit($title->author_name, 15) }}</span>
                            </div>
                        </td>
                        <td class="px-4 lg:px-6 py-4 text-gray-900 hidden sm:table-cell">
                            <span class="text-xs lg:text-sm line-clamp-1">{{ Str::limit($title->title, 30) }}</span>
                        </td>
                        <td class="px-4 lg:px-6 py-4 hidden md:table-cell">
                            <span class="inline-block px-2 lg:px-3 py-1 bg-blue-100 text-blue-700 text-xs rounded-full font-medium">
                                {{ Str::limit($title->category->name, 12) }}
                            </span>
                        </td>
                        <td class="px-4 lg:px-6 py-4 text-gray-600 hidden lg:table-cell text-xs lg:text-sm">
                            {{ Str::limit($title->email, 25) }}
                        </td>
                        <td class="px-4 lg:px-6 py-4">
                            <div class="flex flex-wrap gap-1 lg:gap-2">
                                <a href="{{ route('research_titles.show', $title) }}" class="text-blue-600 hover:text-blue-800 text-xs lg:text-sm font-medium whitespace-nowrap">
                                    View
                                </a>
                                <a href="{{ route('research_titles.edit', $title) }}" class="text-green-600 hover:text-green-800 text-xs lg:text-sm font-medium whitespace-nowrap">
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('research_titles.destroy', $title) }}" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button 
                                        type="button" 
                                        onclick="confirmDelete(this.form)" 
                                        class="text-red-600 hover:text-red-800 text-xs lg:text-sm font-medium whitespace-nowrap"
                                    >
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 lg:px-6 py-8 text-center text-gray-500">
                            <div class="flex flex-col items-center gap-2">
                                <span class="text-3xl lg:text-5xl">📭</span>
                                <span class="text-sm lg:text-base">No research titles found.</span>
                                @if (request('search') || request('category_id'))
                                    <a href="{{ route('research_titles.index') }}" class="text-blue-600 hover:underline font-medium text-xs lg:text-sm mt-2">Clear filters and try again</a>
                                @else
                                    <a href="{{ route('research_titles.create') }}" class="text-blue-600 hover:underline font-medium text-xs lg:text-sm mt-2">Create the first one</a>
                                @endif
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
