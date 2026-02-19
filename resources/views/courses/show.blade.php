<x-app-layout>
    <x-slot name="header">
        <div class="pb-2">
            <div class="inline-flex items-center px-3 py-1 rounded-full bg-brand-50 text-brand-700 text-xs font-bold uppercase tracking-widest mb-4">
                {{ $course->category ?? 'Enterprise Module' }}
            </div>
            
            <h2 class="font-black text-3xl sm:text-4xl text-slate-900 leading-tight tracking-tight">
                {{ $course->title ?? 'Course Title' }}
            </h2>
            
            <p class="text-base text-slate-600 mt-4 max-w-3xl font-medium">
                {{ $course->description ?? 'Dive deep into this comprehensive module. Learn industry-standard practices, analyze data structures, and elevate your technical proficiency.' }}
            </p>

            <div class="flex flex-wrap items-center gap-6 text-sm text-slate-600 font-bold mt-6 pt-6 border-t border-slate-100">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    <span>{{ isset($course->episodes) ? $course->episodes->count() : 0 }} Modules</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>Self-Paced</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                    <span>24/7 Unlimited Access</span>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-8 p-4 rounded-xl bg-emerald-50 border border-emerald-100 flex items-center gap-3 text-emerald-800 font-bold shadow-sm">
                    <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">
                
                <div class="lg:col-span-8 space-y-6">
                    <h3 class="text-xl font-bold text-slate-900 flex items-center gap-3">
                        Course Curriculum
                        <span class="px-2.5 py-0.5 rounded-md bg-white border border-slate-200 shadow-sm text-slate-700 text-xs font-black">{{ isset($course->episodes) ? $course->episodes->count() : 0 }}</span>
                    </h3>
                    
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
                                                    {{ $episode->content ?? 'Explore the fundamentals and practical applications in this comprehensive learning module.' }}
                                                </p>
                                            </div>
                                            
                                            <div class="flex-shrink-0 text-slate-300 group-hover:text-brand-500 transition-colors hidden sm:block">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @else
                        <div class="p-12 text-center bg-white rounded-2xl border border-slate-200 border-dashed">
                            <h3 class="text-lg font-bold text-slate-900 mb-1">Curriculum Pending</h3>
                            <p class="text-sm text-slate-500">Modules are being published soon. Check back later.</p>
                        </div>
                    @endif
                </div>

                <div class="lg:col-span-4">
                    <div class="bg-white rounded-3xl border border-slate-200 shadow-2xl shadow-slate-200/50 overflow-hidden sticky top-8">
                        
                        @if(isset($course->thumbnail) && $course->thumbnail)
                            <div class="aspect-video w-full bg-slate-100">
                                <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="{{ $course->title }}" class="w-full h-full object-cover">
                            </div>
                        @else
                            <div class="aspect-video w-full bg-slate-900 flex items-center justify-center relative overflow-hidden">
                                <div class="absolute inset-0 bg-brand-500/20 blur-[50px] rounded-full mix-blend-screen translate-x-10 translate-y-10"></div>
                                <svg class="w-16 h-16 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif

                        <div class="p-6 sm:p-8">
                            
                            @php
                                $isEnrolled = auth()->check() && auth()->user()->role === 'student' && auth()->user()->courses->contains($course->id);
                                $isAdmin = auth()->check() && auth()->user()->role === 'admin';
                                $firstEpisode = isset($course->episodes) ? $course->episodes->first() : null;
                            @endphp

                            @if($isAdmin)
                                <div class="mb-4 p-4 rounded-xl bg-slate-50 border border-slate-200 text-slate-600 text-sm font-bold flex items-center justify-center gap-2 shadow-sm">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                    Admin Preview Mode
                                </div>
                            @elseif($isEnrolled)
                                <div class="mb-4 p-4 rounded-xl bg-emerald-50 border border-emerald-100 text-emerald-800 text-sm font-bold flex items-center justify-center gap-2 shadow-sm">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    You have full access
                                </div>
                                @if($firstEpisode)
                                    <a href="{{ route('episodes.show', $firstEpisode) }}" class="w-full flex justify-center items-center gap-2 py-4 px-4 rounded-xl text-sm font-black uppercase tracking-widest text-white bg-slate-900 hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-900 transition-all shadow-xl active:scale-95 group">
                                        Continue Learning
                                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                    </a>
                                @endif
                            @else
                                <div class="p-5 rounded-xl bg-amber-50 border border-amber-200 flex flex-col items-center text-center gap-2 shadow-inner">
                                    <div class="w-10 h-10 bg-amber-100 rounded-full flex items-center justify-center text-amber-600 mb-1">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-amber-900">Enrollment Restricted</p>
                                        <p class="text-xs mt-1 font-medium text-amber-700 leading-relaxed">This module is locked. Please contact your system administrator to request access.</p>
                                    </div>
                                </div>
                            @endif

                            <div class="mt-8 space-y-4 text-sm font-medium text-slate-600 border-t border-slate-100 pt-6">
                                <div class="flex items-start gap-3">
                                    <div class="mt-0.5 w-5 h-5 rounded-full bg-brand-50 text-brand-600 flex items-center justify-center shrink-0">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    </div>
                                    <span>Full lifetime access to material</span>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="mt-0.5 w-5 h-5 rounded-full bg-brand-50 text-brand-600 flex items-center justify-center shrink-0">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    </div>
                                    <span>On-demand video lectures</span>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="mt-0.5 w-5 h-5 rounded-full bg-brand-50 text-brand-600 flex items-center justify-center shrink-0">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    </div>
                                    <span>Interactive assignments & resources</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>