<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Admin Portal</h2>
        <p class="text-sm text-slate-500 mt-2">Authorized personnel only.</p>
    </div>

    <form method="POST" action="{{ route('admin.login') }}" class="space-y-6">
        @csrf

        <div style="display: none;">
            <label for="phone_number">Phone Number</label>
            <input type="text" name="phone_number" id="phone_number" value="">
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-slate-700">Email Address</label>
            <div class="mt-2">
                <input id="email" class="block w-full rounded-xl border-slate-200 px-4 py-3 text-slate-900 shadow-sm focus:border-brand-500 focus:ring-brand-500 sm:text-sm transition-colors" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
            <div class="mt-2">
                <input id="password" class="block w-full rounded-xl border-slate-200 px-4 py-3 text-slate-900 shadow-sm focus:border-brand-500 focus:ring-brand-500 sm:text-sm transition-colors" type="password" name="password" required autocomplete="current-password" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-brand-600 shadow-sm focus:ring-brand-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            <button type="submit" class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-xl shadow-md text-sm font-bold text-white bg-slate-900 hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-900 transition-all hover:-translate-y-0.5 active:translate-y-0">
                {{ __('Log in') }}
            </button>
        </div>
    </form>
</x-guest-layout>