<x-app-layout :title="'Research Title Details'">
    <div class="max-w-2xl">
        <div class="bg-white rounded-lg shadow-sm border border-neutral-200 p-6">
            <div class="flex justify-between items-start mb-6">
                <h1 class="text-2xl font-bold text-gray-900">{{ $researchTitle->title }}</h1>
                <div class="space-x-2">
                    <a href="{{ route('research_titles.edit', $researchTitle) }}" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition inline-block">
                        Edit
                    </a>
                    <a href="{{ route('research_titles.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition inline-block">
                        Back
                    </a>
                </div>
            </div>

            <div class="flex items-center gap-4 mb-6">
                @if ($researchTitle->photo)
                    <img src="{{ $researchTitle->photo_url }}" alt="{{ $researchTitle->author_name }}" class="w-20 h-20 rounded-full object-cover">
                @else
                    <div class="w-20 h-20 rounded-full bg-blue-500 flex items-center justify-center text-white text-2xl font-bold">
                        {{ $researchTitle->initials }}
                    </div>
                @endif
                <div>
                    <h2 class="text-xl font-semibold text-gray-900">{{ $researchTitle->author_name }}</h2>
                    <p class="text-gray-600">{{ $researchTitle->email }}</p>
                </div>
            </div>

            <hr class="my-6">

            <div class="space-y-6">
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                        <p class="text-gray-900">{{ $researchTitle->category->name }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Created</label>
                        <p class="text-gray-900">{{ $researchTitle->created_at->format('M d, Y') }}</p>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Research Title</label>
                    <p class="text-gray-900 text-lg">{{ $researchTitle->title }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
