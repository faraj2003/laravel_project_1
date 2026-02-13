<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <label for="role" class="block font-medium text-sm text-slate-700 mb-1">I am a...</label>
            <select id="role" name="role" class="block w-full rounded-lg border-slate-300 bg-white text-slate-900 focus:border-blue-500 focus:ring-blue-500 shadow-sm transition-colors" required>
                <option value="" disabled>Select your role</option>
                <option value="student" selected>Student / Teacher</option>
                <option value="admin">Administrator</option>
            </select>
        </div>

        <div>
            <label for="email" class="block font-medium text-sm text-slate-700 mb-1">Email</label>
            <input id="email" class="block w-full rounded-lg border-slate-300 bg-white text-slate-900 placeholder-slate-400 focus:border-blue-500 focus:ring-blue-500 shadow-sm transition-colors" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <label for="password" class="block font-medium text-sm text-slate-700 mb-1">Password</label>
            <input id="password" class="block w-full rounded-lg border-slate-300 bg-white text-slate-900 placeholder-slate-400 focus:border-blue-500 focus:ring-blue-500 shadow-sm transition-colors"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                <span class="ms-2 text-sm text-slate-600">Remember me</span>
            </label>

            @if (Route::has('password.request'))
                <a class="underline text-sm text-slate-500 hover:text-blue-600 transition-colors" href="{{ route('password.request') }}">
                    Forgot password?
                </a>
            @endif
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 border border-transparent rounded-lg font-bold text-xs text-white uppercase tracking-widest hover:from-blue-700 hover:to-indigo-700 active:scale-95 transition-all focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 shadow-lg shadow-blue-500/30">
                {{ __('Log in') }}
            </button>
        </div>
    </form>
</x-guest-layout>