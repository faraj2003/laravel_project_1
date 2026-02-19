<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.courses.index') }}" class="w-10 h-10 rounded-full bg-white border border-slate-200 flex items-center justify-center text-slate-500 hover:text-slate-900 hover:bg-slate-50 transition-colors shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </a>
                <div>
                    <h2 class="font-black text-2xl text-slate-900 leading-tight uppercase tracking-tight">
                        {{ __('Modify Course') }}
                    </h2>
                    <p class="text-sm text-slate-500 mt-1 font-medium">Updating Record ID: <span class="font-mono">{{ str_pad($course->id, 3, '0', STR_PAD_LEFT) }}</span></p>
                </div>
            </div>
            <div>
                 <a href="{{ route('admin.courses.episodes.index', $course) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-slate-900 text-white text-sm font-bold rounded-xl hover:bg-slate-800 transition-all shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                    Manage Modules
                </a>
            </div>
        </div>
    </x-slot>

    <form method="POST" action="{{ route('admin.courses.update', $course) }}" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8">
                    <h3 class="text-lg font-bold text-slate-900 mb-6 border-b border-slate-100 pb-4">Core Attributes</h3>
                    
                    <div class="space-y-6">
                        <div>
                            <label for="title" class="block text-sm font-bold text-slate-700 uppercase tracking-wider mb-2">Course Title <span class="text-red-500">*</span></label>
                            <input type="text" name="title" id="title" class="block w-full rounded-xl border-slate-200 px-4 py-3 text-slate-900 shadow-sm focus:border-brand-500 focus:ring-brand-500 sm:text-sm bg-slate-50 focus:bg-white transition-colors" value="{{ old('title', $course->title) }}" required>
                            @error('title') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-bold text-slate-700 uppercase tracking-wider mb-2">Technical Summary / Description</label>
                            <textarea name="description" id="description" rows="5" class="block w-full rounded-xl border-slate-200 px-4 py-3 text-slate-900 shadow-sm focus:border-brand-500 focus:ring-brand-500 sm:text-sm bg-slate-50 focus:bg-white transition-colors resize-none">{{ old('description', $course->description) }}</textarea>
                            @error('description') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1 space-y-6">
                
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                    <h3 class="text-sm font-bold text-slate-900 mb-4 uppercase tracking-wider border-b border-slate-100 pb-2">Classification</h3>
                    
                    <div>
                        <label for="category" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Category</label>
                        <select name="category" id="category" class="block w-full rounded-xl border-slate-200 px-4 py-3 text-slate-900 shadow-sm focus:border-brand-500 focus:ring-brand-500 sm:text-sm bg-slate-50 focus:bg-white transition-colors">
                            <option value="">Select Domain...</option>
                            <option value="Data Analytics" {{ old('category', $course->category) == 'Data Analytics' ? 'selected' : '' }}>Data Analytics</option>
                            <option value="Software Engineering" {{ old('category', $course->category) == 'Software Engineering' ? 'selected' : '' }}>Software Engineering</option>
                            <option value="Business Intelligence" {{ old('category', $course->category) == 'Business Intelligence' ? 'selected' : '' }}>Business Intelligence</option>
                        </select>
                        @error('category') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="bg-slate-900 rounded-2xl border border-slate-800 shadow-xl p-6 text-white sticky top-28">
                    <h3 class="text-sm font-bold text-slate-300 mb-4 uppercase tracking-wider border-b border-slate-700 pb-2">Execution Configuration</h3>
                    
                    <div class="space-y-4">
                        <label class="flex items-center gap-3 p-3 rounded-xl border border-slate-700 bg-slate-800 cursor-pointer hover:bg-slate-700/80 transition-colors">
                            <input type="checkbox" name="is_published" value="1" class="w-5 h-5 rounded border-slate-500 text-brand-500 focus:ring-brand-500 bg-slate-900" {{ old('is_published', $course->is_published) ? 'checked' : '' }}>
                            <div class="flex flex-col">
                                <span class="text-sm font-bold">Published State</span>
                                <span class="text-xs text-slate-400">Visibility in user catalog</span>
                            </div>
                        </label>

                        <button type="submit" class="w-full flex justify-center items-center gap-2 py-3.5 px-4 border border-transparent rounded-xl shadow-lg shadow-brand-500/20 text-sm font-black text-white bg-brand-600 hover:bg-brand-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 focus:ring-offset-slate-900 transition-all active:scale-95 uppercase tracking-widest">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                            Update Record
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </form>
</x-app-layout>