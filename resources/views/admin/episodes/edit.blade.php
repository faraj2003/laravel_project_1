<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Episode: ') . $episode->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.courses.episodes.update', [$course, $episode]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <x-input-label for="title" :value="__('Episode Title')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $episode->title)" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="video_file" :value="__('Replace Video File (Optional)')" />
                            <input id="video_file" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                   type="file" name="video_file" accept=".mp4,.mov,.ogg" />
                            <p class="text-sm text-gray-500 mt-1">Current video: <span class="font-bold text-indigo-600">{{ $episode->video_path ? 'Uploaded' : 'None' }}</span></p>
                            <x-input-error :messages="$errors->get('video_file')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="duration" :value="__('Duration (in minutes)')" />
                            <x-text-input id="duration" class="block mt-1 w-full"
                                          type="number" step="0.1"
                                          name="duration"
                                          :value="old('duration', $episode->duration ? $episode->duration / 60 : '')"
                                          placeholder="e.g. 5.5" />
                            <x-input-error :messages="$errors->get('duration')" class="mt-2" />
                        </div>

                        {{-- ADDED: The Content/Description Box --}}
                        <div class="mb-6">
                            <x-input-label for="content" :value="__('Episode Description / Content')" />
                            <textarea id="content" name="content" rows="4" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('content', $episode->content) }}</textarea>
                            <x-input-error :messages="$errors->get('content')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4 bg-indigo-600 hover:bg-indigo-700">
                                {{ __('Update Episode') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>