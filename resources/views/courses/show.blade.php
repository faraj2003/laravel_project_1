<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    {{-- Course Header --}}
                    <div class="mb-8 border-b pb-6">
                        <h1 class="text-4xl font-bold mb-4">{{ $course->title }}</h1>
                        <p class="text-lg text-gray-600 mb-4">{{ $course->description }}</p>
                        
                        <div class="flex items-center text-sm text-gray-500 space-x-4">
                            <span>🎓 Teacher: {{ $course->teacher->name ?? 'Unknown' }}</span>
                            <span>📅 Published: {{ $course->created_at->format('M d, Y') }}</span>
                            <span class="bg-indigo-100 text-indigo-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                {{ $course->price > 0 ? '₹' . $course->price : 'Free' }}
                            </span>
                        </div>
                    </div>

                    {{-- Episodes List --}}
                    <h2 class="text-2xl font-bold mb-4">Episodes ({{ $course->episodes->count() }})</h2>
                    
                    <div class="space-y-4">
                        @forelse($course->episodes as $episode)
                            <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                                <div class="flex items-center space-x-3">
                                    <span class="flex-shrink-0 w-8 h-8 flex items-center justify-center bg-indigo-600 text-white rounded-full text-sm font-bold">
                                        {{ $loop->iteration }}
                                    </span>
                                    <h3 class="text-lg font-medium text-gray-900">
                                        {{ $episode->title }}
                                    </h3>
                                </div>
                                
                                {{-- ENABLED LINK: Clicking this takes you to the video player --}}
                                <a href="{{ route('episodes.show', $episode) }}" class="text-indigo-600 hover:text-indigo-900 font-medium text-sm flex items-center">
                                    <span class="mr-1">Watch Now</span>
                                    <span>&rarr;</span>
                                </a>
                            </div>
                        @empty
                            <p class="text-gray-500 italic">No episodes uploaded yet. Stay tuned!</p>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>