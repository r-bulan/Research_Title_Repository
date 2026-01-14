<x-app-layout :title="'Categories'">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900"> Categories</h1>
        <a href="{{ route('categories.create') }}" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
             Add Category
        </a>
    </div>

    <!-- Categories Table -->
    <div class="bg-white rounded-lg shadow-sm border border-neutral-200 overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-neutral-200">
                <tr>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Category Name</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Research Titles</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-neutral-200">
                @forelse ($categories as $category)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 text-gray-900 font-medium">{{ $category->name }}</td>
                        <td class="px-6 py-4 text-gray-600">
                            <span class="inline-block px-3 py-1 bg-blue-100 text-blue-700 text-sm rounded-full">
                                {{ $category->research_titles_count }} titles
                            </span>
                        </td>
                        <td class="px-6 py-4 space-x-2">
                            <a href="{{ route('categories.edit', $category) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                Edit
                            </a>
                            <form method="POST" action="{{ route('categories.destroy', $category) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button 
                                    type="button" 
                                    onclick="confirmDelete(this.form)" 
                                    class="text-red-600 hover:text-red-800 text-sm font-medium"
                                >
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-8 text-center text-gray-500">
                            No categories found. <a href="{{ route('categories.create') }}" class="text-blue-600 hover:underline">Create one</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
