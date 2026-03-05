<p class="muted" style="font-size: 0.9rem; margin-bottom: 1rem;">
    Zodra je account wordt verwijderd, worden alle gegevens permanent gewist. Download eventuele informatie die je wilt bewaren voordat je verder gaat.
</p>

<button
    class="btn btn-danger"
    x-data=""
    x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
>Account verwijderen</button>

<x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
    <form method="post" action="{{ route('profile.destroy') }}" class="stack" style="padding: 1.5rem;">
        @csrf
        @method('delete')

        <h2 style="color: var(--navy);">Weet je het zeker?</h2>

        <p class="muted" style="font-size: 0.9rem;">
            Al je gegevens en auto's worden permanent verwijderd. Dit kan niet ongedaan worden gemaakt. Voer je wachtwoord in om te bevestigen.
        </p>

        <div>
            <label for="password" class="label sr-only">Wachtwoord</label>
            <input
                id="password"
                name="password"
                type="password"
                placeholder="Wachtwoord"
                class="input"
            >
            <x-input-error :messages="$errors->userDeletion->get('password')" />
        </div>

        <div style="display: flex; justify-content: flex-end; gap: 0.75rem;">
            <button type="button" class="btn btn-outline" x-on:click="$dispatch('close')">
                Annuleren
            </button>
            <button type="submit" class="btn btn-danger">
                Account verwijderen
            </button>
        </div>
    </form>
</x-modal>
