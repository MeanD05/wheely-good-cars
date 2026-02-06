<x-base-layout>
    <div class="min-h-screen bg-gray-100 flex items-center justify-center px-4">
        <div class="w-full max-w-xl">

            <form method="POST"
                  action="{{ route('offercar.step1') }}"
                  class="rounded-2xl shadow-lg border border-gray-200">
                @csrf

                <div class="text-center mb-8">
                    <h2 class="text-3xl font-semibold">Voer kenteken in</h2>
                    <p class="text-gray-500 mt-2">We halen daarna automatisch de basisgegevens op.</p>
                </div>

                <div class="flex justify-center mb-6">
                    <div style="display: flex; transform: scale(1); transform-origin: center;">

                       
                        <div
                            style="
                                width: 44px;
                                height: 70px;
                                background-color: #1E3A8A;
                                border: 2px solid #000;
                                border-right: 0;
                                border-radius: 12px 0 0 12px;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                flex-shrink: 0;
                                box-shadow: 0 6px 16px rgba(0,0,0,0.10);
                            "
                        >
                            <span style="color: #fff; font-size: 11px; font-weight: 700; letter-spacing: 0.06em;">NL</span>
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
                            style="
                                width: 300px;
                                height: 70px;
                                background-color: #FACC15;
                                border: 2px solid #000;
                                border-left: 0;
                                border-radius: 0 12px 12px 0;
                                font-size: 30px;
                                font-weight: 900;
                                letter-spacing: 0.18em;
                                color: #000;
                                outline: none;
                                padding: 0 16px;
                                text-align: center;
                                box-shadow: 0 6px 16px rgba(0,0,0,0.10);
                            "
                            required
                        />
                    </div>
                </div>

                <div class="text-center mb-8">
                    <p class="text-sm text-gray-500">Alleen letters, cijfers en koppelteken.</p>
                </div>

                <button
                    type="submit"
                    class="w-full bg-blue-700 text-white px-10 py-4 rounded-xl text-lg font-semibold hover:bg-gray-800 transition shadow-md hover:shadow-lg"
                >
                    Ga verder
                </button>

                <p class="text-xs text-gray-400 text-center mt-4">
                    Door verder te gaan ga je door naar de volgende stap.
                </p>
            </form>

        </div>
    </div>
</x-base-layout>
