<x-app-layout>
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Available Courses</h1>
            <p class="mt-2 text-gray-600">Browse our catalog and start learning today.</p>
        </div>

        @if($courses->isEmpty())
            <div class="text-center py-12 bg-white rounded-lg shadow-sm">
                <p class="text-gray-500 text-lg">No courses available yet. Check back soon!</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($courses as $course)
                    <x-course-card :course="$course" />
                @endforeach
            </div>
        @endif

    </div>
</x-app-layout>