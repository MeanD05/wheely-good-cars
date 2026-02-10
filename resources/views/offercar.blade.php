<x-base-layout>
    <div class="container page">
        <div class="card" style="max-width: 640px; margin: 0 auto;">
            <form method="POST" action="{{ route('offercar.step1') }}">
                @csrf

                <div style="text-align: center; margin-bottom: 2rem;">
                    <h2>Voer kenteken in</h2>
                    <p class="muted" style="margin-top: 0.5rem;">We halen daarna automatisch de basisgegevens op.</p>
                </div>

                <div style="display: flex; justify-content: center; margin-bottom: 1.5rem;">
                    <div class="plate">
                        <div class="plate-eu">
                            <span>NL</span>
                        </div>

                        <input
                            id="license_plate"
                            name="license_plate"
                            type="text"
                            inputmode="text"
                            autocomplete="off"
                            placeholder="12-ABC-3"
                            maxlength="8"
                            oninput="this.value = this.value.toUpperCase().replace(/[^A-Z0-9-]/g, '').slice(0, 8);"
                            class="plate-input"
                            required
                        />
                    </div>
                </div>

                <div style="text-align: center; margin-bottom: 2rem;">
                    <p class="muted">Alleen letters, cijfers en koppelteken.</p>
                </div>

                <button
                    type="submit"
                    class="btn btn-red"
                    style="width: 100%;"
                >
                    Ga verder
                </button>

                <p class="muted" style="text-align: center; margin-top: 1rem; font-size: 0.8rem;">
                    Door verder te gaan ga je door naar de volgende stap.
                </p>
            </form>

        </div>
    </div>
</x-base-layout>
