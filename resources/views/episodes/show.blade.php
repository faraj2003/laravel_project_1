<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        
        <div class="lg:flex lg:space-x-8">
            
            {{-- COLUMN 1: Main Video Player --}}
            <div class="lg:w-2/3">
                
                {{-- THE ULTIMATE FIXED 16:9 CONTAINER --}}
                {{-- We use inline styles here to bypass any Tailwind version conflicts completely --}}
                <div style="position: relative; width: 100%; padding-top: 56.25%; background-color: #000; border-radius: 0.75rem; overflow: hidden; margin-bottom: 1.5rem; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);"> 
                    @if($episode->video_path)
                        @php
                            // Safely handle both external test URLs and local storage files
                            $videoUrl = Str::startsWith($episode->video_path, ['http://', 'https://']) 
                                ? $episode->video_path 
                                : asset(Storage::url($episode->video_path));
                        @endphp
                        
                        <video 
                            controls 
                            preload="metadata" 
                            playsinline
                            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: contain; z-index: 10;"
                        >
                            <source src="{{ $videoUrl }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    @else
                        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; background-color: #111827; color: #6b7280;">
                            <svg style="width: 3rem; height: 3rem; margin-bottom: 0.75rem; opacity: 0.3;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                            </svg>
                            <p style="font-size: 0.875rem; font-weight: 600;">Video content is being processed...</p>
                        </div>
                    @endif
                </div>

                {{-- 2. Title, Completion Button & Navigation --}}
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 mb-6">
                    <div class="flex flex-col md:flex-row md:justify-between md:items-start mb-6 gap-4">
                        <div class="flex-1">
                            <nav class="flex text-xs font-bold text-indigo-600 uppercase tracking-widest mb-2">
                                <span>{{ $episode->course->title }}</span>
                                <span class="mx-2 text-gray-300">/</span>
                                <span class="text-gray-500">Lesson {{ $episode->order }}</span>
                            </nav>
                            <h1 class="text-3xl font-extrabold text-gray-900 leading-tight">
                                {{ $episode->title }}
                            </h1>
                        </div>

                        {{-- COMPLETION BUTTON --}}
                        <div class="flex-shrink-0">
                            @php
                                $isCompleted = auth()->user()->episodes->contains($episode->id);
                            @endphp

                            @if($isCompleted)
                                <div class="inline-flex items-center px-5 py-2.5 bg-green-50 border border-green-200 text-green-700 font-bold rounded-full text-sm">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    Lesson Finished
                                </div>
                            @else
                                <form action="{{ route('episodes.complete', $episode) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 transition shadow-md hover:scale-105 active:scale-95">
                                        Mark as Complete
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>

                    <div class="border-t border-gray-100 pt-6">
                        <div class="prose max-w-none text-gray-600 leading-relaxed">
                             {!! nl2br(e($episode->content)) !!}
                        </div>
                    </div>

                    {{-- Navigation --}}
                    <div class="flex justify-between items-center mt-10 pt-6 border-t border-gray-100">
                        @php
                            $prev = $episode->course->episodes->where('order', '<', $episode->order)->last();
                            $next = $episode->course->episodes->where('order', '>', $episode->order)->first();
                        @endphp

                        <div>
                            @if($prev)
                                <a href="{{ route('episodes.show', $prev) }}" class="flex items-center text-sm font-bold text-gray-500 hover:text-indigo-600 transition">
                                    <span class="mr-2">&larr;</span> Previous
                                </a>
                            @endif
                        </div>
                        <div>
                            @if($next)
                                <a href="{{ route('episodes.show', $next) }}" class="flex items-center text-sm font-bold text-gray-500 hover:text-indigo-600 transition">
                                    Next <span class="ml-2">&rarr;</span>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- COLUMN 2: Sidebar Playlist --}}
            <div class="lg:w-1/3 mt-8 lg:mt-0">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden sticky top-6">
                    <div class="bg-gray-50 px-5 py-4 border-b border-gray-100">
                        <h3 class="font-bold text-gray-900">Course Content</h3>
                        <div class="flex items-center mt-2">
                             <div class="w-full bg-gray-200 rounded-full h-1.5 mr-3">
                                <div class="bg-indigo-600 h-1.5 rounded-full transition-all duration-700" style="width: {{ $episode->course->progress }}%"></div>
                             </div>
                             <span class="text-xs font-bold text-gray-500">{{ $episode->course->progress }}%</span>
                        </div>
                    </div>

                    <div class="max-h-[600px] overflow-y-auto">
                        @foreach($episode->course->episodes as $sidebarEpisode)
                            @php
                                $isActive = $sidebarEpisode->id === $episode->id;
                                $sidebarCompleted = auth()->user()->episodes->contains($sidebarEpisode->id);
                            @endphp

                            <a href="{{ route('episodes.show', $sidebarEpisode) }}" 
                               class="group block px-5 py-4 border-b border-gray-50 hover:bg-gray-50 transition {{ $isActive ? 'bg-indigo-50/50 border-l-4 border-l-indigo-600' : '' }}">
                                <div class="flex items-center gap-3">
                                    <div class="flex-shrink-0">
                                        @if($sidebarCompleted)
                                            <div class="text-green-500 bg-green-50 rounded-full p-1">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                            </div>
                                        @elseif($isActive)
                                            <div class="text-indigo-600">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path></svg>
                                            </div>
                                        @else
                                            <span class="text-xs font-bold text-gray-300 w-5 text-center">{{ $sidebarEpisode->order }}</span>
                                        @endif
                                    </div>
                                    
                                    <div class="min-w-0 flex-1">
                                        <p class="text-sm font-semibold truncate {{ $isActive ? 'text-indigo-900' : ($sidebarCompleted ? 'text-gray-400' : 'text-gray-700') }}">
                                            {{ $sidebarEpisode->title }}
                                        </p>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>