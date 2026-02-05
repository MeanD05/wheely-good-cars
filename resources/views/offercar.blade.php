<x-base-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <form method="POST"
              action="{{ route('offercar.step1') }}"
              class="flex flex-col items-center gap-8">
            @csrf

            <label for="license_plate" class="text-black text-base font-semibold">
                Voer kenteken in
            </label>

         
            <div class="flex scale-125">
             
                <div class="w-20 h-32 bg-blue-700 rounded-l-xl border-4 border-r-0 border-black flex items-center justify-center">
                    <span class="text-white text-sm font-semibold">NL</span>
                </div>

               
                <input
                    id="license_plate"
                    name="license_plate"
                    type="text"
                    inputmode="text"
                    autocomplete="off"
                    placeholder="12ABC3"
                    maxlength="8"
                    oninput="this.value = this.value.toUpperCase().replace(/[^A-Z0-9-]/g, '') .slice(0, 8);"
                    style="
                        background-color: #FACC15;
                        color: #000000;
                        text-align: center;
                        font-size: 3.75rem;
                        font-weight: 800;
                        letter-spacing: 0.25em;
                        border: 4px solid #000000;
                        border-left: 0;
                        border-radius: 0 0.75rem 0.75rem 0;
                        height: 8rem;
                        width: 40rem;
                        outline: none;
                    "
                    required
                >
            </div>

            <!-- Button -->
            <button
                type="submit"
                class="w-full bg-blue-700 text-white px-10 py-4 rounded-xl text-lg font-semibold hover:bg-gray-800 transition">
                Ga
            </button>
        </form>
    </div>
</x-base-layout>
