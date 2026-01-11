<x-app-layout title="Edit Research Title">
    <div class="max-w-2xl">
        <form method="POST" action="{{ route('research_titles.update', $researchTitle) }}" enctype="multipart/form-data" class="bg-white rounded-lg shadow-sm border border-neutral-200 p-6 space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Research Title *</label>
                <input 
                    type="text" 
                    name="title" 
                    id="title" 
                    value="{{ old('title', $researchTitle->title) }}" 
                    placeholder="e.g., AI-Based Attendance Monitoring System"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('title') border-red-500 @enderror"
                >
                @error('title')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="author_name" class="block text-sm font-medium text-gray-700 mb-2">Author Name *</label>
                    <input 
                        type="text" 
                        name="author_name" 
                        id="author_name" 
                        value="{{ old('author_name', $researchTitle->author_name) }}" 
                        placeholder="e.g., Juan Dela Cruz"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('author_name') border-red-500 @enderror"
                    >
                    @error('author_name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        value="{{ old('email', $researchTitle->email) }}" 
                        placeholder="e.g., juan@ccs.edu"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror"
                    >
                    @error('email')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Category *</label>
                <select name="category_id" id="category_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('category_id') border-red-500 @enderror">
                    <option value="">Select a category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $researchTitle->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="photo" class="block text-sm font-medium text-gray-700 mb-2">Author Photo (JPG/PNG, max 2MB)</label>
                @if ($researchTitle->photo)
                    <div class="mb-4">
                        <p class="text-sm text-gray-600 mb-2">Current photo:</p>
                        <img src="{{ $researchTitle->photo_url }}" alt="{{ $researchTitle->author_name }}" class="w-20 h-20 rounded-lg object-cover">
                    </div>
                @endif
                <div class="mt-2">
                    <input 
                        type="file" 
                        name="photo" 
                        id="photo" 
                        accept="image/jpeg,image/png"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('photo') border-red-500 @enderror"
                        onchange="previewPhoto(event)"
                    >
                    @error('photo')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-gray-500 mt-2">Accepted formats: JPG, PNG. Maximum size: 2MB. Leave empty to keep current photo.</p>
                </div>
                <div id="preview" class="mt-4"></div>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium">
                    Update Research Title
                </button>
                <a href="{{ route('research_titles.index') }}" class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition font-medium">
                    Cancel
                </a>
            </div>
        </form>
    </div>

    <script>
        function previewPhoto(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('preview');
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.innerHTML = `<img src="${e.target.result}" alt="Preview" class="w-20 h-20 rounded-lg object-cover">`;
                };
                reader.readAsDataURL(file);
            } else {
                preview.innerHTML = '';
            }
        }
    </script>
</x-app-layout>
