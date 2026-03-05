<form method="post" action="{{ route('password.update') }}" class="stack">
    @csrf
    @method('put')

    <div class="grid grid-2">
        <div>
            <label for="update_password_current_password" class="label">Huidig wachtwoord</label>
            <input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password" class="input">
            <x-input-error :messages="$errors->updatePassword->get('current_password')" />
        </div>

        <div>
            <label for="update_password_password" class="label">Nieuw wachtwoord</label>
            <input id="update_password_password" name="password" type="password" autocomplete="new-password" class="input">
            <x-input-error :messages="$errors->updatePassword->get('password')" />
        </div>
    </div>

    <div>
        <label for="update_password_password_confirmation" class="label">Bevestig nieuw wachtwoord</label>
        <input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" class="input" style="max-width: 360px;">
        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" />
    </div>

    <div style="display: flex; align-items: center; gap: 0.75rem;">
        <button type="submit" class="btn">Wachtwoord opslaan</button>
        @if (session('status') === 'password-updated')
            <span
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="status"
            >Opgeslagen.</span>
        @endif
    </div>
</form>
