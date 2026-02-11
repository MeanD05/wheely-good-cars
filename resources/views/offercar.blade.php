<x-base-layout>
    <div class="container page">
        <div style="max-width: 640px; margin: 0 auto 2rem auto;">
            <div class="progressbar" style="height: 8px; background: #eceff3; border-radius: 6px; overflow: hidden;">
                <div style="width: 20%; height: 100%; background: linear-gradient(90deg, #b71c1c 60%, #e57373 100%); transition: width 0.3s;"></div>
            </div>
            <div style="text-align: right; font-size: 0.9em; color: #b71c1c; margin-top: 0.2em;">Stap 1 van 3</div>
        </div>
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
