<x-app-layout>
    <div class="max-w-4xl mx-auto py-8">

        {{-- Page Header --}}
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900">
                Create New Course
            </h1>

            <p class="mt-2 text-gray-600">
                Fill in the details below to add a new course.
            </p>
        </div>

        {{-- Create Course Form --}}
        <form
            method="POST"
            action="{{ route('admin.courses.store') }}"
            enctype="multipart/form-data"
            class="space-y-6"
        >
            @csrf

            {{-- Title --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">
                    Course Title
                </label>

                <input
                    type="text"
                    name="title"
                    value="{{ old('title') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    required
                >
            </div>

            {{-- Description --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">
                    Description
                </label>

                <textarea
                    name="description"
                    rows="4"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                >{{ old('description') }}</textarea>
            </div>

            {{-- Price --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">
                    Price (₹ or $)
                </label>

                <input
                    type="number"
                    name="price"
                    min="0"
                    step="0.01"
                    value="{{ old('price', 0) }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                >
            </div>

            {{-- Thumbnail --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">
                    Course Thumbnail
                </label>

                <input
                    type="file"
                    name="thumbnail"
                    accept="image/*"
                    class="mt-1 block w-full text-sm text-gray-600"
                >
            </div>

            {{-- Actions --}}
            <div class="flex items-center justify-between pt-4">
                <a
                    href="{{ route('admin.courses.index') }}"
                    class="text-sm text-gray-600 hover:underline"
                >
                    ← Back to Courses
                </a>

                <button
                    type="submit"
                    class="px-6 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700"
                >
                    Create Course
                </button>
            </div>

        </form>

    </div>
</x-app-layout>
