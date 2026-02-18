<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Control Center') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-4">Welcome, {{ auth()->user()->name }}!</h3>
                    <p class="text-gray-600 mb-8">This is your private administrative area. From here, you can manage the entire LaraLearn platform.</p>

                    {{-- Quick Stats Grid --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-indigo-50 p-6 rounded-xl border border-indigo-100">
                            <span class="text-indigo-600 font-bold uppercase text-xs">Total Courses</span>
                            <h4 class="text-3xl font-black text-indigo-900 mt-2">{{ \App\Models\Course::count() }}</h4>
                        </div>

                        <div class="bg-green-50 p-6 rounded-xl border border-green-100">
                            <span class="text-green-600 font-bold uppercase text-xs">Total Students</span>
                            <h4 class="text-3xl font-black text-green-900 mt-2">{{ \App\Models\User::count() }}</h4>
                        </div>

                        <div class="bg-purple-50 p-6 rounded-xl border border-purple-100">
                            <span class="text-purple-600 font-bold uppercase text-xs">Total Lessons</span>
                            <h4 class="text-3xl font-black text-purple-900 mt-2">{{ \App\Models\Episode::count() }}</h4>
                        </div>
                    </div>

                    <div class="mt-10">
                        <a href="{{ route('admin.courses.index') }}" class="inline-block px-6 py-3 bg-indigo-600 text-white font-bold rounded-lg shadow hover:bg-indigo-700 transition">
                            Manage Courses &rarr;
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>