<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.courses.episodes.index', $course) }}" class="w-10 h-10 rounded-full bg-white border border-slate-200 flex items-center justify-center text-slate-500 hover:text-slate-900 transition-colors shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-black text-2xl text-slate-900 uppercase tracking-tight">Initialize Module</h2>
        </div>
    </x-slot>

    <form method="POST" action="{{ route('admin.courses.episodes.store', $course) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8">
                    <h3 class="text-lg font-bold text-slate-900 mb-6 border-b border-slate-100 pb-4">Content Assets</h3>
                    <div class="space-y-6">
                        <div>
                            <label for="title" class="block text-sm font-bold text-slate-700 uppercase mb-2">Module Title <span class="text-red-500">*</span></label>
                            <input type="text" name="title" id="title" class="block w-full rounded-xl border-slate-200 px-4 py-3 text-slate-900 shadow-sm focus:ring-brand-500 bg-slate-50" value="{{ old('title') }}" required>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="video_file" class="block text-sm font-bold text-slate-700 uppercase mb-2">Physical Video File</label>
                                <input type="file" name="video_file" id="video_file" accept="video/*" class="block w-full rounded-xl border-slate-200 px-4 py-2 text-slate-900 shadow-sm bg-slate-50">
                                <p class="text-[10px] text-slate-400 mt-1 uppercase font-bold">Max 500MB (MP4, MOV)</p>
                            </div>
                            <div>
                                <label for="video_url" class="block text-sm font-bold text-slate-700 uppercase mb-2">External Link (URL)</label>
                                <input type="url" name="video_url" id="video_url" class="block w-full rounded-xl border-slate-200 px-4 py-3 text-slate-900 shadow-sm bg-slate-50" placeholder="https://youtube.com/..." value="{{ old('video_url') }}">
                                <p class="text-[10px] text-slate-400 mt-1 uppercase font-bold">Vimeo, YouTube, etc.</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="duration" class="block text-sm font-bold text-slate-700 uppercase mb-2">Duration (Minutes)</label>
                                <input type="number" step="0.1" name="duration" id="duration" class="block w-full rounded-xl border-slate-200 px-4 py-3 text-slate-900 shadow-sm bg-slate-50" value="{{ old('duration') }}">
                            </div>
                        </div>

                        <div>
                            <label for="content" class="block text-sm font-bold text-slate-700 uppercase mb-2">Technical Summary / Notes</label>
                            <textarea name="content" id="content" rows="6" class="block w-full rounded-xl border-slate-200 px-4 py-3 text-slate-900 shadow-sm bg-slate-50 resize-none">{{ old('content') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-slate-900 rounded-2xl p-6 text-white sticky top-28">
                    <h3 class="text-sm font-bold text-slate-300 mb-4 uppercase tracking-wider border-b border-slate-700 pb-2">Execution</h3>
                    <button type="submit" class="w-full flex justify-center py-3.5 px-4 rounded-xl shadow-lg bg-brand-600 hover:bg-brand-500 text-sm font-black text-white uppercase tracking-widest transition-all">
                        Commit Module
                    </button>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>