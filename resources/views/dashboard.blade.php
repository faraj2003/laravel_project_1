<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between w-full gap-4">
            <div>
                <h2 class="font-black text-2xl text-slate-900 leading-tight tracking-tight">
                    Welcome back, {{ auth()->user()->name }}! 👋
                </h2>
                <p class="text-sm text-slate-500 mt-1 font-medium">Pick up right where you left off and track your progress.</p>
            </div>
            <div>
                <a href="{{ route('courses.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white border border-slate-200 text-slate-700 text-sm font-bold rounded-xl hover:bg-slate-50 hover:text-slate-900 transition-all shadow-sm active:scale-95">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    Explore Catalog
                </a>
            </div>
        </div>
    </x-slot>

    <div class="space-y-8 py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm flex items-center gap-4 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 rounded-xl bg-brand-50 flex items-center justify-center text-brand-600 shrink-0 shadow-inner">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
                <div>
                    <p class="text-xs font-black text-slate-400 uppercase tracking-widest mb-0.5">Enrolled</p>
                    <p class="text-2xl font-black text-slate-900 leading-none">{{ $courses->count() }} <span class="text-sm font-medium text-slate-500">courses</span></p>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm flex items-center gap-4 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-600 shrink-0 shadow-inner">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <p class="text-xs font-black text-slate-400 uppercase tracking-widest mb-0.5">Completed</p>
                    <p class="text-2xl font-black text-slate-900 leading-none">0 <span class="text-sm font-medium text-slate-500">courses</span></p>
                </div>
            </div>
        </div>

        <div>
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-black text-slate-900 tracking-tight">My Learning Journey</h3>
            </div>
            
            @if(isset($courses) && $courses->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($courses as $course)
                        <a href="{{ route('courses.show', $course) }}" class="block h-full group transition-transform hover:-translate-y-1">
                            <x-course-card :course="$course" />
                        </a>
                    @endforeach
                </div>
            @else
                <div class="text-center py-20 bg-white rounded-[2rem] border border-slate-200 border-dashed shadow-sm">
                    <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6 shadow-inner">
                        <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <h3 class="text-2xl font-black text-slate-900 mb-2 tracking-tight">Your desk is empty!</h3>
                    <p class="text-slate-500 text-base max-w-md mx-auto mb-8 font-medium">You haven't been enrolled in any modules yet. Browse the catalog to see what's available.</p>
                    
                    <a href="{{ route('courses.index') }}" class="inline-flex items-center gap-2 px-6 py-3.5 bg-slate-900 text-white text-sm font-bold rounded-xl hover:bg-brand-600 transition-all shadow-xl hover:shadow-brand-500/30 active:scale-95 group">
                        Browse Course Library
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
            @endif
        </div>

    </div>
</x-app-layout>