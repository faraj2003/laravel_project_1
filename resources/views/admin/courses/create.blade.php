<x-app-layout>
    <div class="max-w-3xl mx-auto py-10">

        <h1 class="text-2xl font-bold mb-6">
            Create New Course
        </h1>

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.courses.store') }}">
            @csrf

            {{-- Title --}}
            <div class="mb-4">
                <label class="block font-medium mb-1">
                    Course Title
                </label>

                <input
                    type="text"
                    name="title"
                    class="w-full border rounded px-3 py-2"
                    required
                >
            </div>

            {{-- Description --}}
            <div class="mb-4">
                <label class="block font-medium mb-1">
                    Description
                </label>

                <textarea
                    name="description"
                    rows="4"
                    class="w-full border rounded px-3 py-2"
                ></textarea>
            </div>

            <div class="mb-4">
    <label class="block text-sm font-medium text-gray-700 mb-1">
        Price
    </label>

    <input
        type="number"
        name="price"
        step="0.01"
        min="0"
        value="{{ old('price', 0) }}"
        class="w-full border-gray-300 rounded shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
    >

    @error('price')
        <p class="text-red-500 text-sm mt-1">
            {{ $message }}
        </p>
    @enderror
</div>


            {{-- Submit --}}
            <button
                type="submit"
                class="px-6 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700"
            >
                Create Course
            </button>

        </form>

    </div>
</x-app-layout>
