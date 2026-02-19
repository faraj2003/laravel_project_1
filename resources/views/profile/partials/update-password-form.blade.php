<section>
    <header>
        <h2 class="text-lg font-bold text-slate-900">
            {{ __('Update Password') }}
        </h2>
        <p class="mt-1 text-sm text-slate-500">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block text-sm font-medium text-slate-700">{{ __('Current Password') }}</label>
            <div class="mt-2">
                <input id="update_password_current_password" name="current_password" type="password" class="block w-full rounded-xl border-slate-200 px-4 py-2.5 text-slate-900 shadow-sm focus:border-brand-500 focus:ring-brand-500 sm:text-sm transition-colors" autocomplete="current-password" />
            </div>
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_password" class="block text-sm font-medium text-slate-700">{{ __('New Password') }}</label>
            <div class="mt-2">
                <input id="update_password_password" name="password" type="password" class="block w-full rounded-xl border-slate-200 px-4 py-2.5 text-slate-900 shadow-sm focus:border-brand-500 focus:ring-brand-500 sm:text-sm transition-colors" autocomplete="new-password" />
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-medium text-slate-700">{{ __('Confirm Password') }}</label>
            <div class="mt-2">
                <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="block w-full rounded-xl border-slate-200 px-4 py-2.5 text-slate-900 shadow-sm focus:border-brand-500 focus:ring-brand-500 sm:text-sm transition-colors" autocomplete="new-password" />
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="inline-flex justify-center py-2.5 px-6 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-slate-900 hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-900 transition-all active:scale-95">
                {{ __('Update Password') }}
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }"
                   x-show="show"
                   x-transition:leave="transition ease-in duration-300"
                   x-transition:leave-start="opacity-100"
                   x-transition:leave-end="opacity-0"
                   x-init="setTimeout(() => show = false, 2000)"
                   class="text-sm font-medium text-emerald-600 flex items-center gap-1"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>