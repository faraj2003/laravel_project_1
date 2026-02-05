<x-app-layout>
    <div class="max-w-3xl mx-auto py-10">
        <h1 class="text-2xl font-bold mb-6">Edit Course: {{ $course->title }}</h1>

        <form method="POST" action="{{ route('admin.courses.update', $course) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Title --}}
            <div class="mb-4">
                <label class="block font-medium mb-1">Title</label>
                <input type="text" name="title" value="{{ old('title', $course->title) }}" class="w-full border rounded px-3 py-2" required>
            </div>

            {{-- Description --}}
            <div class="mb-4">
                <label class="block font-medium mb-1">Description</label>
                <textarea name="description" rows="4" class="w-full border rounded px-3 py-2" required>{{ old('description', $course->description) }}</textarea>
            </div>

            {{-- Price --}}
            <div class="mb-4">
                <label class="block font-medium mb-1">Price</label>
                <input type="number" name="price" step="0.01" value="{{ old('price', $course->price) }}" class="w-full border rounded px-3 py-2" required>
            </div>

            {{-- Current Thumbnail --}}
            @if($course->thumbnail)
                <div class="mb-4">
                    <p class="mb-1 text-sm text-gray-600">Current Thumbnail:</p>
                    <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="Thumbnail" class="w-32 h-32 object-cover rounded border">
                </div>
            @endif

            {{-- New Thumbnail --}}
            <div class="mb-4">
                <label class="block font-medium mb-1">Change Thumbnail (Optional)</label>
                <input type="file" name="thumbnail" class="w-full border rounded px-3 py-2">
            </div>

            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700">
                Update Course
            </button>
        </form>
    </div>
</x-app-layout>