@props(['course'])

<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-shadow duration-300 flex flex-col h-full">
    {{-- Thumbnail Section --}}
    <div class="h-48 w-full bg-gray-200 relative">
        @if($course->thumbnail)
            <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="{{ $course->title }}" class="w-full h-full object-cover">
        @else
            <div class="flex items-center justify-center h-full text-gray-400">
                <span class="text-4xl">📚</span>
            </div>
        @endif

        {{-- Badge Logic --}}
        @if($course->price == 0)
            <span class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded shadow">
                FREE
            </span>
        @else
            <span class="absolute top-2 right-2 bg-indigo-600 text-white text-xs font-bold px-2 py-1 rounded shadow">
                ${{ number_format($course->price, 2) }}
            </span>
        @endif
    </div>

    {{-- Content Section --}}
    <div class="p-6 flex flex-col flex-grow justify-between">
        <div>
            <h3 class="text-xl font-bold text-gray-900 mb-2 line-clamp-1">{{ $course->title }}</h3>
            <p class="text-gray-600 mb-4 line-clamp-2 text-sm">{{ $course->description }}</p>
        </div>
        
        <div class="flex items-center justify-between border-t pt-4 mt-auto">
            <div class="text-sm text-gray-500 flex items-center">
                <span class="mr-1">👨‍🏫</span> {{ $course->teacher->name }}
            </div>
            
            <a href="{{ route('courses.show', $course) }}" class="text-indigo-600 hover:text-indigo-900 font-medium text-sm flex items-center">
                View <span class="ml-1">&rarr;</span>
            </a>
        </div>
    </div>
</div>