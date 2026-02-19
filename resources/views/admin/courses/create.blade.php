<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.courses.index') }}" class="w-10 h-10 rounded-full bg-white border border-slate-200 flex items-center justify-center text-slate-500 hover:text-slate-900 hover:bg-slate-50 transition-colors shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <div>
                <h2 class="font-black text-2xl text-slate-900 leading-tight uppercase tracking-tight">
                    {{ __('Initialize Course') }}
                </h2>
                <p class="text-sm text-slate-500 mt-1 font-medium">Configure new learning module parameters.</p>
            </div>
        </div>
    </x-slot>

    <form method="POST" action="{{ route('admin.courses.store') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8">
                    <h3 class="text-lg font-bold text-slate-900 mb-6 border-b border-slate-100 pb-4">Core Attributes</h3>
                    
                    <div class="space-y-6">
                        <div>
                            <label for="title" class="block text-sm font-bold text-slate-700 uppercase tracking-wider mb-2">Course Title <span class="text-red-500">*</span></label>
                            <input type="text" name="title" id="title" class="block w-full rounded-xl border-slate-200 px-4 py-3 text-slate-900 shadow-sm focus:border-brand-500 focus:ring-brand-500 sm:text-sm bg-slate-50 focus:bg-white transition-colors" placeholder="e.g., Advanced SQL Data Analysis" value="{{ old('title') }}" required>
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-bold text-slate-700 uppercase tracking-wider mb-2">Technical Summary / Description</label>
                            <textarea name="description" id="description" rows="5" class="block w-full rounded-xl border-slate-200 px-4 py-3 text-slate-900 shadow-sm focus:border-brand-500 focus:ring-brand-500 sm:text-sm bg-slate-50 focus:bg-white transition-colors resize-none" placeholder="Detail the learning objectives...">{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="price" class="block text-sm font-bold text-slate-700 uppercase tracking-wider mb-2">Price (USD)</label>
                                <input type="number" step="0.01" name="price" id="price" class="block w-full rounded-xl border-slate-200 px-4 py-3 text-slate-900 shadow-sm focus:border-brand-500 focus:ring-brand-500 sm:text-sm bg-slate-50 focus:bg-white transition-colors" placeholder="0.00" value="{{ old('price') }}">
                                <x-input-error :messages="$errors->get('price')" class="mt-2" />
                            </div>

                            <div>
                                <label for="thumbnail" class="block text-sm font-bold text-slate-700 uppercase tracking-wider mb-2">Cover Thumbnail</label>
                                <input type="file" name="thumbnail" id="thumbnail" accept="image/*" class="block w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm text-slate-900 file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-brand-50 file:text-brand-700 hover:file:bg-brand-100 transition-colors">
                                <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
                            </div>
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
                            <option value="Data Analytics" {{ old('category') == 'Data Analytics' ? 'selected' : '' }}>Data Analytics</option>
                            <option value="Software Engineering" {{ old('category') == 'Software Engineering' ? 'selected' : '' }}>Software Engineering</option>
                            <option value="Business Intelligence" {{ old('category') == 'Business Intelligence' ? 'selected' : '' }}>Business Intelligence</option>
                        </select>
                        <x-input-error :messages="$errors->get('category')" class="mt-2" />
                    </div>
                </div>

                <div class="bg-slate-900 rounded-2xl border border-slate-800 shadow-xl p-6 text-white sticky top-28">
                    <h3 class="text-sm font-bold text-slate-300 mb-4 uppercase tracking-wider border-b border-slate-700 pb-2">Execution</h3>
                    
                    <div class="space-y-4">
                        <label class="flex items-center gap-3 p-3 rounded-xl border border-slate-700 bg-slate-800 cursor-pointer hover:bg-slate-700/80 transition-colors">
                            <input type="checkbox" name="is_published" value="1" class="w-5 h-5 rounded border-slate-500 text-brand-500 focus:ring-brand-500 bg-slate-900" {{ old('is_published') ? 'checked' : '' }}>
                            <div class="flex flex-col">
                                <span class="text-sm font-bold">Publish Immediately</span>
                                <span class="text-xs text-slate-400">Make available in catalog</span>
                            </div>
                        </label>

                        <button type="submit" class="w-full flex justify-center items-center gap-2 py-3.5 px-4 border border-transparent rounded-xl shadow-lg shadow-brand-500/20 text-sm font-black text-white bg-brand-600 hover:bg-brand-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 focus:ring-offset-slate-900 transition-all active:scale-95 uppercase tracking-widest">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                            Commit Record
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>