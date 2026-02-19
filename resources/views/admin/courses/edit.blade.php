<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.courses.index') }}" class="w-10 h-10 rounded-full bg-white border border-slate-200 flex items-center justify-center text-slate-500 hover:text-slate-900 transition-colors shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </a>
                <div>
                    <h2 class="font-black text-2xl text-slate-900 leading-tight uppercase tracking-tight">Modify Course</h2>
                </div>
            </div>
            <a href="{{ route('admin.courses.episodes.index', $course) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-slate-900 text-white text-sm font-bold rounded-xl hover:bg-slate-800 transition-all shadow-sm">
                Manage Modules
            </a>
        </div>
    </x-slot>

    @if(session('success'))
        <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-100 flex items-center gap-3 text-emerald-800 font-bold shadow-sm max-w-7xl mx-auto mt-6">
            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-6">
                <form method="POST" action="{{ route('admin.courses.update', $course) }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="price" value="0">

                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8">
                        <h3 class="text-lg font-bold text-slate-900 mb-6 border-b border-slate-100 pb-4">Core Attributes</h3>
                        
                        <div class="space-y-6">
                            <div>
                                <label for="title" class="block text-sm font-bold text-slate-700 uppercase tracking-wider mb-2">Course Title <span class="text-red-500">*</span></label>
                                <input type="text" name="title" id="title" class="block w-full rounded-xl border-slate-200 px-4 py-3 text-slate-900 shadow-sm focus:border-brand-500 focus:ring-brand-500 sm:text-sm bg-slate-50 focus:bg-white transition-colors" value="{{ old('title', $course->title) }}" required>
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>

                            <div>
                                <label for="description" class="block text-sm font-bold text-slate-700 uppercase tracking-wider mb-2">Technical Summary / Description</label>
                                <textarea name="description" id="description" rows="5" class="block w-full rounded-xl border-slate-200 px-4 py-3 text-slate-900 shadow-sm focus:border-brand-500 focus:ring-brand-500 sm:text-sm bg-slate-50 focus:bg-white transition-colors resize-none">{{ old('description', $course->description) }}</textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>

                            <div>
                                <label for="thumbnail" class="block text-sm font-bold text-slate-700 uppercase tracking-wider mb-2">Replace Cover Thumbnail</label>
                                <input type="file" name="thumbnail" id="thumbnail" accept="image/*" class="block w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm text-slate-900 file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-brand-50 file:text-brand-700 hover:file:bg-brand-100 transition-colors">
                                <p class="text-xs text-slate-500 mt-2">Leave blank to keep current thumbnail.</p>
                                <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                            <h3 class="text-sm font-bold text-slate-900 mb-4 uppercase tracking-wider border-b border-slate-100 pb-2">Classification</h3>
                            <div>
                                <label for="category" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Category</label>
                                <select name="category" id="category" class="block w-full rounded-xl border-slate-200 px-4 py-3 text-slate-900 shadow-sm focus:border-brand-500 focus:ring-brand-500 sm:text-sm bg-slate-50 transition-colors">
                                    <option value="">Select Domain...</option>
                                    <option value="Data Analytics" {{ old('category', $course->category) == 'Data Analytics' ? 'selected' : '' }}>Data Analytics</option>
                                    <option value="Software Engineering" {{ old('category', $course->category) == 'Software Engineering' ? 'selected' : '' }}>Software Engineering</option>
                                    <option value="Business Intelligence" {{ old('category', $course->category) == 'Business Intelligence' ? 'selected' : '' }}>Business Intelligence</option>
                                </select>
                                <x-input-error :messages="$errors->get('category')" class="mt-2" />
                            </div>
                        </div>

                        <div class="bg-slate-900 rounded-2xl border border-slate-800 shadow-xl p-6 text-white">
                            <h3 class="text-sm font-bold text-slate-300 mb-4 uppercase tracking-wider border-b border-slate-700 pb-2">Execution</h3>
                            <div class="space-y-4">
                                <label class="flex items-center gap-3 p-3 rounded-xl border border-slate-700 bg-slate-800 cursor-pointer hover:bg-slate-700/80 transition-colors">
                                    <input type="checkbox" name="is_published" value="1" class="w-5 h-5 rounded border-slate-500 text-brand-500 bg-slate-900 focus:ring-brand-500" {{ old('is_published', $course->is_published) ? 'checked' : '' }}>
                                    <div class="flex flex-col">
                                        <span class="text-sm font-bold">Published State</span>
                                    </div>
                                </label>
                                <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-lg bg-brand-600 hover:bg-brand-500 text-sm font-black text-white uppercase tracking-widest transition-all">
                                    Update Course
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sticky top-8">
                    <h3 class="text-sm font-bold text-slate-900 mb-4 uppercase tracking-wider border-b border-slate-100 pb-2">Access Control</h3>
                    
                    <form action="{{ route('admin.courses.enroll', $course) }}" method="POST" class="mb-6 space-y-3">
                        @csrf
                        <select name="user_id" class="block w-full rounded-xl border-slate-200 px-4 py-3 text-slate-900 shadow-sm focus:border-brand-500 sm:text-sm bg-slate-50 transition-colors" required>
                            <option value="">Select Student...</option>
                            @foreach($students ?? [] as $student)
                                @if(!isset($course->students) || !$course->students->contains($student->id))
                                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        <button type="submit" class="w-full flex justify-center items-center gap-2 py-2.5 px-4 rounded-xl text-sm font-bold text-white bg-slate-900 hover:bg-slate-800 transition-all shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            Grant Access
                        </button>
                    </form>

                    <div class="space-y-2 max-h-[400px] overflow-y-auto pr-1">
                        <h4 class="text-xs font-black text-slate-500 uppercase tracking-widest mb-2 sticky top-0 bg-white pt-2">Enrolled Students</h4>
                        
                        @forelse($course->students ?? [] as $enrolledStudent)
                            <div class="flex items-center justify-between p-2.5 rounded-xl bg-slate-50 border border-slate-100 group">
                                <div class="text-xs overflow-hidden">
                                    <p class="font-bold text-slate-900 truncate">{{ $enrolledStudent->name }}</p>
                                    <p class="text-slate-500 truncate">{{ $enrolledStudent->email }}</p>
                                </div>
                                <form action="{{ route('admin.courses.remove-student', $course) }}" method="POST" onsubmit="return confirm('Securely revoke access for {{ $enrolledStudent->name }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="user_id" value="{{ $enrolledStudent->id }}">
                                    <button type="submit" class="text-[10px] font-bold text-red-600 hover:text-white bg-red-100 hover:bg-red-600 px-2.5 py-1.5 rounded-lg transition-colors uppercase tracking-widest ml-2 opacity-0 group-hover:opacity-100">
                                        Revoke
                                    </button>
                                </form>
                            </div>
                        @empty
                            <p class="text-xs text-slate-500 italic text-center py-4 bg-slate-50 rounded-xl border border-dashed border-slate-200">No students are currently enrolled.</p>
                        @endforelse
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>