<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Learning Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <h3 class="text-xl font-bold mb-6 text-gray-800">My Enrolled Courses</h3>

                    @forelse ($courses as $course)
                        <div class="border-b border-gray-200 py-6 last:border-0">
                            <div class="flex flex-col md:flex-row md:items-center justify-between">
                                <div class="flex-1">
                                    <h4 class="text-lg font-semibold text-indigo-700">
                                        <a href="{{ route('courses.show', $course) }}" class="hover:underline">
                                            {{ $course->title }}
                                        </a>
                                    </h4>
                                    <p class="text-sm text-gray-500">
                                        Instructor: {{ $course->teacher->name ?? 'Unknown' }}
                                    </p>
                                </div>
                                
                                <div class="mt-4 md:mt-0 flex items-center space-x-4">
                                    {{-- PROGRESS BAR SECTION --}}
                                    <div class="w-48">
                                        <div class="flex justify-between mb-1">
                                            <span class="text-xs font-medium text-indigo-600">{{ $course->progress }}% Complete</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div class="bg-indigo-600 h-2 rounded-full transition-all duration-500" 
                                                 style="width: {{ $course->progress }}%"></div>
                                        </div>
                                    </div>

                                    <a href="{{ route('courses.show', $course) }}"
                                       class="px-4 py-2 bg-indigo-600 text-white text-sm font-bold rounded-lg shadow hover:bg-indigo-700 transition">
                                        {{ $course->progress > 0 ? 'Continue' : 'Start' }} Learning
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12 bg-gray-50 rounded-lg border border-dashed border-gray-300">
                            <p class="text-gray-500 text-lg">You haven't enrolled in any courses yet.</p>
                            <a href="{{ route('courses.index') }}" class="mt-4 inline-block text-indigo-600 font-bold hover:underline">
                                Browse All Courses &rarr;
                            </a>
                        </div>
                    @endforelse

                </div>
            </div>
        </div>
    </div>
</x-app-layout>