<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-bold text-2xl text-slate-900 leading-tight">
                {{ __('Account Settings') }}
            </h2>
            <p class="text-sm text-slate-500 mt-1">Manage your personal information, security preferences, and data.</p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto space-y-8">
            
            <div class="p-8 bg-white shadow-sm border border-slate-200 rounded-2xl relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-brand-50 rounded-bl-full -z-10"></div>
                <div class="max-w-xl z-10 relative">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-8 bg-white shadow-sm border border-slate-200 rounded-2xl relative overflow-hidden">
                <div class="max-w-xl z-10 relative">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-8 bg-white shadow-sm border border-red-100 rounded-2xl relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-red-50 rounded-bl-full -z-10"></div>
                <div class="max-w-xl z-10 relative">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>