<x-app-layout>
    
    <div class="bg-slate-900 text-white pt-12 pb-20 sm:pt-16 sm:pb-24 relative overflow-hidden -mt-8 mb-12 rounded-b-[2.5rem] shadow-2xl">
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-[500px] h-[500px] rounded-full bg-brand-500 blur-[120px] opacity-20 pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="max-w-3xl">
                <div class="inline-flex items-center px-4 py-1.5 rounded-full bg-slate-800/80 border border-slate-700 text-brand-400 text-xs font-bold uppercase tracking-widest mb-6 backdrop-blur-md shadow-sm">
                    {{ $course->category ?? 'Enterprise Module' }}
                </div>
                
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black tracking-tight mb-6 leading-[1.1]">
                    {{ $course->title ?? 'Course Title' }}
                </h1>
                
                <p class="text-lg sm:text-xl text-slate-300 mb-8 font-light leading-relaxed max-w-2xl">
                    {{ $course->description ?? 'Dive deep into this comprehensive module. Learn industry-standard practices, analyze data structures, and elevate your technical proficiency.' }}
                </p>

                <div class="flex flex-wrap items-center gap-6 sm:gap-8 text-sm text-slate-300 font-medium border-t border-slate-800 pt-6">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-lg bg-brand-500/20 flex items-center justify-center text-brand-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        </div>
                        <span>{{ isset($course->episodes) ? $course->episodes->count() : 0 }} Modules</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-lg bg-emerald-500/20 flex items-center justify-center text-emerald-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <span>Self-Paced Learning</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-lg bg-purple-500/20 flex items-center justify-center text-purple-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <span>Certificate Included</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">
            
            <div class="lg:col-span-8 space-y-8">
                <div>
                    <h2 class="text-2xl font-bold text-slate-900 mb-6 flex items-center gap-3">
                        Course Curriculum
                        <span class="px-2.5 py-0.5 rounded-md bg-slate-100 text-slate-600 text-xs font-bold">{{ isset($course->episodes) ? $course->episodes->count() : 0 }}</span>
                    </h2>
                    
                    @if(isset($course->episodes) && $course->episodes->count() > 0)
                        <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">
                            <ul class="divide-y divide-slate-100">
                                @foreach($course->episodes as $index => $episode)
                                    <li class="group hover:bg-slate-50 transition-colors">
                                        <a href="{{ route('episodes.show', $episode) }}" class="flex items-start sm:items-center gap-4 sm:gap-6 p-6">
                                            
                                            <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-slate-100 flex items-center justify-center text-slate-500 font-bold group-hover:bg-brand-100 group-hover:text-brand-600 transition-colors shadow-inner">
                                                {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                                            </div>
                                            
                                            <div class="flex-1 min-w-0">
                                                <h4 class="text-lg font-bold text-slate-900 mb-1 group-hover:text-brand-600 transition-colors truncate">
                                                    {{ $episode->title }}
                                                </h4>
                                                <p class="text-sm text-slate-500 line-clamp-1 sm:line-clamp-2">
                                                    {{ $episode->description ?? 'Explore the fundamentals and practical applications in this comprehensive learning module.' }}
                                                </p>
                                            </div>
                                            
                                            <div class="flex-shrink-0 text-slate-300 group-hover:text-brand-500 transition-colors hidden sm:block">
                                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @else
                        <div class="p-12 text-center bg-white rounded-2xl border border-slate-200 border-dashed">
                            <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            </div>
                            <h3 class="text-lg font-bold text-slate-900 mb-1">Curriculum Pending</h3>
                            <p class="text-sm text-slate-500 max-w-sm mx-auto">The instructor has not published any learning modules for this course yet. Check back soon.</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="lg:col-span-4">
                <div class="bg-white rounded-2xl border border-slate-200 shadow-xl shadow-slate-200/40 p-6 sticky top-28">
                    
                    <div class="mb-6">
                        <h3 class="text-xl font-bold text-slate-900 mb-2">Ready to master this?</h3>
                        <p class="text-sm text-slate-500">Enroll now to track your progress, access all modules, and earn your certification.</p>
                    </div>

                    <form action="#" method="POST">
                        @csrf
                        <button type="submit" class="w-full flex justify-center items-center gap-2 py-4 px-4 border border-transparent rounded-xl shadow-md text-sm font-bold text-white bg-brand-600 hover:bg-brand-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-600 transition-all hover:-translate-y-0.5 active:translate-y-0 mb-6">
                            Start Learning Now
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                        </button>
                    </form>

                    <ul class="space-y-4 text-sm text-slate-600 border-t border-slate-100 pt-6">
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>Full lifetime access to all course materials</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>Access on mobile, desktop, and tablet</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <span>Official Certificate of Completion</span>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>