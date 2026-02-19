<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-black text-2xl text-slate-900 leading-tight uppercase tracking-tight">
                    {{ __('Admin Command Center') }}
                </h2>
                <p class="text-sm text-slate-500 mt-1 font-medium">System overview and Business Intelligence metrics.</p>
            </div>
            <div class="flex gap-3">
                <button class="flex items-center gap-2 px-4 py-2 bg-white border border-slate-200 text-slate-700 text-sm font-bold rounded-lg hover:bg-slate-50 transition-colors shadow-sm">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    Export BI Report
                </button>
                <a href="{{ route('admin.courses.create') }}" class="flex items-center gap-2 px-4 py-2 bg-slate-900 text-white text-sm font-bold rounded-lg hover:bg-slate-800 transition-colors shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    New Course
                </a>
            </div>
        </div>
    </x-slot>

    <div class="space-y-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm relative overflow-hidden group hover:border-blue-200 transition-colors">
                <div class="absolute right-0 top-0 w-24 h-24 bg-blue-50 rounded-bl-full -z-10 group-hover:bg-blue-100 transition-colors"></div>
                <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Total Users</h3>
                <div class="flex items-end gap-3">
                    <span class="text-4xl font-black text-slate-900">2,845</span>
                    <span class="text-sm font-bold text-emerald-500 mb-1 flex items-center">
                        <svg class="w-3 h-3 mr-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                        12%
                    </span>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm relative overflow-hidden group hover:border-brand-200 transition-colors">
                <div class="absolute right-0 top-0 w-24 h-24 bg-brand-50 rounded-bl-full -z-10 group-hover:bg-brand-100 transition-colors"></div>
                <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Active Courses</h3>
                <div class="flex items-end gap-3">
                    <span class="text-4xl font-black text-slate-900">48</span>
                    <span class="text-sm font-bold text-slate-400 mb-1">Modules</span>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm relative overflow-hidden group hover:border-purple-200 transition-colors">
                <div class="absolute right-0 top-0 w-24 h-24 bg-purple-50 rounded-bl-full -z-10 group-hover:bg-purple-100 transition-colors"></div>
                <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Avg Completion</h3>
                <div class="flex items-end gap-3">
                    <span class="text-4xl font-black text-slate-900">64%</span>
                    <span class="text-sm font-bold text-emerald-500 mb-1 flex items-center">
                        <svg class="w-3 h-3 mr-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                        4%
                    </span>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm relative overflow-hidden group hover:border-amber-200 transition-colors">
                <div class="absolute right-0 top-0 w-24 h-24 bg-amber-50 rounded-bl-full -z-10 group-hover:bg-amber-100 transition-colors"></div>
                <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Pending Tickets</h3>
                <div class="flex items-end gap-3">
                    <span class="text-4xl font-black text-slate-900">3</span>
                    <span class="text-sm font-bold text-amber-600 mb-1">Requires action</span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-1 space-y-8">
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                    <h3 class="text-lg font-bold text-slate-900 mb-4">Database Pipeline</h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center p-3 bg-slate-50 rounded-xl border border-slate-100">
                            <span class="text-sm font-semibold text-slate-600">SQL Read Latency</span>
                            <span class="text-sm font-mono font-bold text-emerald-600">12ms</span>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-slate-50 rounded-xl border border-slate-100">
                            <span class="text-sm font-semibold text-slate-600">Active Queries</span>
                            <span class="text-sm font-mono font-bold text-brand-600">142</span>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-slate-50 rounded-xl border border-slate-100">
                            <span class="text-sm font-semibold text-slate-600">Cache Hit Ratio</span>
                            <span class="text-sm font-mono font-bold text-emerald-600">98.4%</span>
                        </div>
                    </div>
                </div>

                <div class="bg-slate-900 rounded-2xl border border-slate-800 shadow-lg p-6 text-white">
                    <h3 class="text-lg font-bold mb-2">Management Links</h3>
                    <ul class="space-y-2 mt-4">
                        <li>
                            <a href="{{ route('admin.courses.index') }}" class="flex items-center gap-3 p-2 rounded-lg hover:bg-slate-800 transition-colors group">
                                <div class="w-8 h-8 rounded bg-slate-800 flex items-center justify-center group-hover:text-brand-400 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                </div>
                                <span class="font-medium text-sm text-slate-300 group-hover:text-white">Manage Courses Library</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.complaints.index') }}" class="flex items-center gap-3 p-2 rounded-lg hover:bg-slate-800 transition-colors group">
                                <div class="w-8 h-8 rounded bg-slate-800 flex items-center justify-center group-hover:text-amber-400 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                </div>
                                <span class="font-medium text-sm text-slate-300 group-hover:text-white">Review User Complaints</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden h-full flex flex-col">
                    <div class="px-6 py-5 border-b border-slate-200 flex justify-between items-center bg-slate-50">
                        <h3 class="text-lg font-bold text-slate-900">Recent Course Enrollments</h3>
                        <button class="text-sm font-bold text-brand-600 hover:text-brand-500">View Master Log &rarr;</button>
                    </div>
                    <div class="p-0 flex-grow">
                        <table class="w-full text-left text-sm whitespace-nowrap">
                            <thead class="bg-white uppercase text-slate-500 font-bold text-xs tracking-wider border-b border-slate-200">
                                <tr>
                                    <th class="px-6 py-4">User</th>
                                    <th class="px-6 py-4">Course ID</th>
                                    <th class="px-6 py-4">Status</th>
                                    <th class="px-6 py-4 text-right">Timestamp</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-slate-700">
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-6 py-4 font-medium">john.doe@enterprise.com</td>
                                    <td class="px-6 py-4 font-mono text-slate-500">CRS-8832</td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-bold bg-emerald-100 text-emerald-800">Active</span>
                                    </td>
                                    <td class="px-6 py-4 text-right text-slate-400 font-mono">2 mins ago</td>
                                </tr>
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-6 py-4 font-medium">sara.smith@corp.com</td>
                                    <td class="px-6 py-4 font-mono text-slate-500">CRS-1094</td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-bold bg-blue-100 text-blue-800">Completed</span>
                                    </td>
                                    <td class="px-6 py-4 text-right text-slate-400 font-mono">14 mins ago</td>
                                </tr>
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-6 py-4 font-medium">mike.ross@legal.net</td>
                                    <td class="px-6 py-4 font-mono text-slate-500">CRS-5521</td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-bold bg-emerald-100 text-emerald-800">Active</span>
                                    </td>
                                    <td class="px-6 py-4 text-right text-slate-400 font-mono">1 hour ago</td>
                                </tr>
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-6 py-4 font-medium text-slate-400 italic">Data stream ended</td>
                                    <td class="px-6 py-4"></td>
                                    <td class="px-6 py-4"></td>
                                    <td class="px-6 py-4"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>