<x-app-layout>
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        
        {{-- Back Navigation --}}
        <div class="mb-6">
            <a href="{{ route('courses.show', $episode->course) }}" class="text-indigo-600 hover:text-indigo-800 font-medium flex items-center">
                &larr; Back to {{ $episode->course->title }}
            </a>
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-8">
                
                {{-- Episode Header --}}
                <div class="border-b pb-6 mb-6">
                    <span class="text-sm font-bold text-indigo-500 uppercase tracking-wide">
                        Episode {{ $episode->order }}
                    </span>
                    <h1 class="text-3xl font-bold text-gray-900 mt-2">
                        {{ $episode->title }}
                    </h1>
                </div>

                {{-- Episode Content --}}
                <div class="prose max-w-none text-gray-800 leading-relaxed">
                    {{-- 
                        NOTE: We use {!! !!} to allow HTML if you use a rich text editor later. 
                        nl2br() converts line breaks to <br> tags. 
                    --}}
                    {!! nl2br(e($episode->content)) !!}
                </div>

                {{-- Next/Prev Navigation (Optional Polish) --}}
                <div class="mt-12 flex justify-between border-t pt-6">
                    @php
                        $prev = $episode->course->episodes()->where('order', '<', $episode->order)->orderBy('order', 'desc')->first();
                        $next = $episode->course->episodes()->where('order', '>', $episode->order)->orderBy('order', 'asc')->first();
                    @endphp

                    <div>
                        @if($prev)
                            <a href="{{ route('episodes.show', $prev) }}" class="text-gray-600 hover:text-indigo-600 font-medium">
                                &laquo; Previous: {{ $prev->title }}
                            </a>
                        @endif
                    </div>
                    
                    <div>
                        @if($next)
                            <a href="{{ route('episodes.show', $next) }}" class="text-gray-600 hover:text-indigo-600 font-medium">
                                Next: {{ $next->title }} &raquo;
                            </a>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>