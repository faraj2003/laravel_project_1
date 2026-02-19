<x-guest-layout>
    <div class="text-center mb-8 relative">
        <div class="mx-auto w-16 h-16 bg-slate-900 rounded-2xl flex items-center justify-center mb-4 shadow-lg shadow-slate-900/20 border border-slate-700">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
        </div>
        <h2 class="text-2xl font-black text-slate-900 tracking-tight uppercase">Admin Portal</h2>
        <p class="text-sm text-slate-500 mt-2 font-medium">Authorized personnel only.</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('admin.login') }}" class="space-y-6">
        @csrf
        
        <input type="hidden" name="role" value="admin">

        <div>
            <label for="email" class="block text-sm font-bold text-slate-700 uppercase tracking-wider">Admin Email</label>
            <div class="mt-2 relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path></svg>
                </div>
                <input id="email" class="block w-full rounded-xl border-slate-300 pl-10 pr-4 py-3 text-slate-900 shadow-sm focus:border-slate-900 focus:ring-slate-900 sm:text-sm bg-slate-50 transition-colors" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="admin@system.local" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600" />
        </div>

        <div>
            <label for="password" class="block text-sm font-bold text-slate-700 uppercase tracking-wider">Passcode</label>
            <div class="mt-2 relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
                <input id="password" class="block w-full rounded-xl border-slate-300 pl-10 pr-4 py-3 text-slate-900 shadow-sm focus:border-slate-900 focus:ring-slate-900 sm:text-sm bg-slate-50 transition-colors" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600" />
        </div>

        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <input id="remember_me" type="checkbox" class="h-4 w-4 rounded border-slate-300 text-slate-900 focus:ring-slate-900 transition-colors" name="remember">
                <label for="remember_me" class="ml-2 block text-sm text-slate-600 font-medium">
                    Maintain Session
                </label>
            </div>
        </div>

        <div>
            <button type="submit" class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-xl shadow-lg text-sm font-black uppercase tracking-widest text-white bg-slate-900 hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-900 transition-all active:scale-95">
                Authenticate
            </button>
        </div>
    </form>
</x-guest-layout>