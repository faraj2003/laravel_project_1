<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between w-full gap-4">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 leading-tight">
                    {{ __('Learning Library') }}
                </h2>
                <p class="text-sm text-slate-500 mt-1">Discover, manage, and enroll in organizational training modules.</p>
            </div>
            
            @if(auth()->user() && auth()->user()->role === 'admin')
            <div>
                <a href="{{ route('admin.courses.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-brand-600 text-white text-sm font-semibold rounded-lg hover:bg-brand-500 transition-all shadow-sm shadow-brand-500/30">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Create New Course
                </a>
            </div>
            @endif
        </div>
    </x-slot>

    <div class="mb-8 flex flex-col md:flex-row gap-4 justify-between items-center bg-white p-4 rounded-2xl border border-slate-200 shadow-sm">
        <div class="w-full md:w-96 relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <input type="text" placeholder="Query courses by title or keyword..." class="block w-full pl-10 pr-3 py-2 border border-slate-200 rounded-xl leading-5 bg-slate-50 placeholder-slate-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-brand-500 focus:border-brand-500 sm:text-sm transition-colors">
        </div>

        <div class="flex items-center gap-3 w-full md:w-auto">
            <select class="block w-full md:w-48 pl-3 pr-10 py-2 text-base border-slate-200 focus:outline-none focus:ring-brand-500 focus:border-brand-500 sm:text-sm rounded-xl bg-slate-50 text-slate-700">
                <option>All Categories</option>
                <option>Technology</option>
                <option>Business Intelligence</option>
                <option>Leadership</option>
            </select>
            
            <button class="p-2 bg-slate-50 border border-slate-200 rounded-xl text-slate-500 hover:text-brand-600 hover:bg-brand-50 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
            </button>
        </div>
    </div>

    @if(isset($courses) && $courses->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @foreach($courses as $course)
                <a href="{{ route('courses.show', $course) }}" class="block h-full">
                    <x-course-card :course="$course" />
                </a>
            @endforeach
        </div>
        
        <div class="mt-12">
            {{ $courses->links() }}
        </div>
    @else
        <div class="text-center py-24 bg-white rounded-2xl border border-slate-200 border-dashed">
            <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            </div>
            <h3 class="text-lg font-bold text-slate-900 mb-1">No courses found</h3>
            <p class="text-slate-500 text-sm max-w-sm mx-auto">It looks like the learning catalog is currently empty or no courses match your query.</p>
        </div>
    @endif

</x-app-layout>