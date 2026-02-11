<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Complaints') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Student</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subject</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($complaints as $complaint)
                            <tr>
                                <td class="px-6 py-4 font-bold">{{ $complaint->user->name }}</td>
                                <td class="px-6 py-4">{{ $complaint->subject }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ Str::limit($complaint->description, 50) }}</td>
                                <td class="px-6 py-4">
                                    @if($complaint->status === 'pending')
                                        <form method="POST" action="{{ route('admin.complaints.resolve', $complaint) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button class="text-green-600 hover:text-green-900 font-bold">Mark Resolved</button>
                                        </form>
                                    @else
                                        <span class="text-gray-400">Resolved</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>