<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.courses.episodes.index', $course) }}" class="w-10 h-10 rounded-full bg-white border border-slate-200 flex items-center justify-center text-slate-500 hover:text-slate-900 hover:bg-slate-50 transition-colors shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <div>
                <h2 class="font-black text-2xl text-slate-900 leading-tight uppercase tracking-tight">Initialize Module</h2>
            </div>
        </div>
    </x-slot>

    <form method="POST" action="{{ route('admin.courses.episodes.store', $course) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8">
                    <h3 class="text-lg font-bold text-slate-900 mb-6 border-b border-slate-100 pb-4">Module Content</h3>
                    
                    <div class="space-y-6">
                        <div>
                            <label for="title" class="block text-sm font-bold text-slate-700 uppercase tracking-wider mb-2">Module Title <span class="text-red-500">*</span></label>
                            <input type="text" name="title" id="title" class="block w-full rounded-xl border-slate-200 px-4 py-3 text-slate-900 shadow-sm focus:border-brand-500 sm:text-sm bg-slate-50 focus:bg-white transition-colors" value="{{ old('title') }}" required>
                            @error('title') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="video_file" class="block text-sm font-bold text-slate-700 uppercase tracking-wider mb-2">Video File Upload <span class="text-red-500">*</span></label>
                            <input type="file" name="video_file" id="video_file" accept="video/mp4,video/quicktime,video/ogg" class="block w-full rounded-xl border-slate-200 px-4 py-2 text-slate-900 shadow-sm focus:border-brand-500 sm:text-sm bg-slate-50 transition-colors" required>
                            <p class="text-xs text-slate-500 mt-1">Accepted formats: MP4, MOV, OGG (Max 500MB).</p>
                            @error('video_file') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="duration" class="block text-sm font-bold text-slate-700 uppercase tracking-wider mb-2">Duration (in Minutes)</label>
                            <input type="number" step="0.1" name="duration" id="duration" class="block w-full rounded-xl border-slate-200 px-4 py-3 text-slate-900 shadow-sm focus:border-brand-500 sm:text-sm bg-slate-50 focus:bg-white transition-colors" placeholder="e.g. 5.5" value="{{ old('duration') }}">
                            @error('duration') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="content" class="block text-sm font-bold text-slate-700 uppercase tracking-wider mb-2">Technical Summary / Notes</label>
                            <textarea name="content" id="content" rows="6" class="block w-full rounded-xl border-slate-200 px-4 py-3 text-slate-900 shadow-sm focus:border-brand-500 sm:text-sm bg-slate-50 focus:bg-white transition-colors resize-none">{{ old('content') }}</textarea>
                            @error('content') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1 space-y-6">
                <div class="bg-slate-900 rounded-2xl border border-slate-800 shadow-xl p-6 text-white sticky top-28">
                    <h3 class="text-sm font-bold text-slate-300 mb-4 uppercase tracking-wider border-b border-slate-700 pb-2">Execution</h3>
                    <div class="space-y-4">
                        <button type="submit" class="w-full flex justify-center items-center gap-2 py-3.5 px-4 border border-transparent rounded-xl shadow-lg bg-brand-600 hover:bg-brand-500 text-sm font-black text-white uppercase tracking-widest transition-all">
                            Commit Module
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>