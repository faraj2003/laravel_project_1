<x-app-layout>
    <div class="max-w-5xl mx-auto py-8">

        {{-- Page Header --}}
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold">
                Admin — Manage Courses
            </h1>

            {{-- Create Course Button --}}
            <a href="{{ route('admin.courses.create') }}"
               class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                + Create Course
            </a>
        </div>

        {{-- Courses List --}}
        @forelse($courses as $course)

            <div class="p-4 mb-4 border rounded bg-white flex justify-between items-center">

                {{-- Course Info --}}
                <div>
                    <h2 class="font-semibold text-lg">
                        {{ $course->title }}
                    </h2>

                    <p class="text-sm text-gray-500">
                        Status:
                        @if($course->is_published)
                            <span class="text-green-600 font-medium">
                                Published
                            </span>
                        @else
                            <span class="text-red-600 font-medium">
                                Unpublished
                            </span>
                        @endif
                    </p>
                </div>

                {{-- Toggle Publish --}}
                <form method="POST"
                      action="{{ route('admin.courses.toggle', $course) }}">
                    @csrf
                    @method('PATCH')

                    <button
                        class="px-4 py-2 text-white rounded
                        {{ $course->is_published
                            ? 'bg-red-600 hover:bg-red-700'
                            : 'bg-green-600 hover:bg-green-700' }}">
                        
                        {{ $course->is_published ? 'Unpublish' : 'Publish' }}

                    </button>
                </form>

            </div>

        @empty

            <div class="p-4 border rounded bg-gray-50 text-gray-500">
                No courses found. Create your first course 🚀
            </div>

        @endforelse

    </div>
</x-app-layout>
