<x-app-layout>
    <div class="max-w-5xl mx-auto py-8">

        <h1 class="text-2xl font-bold mb-6">
            Available Courses
        </h1>

        @foreach ($courses as $course)
            <div class="p-4 mb-4 border rounded">
                <h2 class="text-lg font-semibold">
                    <a href="{{ route('courses.show', $course) }}">
                        {{ $course->title }}
                    </a>
                </h2>

                <p class="text-sm text-gray-600">
                    Instructor: {{ $course->teacher->name }}
                </p>
            </div>
        @endforeach

    </div>
</x-app-layout>
