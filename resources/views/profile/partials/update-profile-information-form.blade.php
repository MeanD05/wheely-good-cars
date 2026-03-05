<form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
</form>

<form method="post" action="{{ route('profile.update') }}" class="stack">
    @csrf
    @method('patch')

    <div class="grid grid-2">
        <div>
            <label for="name" class="label">Naam</label>
            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" class="input">
            <x-input-error :messages="$errors->get('name')" />
        </div>

        <div>
            <label for="email" class="label">E-mailadres</label>
            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="username" class="input">
            <x-input-error :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <p class="muted" style="margin-top: 0.5rem; font-size: 0.85rem;">
                    {{ __('Je e-mailadres is niet geverifieerd.') }}
                    <button form="send-verification" class="btn btn-outline" style="margin-left: 0.35rem; padding: 0.3rem 0.6rem; font-size: 0.78rem;">
                        Verificatiemail opnieuw versturen
                    </button>
                </p>
                @if (session('status') === 'verification-link-sent')
                    <p class="status" style="margin-top: 0.4rem;">
                        Er is een nieuwe verificatielink naar je e-mailadres gestuurd.
                    </p>
                @endif
            @endif
        </div>
    </div>

    <div style="display: flex; align-items: center; gap: 0.75rem;">
        <button type="submit" class="btn">Opslaan</button>
        @if (session('status') === 'profile-updated')
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
