@props(['course'])

<div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group flex flex-col h-full">
    <div class="relative h-48 bg-slate-100 overflow-hidden">
        <div class="absolute inset-0 opacity-20 bg-[radial-gradient(#cbd5e1_1px,transparent_1px)] [background-size:16px_16px]"></div>
        
        <div class="absolute top-4 left-4 z-10">
            <span class="px-3 py-1 bg-white/90 backdrop-blur-sm text-xs font-bold uppercase tracking-wider text-slate-700 rounded-full shadow-sm">
                {{ $course->category ?? 'Technology' }}
            </span>
        </div>

        <div class="absolute inset-0 bg-brand-900/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm">
            <span class="px-6 py-2 bg-white text-brand-600 font-bold rounded-full shadow-lg transform scale-90 group-hover:scale-100 transition-transform">
                View Details
            </span>
        </div>
    </div>

    <div class="p-6 flex flex-col flex-grow">
        <h3 class="text-xl font-bold text-slate-900 mb-2 line-clamp-2 group-hover:text-brand-600 transition-colors">
            {{ $course->title ?? 'Untitled Course' }}
        </h3>
        
        <p class="text-sm text-slate-500 mb-6 line-clamp-3 font-light leading-relaxed">
            {{ $course->description ?? 'No description available for this module. Click to explore learning objectives and curriculum.' }}
        </p>

        <div class="mt-auto pt-6 border-t border-slate-100">
            <div class="flex items-center justify-between text-sm text-slate-500">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    <span class="font-medium">{{ $course->episodes_count ?? 0 }} Modules</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="font-medium text-slate-700">Active</span>
                </div>
            </div>
        </div>
    </div>
</div>