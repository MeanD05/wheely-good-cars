<x-base-layout>
    <x-slot name="title">Offer Car - Wheely Good Cars</x-slot>

    <div class="bg-gray-100 min-h-screen pt-28">
        <div class="container max-w-3xl mx-auto mt-10 mb-16">

            <!-- Kenteken linksboven -->
            <div style="margin-bottom: 2rem;">
                <div style="display: flex; transform: scale(0.75); transform-origin: left;">

                    <!-- NL vlak -->
                    <div
                        style="
                            width: 40px;
                            height: 64px;
                            background-color: #1E3A8A;
                            border: 2px solid #000;
                            border-right: 0;
                            border-radius: 8px 0 0 8px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                        "
                    >
                        <span style="color: #fff; font-size: 10px; font-weight: 600;">NL</span>
                    </div>

                    <!-- Kenteken -->
                    <div
                        style="
                            width: 256px;
                            height: 64px;
                            background-color: #FACC15;
                            border: 2px solid #000;
                            border-left: 0;
                            border-radius: 0 8px 8px 0;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            font-size: 28px;
                            font-weight: 800;
                            letter-spacing: 0.2em;
                            color: #000;
                        "
                    >
                        {{ strtoupper($license_plate ?? '') }}
                    </div>

                </div>
            </div>

            <h2 class="text-2xl font-semibold mb-6">Aanbod plaatsen</h2>
            <p  class="text-gray-600 mb-8">Controleer de gegevens van uw voertuig</p>
            <p class="text-gray-600 mb-8">Indien er onjuistheden zijn, pas deze dan aan en klik op "Aanbod afronden".</p>       

            <form action="{{ route('offercar.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md">
            
                @csrf

                <input type="hidden" name="license_plate" value="{{ $license_plate ?? '' }}">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Merk -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Merk</label>
                        <input type="text" name="make" class="w-full rounded-lg border-gray-300 focus:ring-black focus:border-black" required value="{{ $car_api_data['merk'] ?? '' }}">
                    </div>

                    <!-- Model -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Model</label>
                        <input type="text" name="model"  class="w-full rounded-lg border-gray-300 focus:ring-black focus:border-black" required value="{{ $car_api_data['handelsbenaming'] ?? '' }}">
                    </div>

                    <!-- Zitplaatsen -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Zitplaatsen</label>
                        <input type="number" name="seats" class="w-full rounded-lg border-gray-300 focus:ring-black focus:border-black" value="{{ $car_api_data['aantal_zitplaatsen'] ?? '' }}">
                    </div>

                    <!-- Aantal deuren -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Aantal deuren</label>
                        <input type="number" name="doors"  class="w-full rounded-lg border-gray-300 focus:ring-black focus:border-black" value="{{ $car_api_data['aantal_deuren'] ?? '' }}">
                    </div>

                    <!-- Massa rijklaar -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Massa rijklaar (kg)</label>
                        <input type="number" name="weight"  class="w-full rounded-lg border-gray-300 focus:ring-black focus:border-black" value="{{ $car_api_data['massa_rijklaar'] ?? '' }}">
                    </div>

                    <!-- Jaar van productie -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Jaar van productie</label>
                        <input type="number" name="year"  class="w-full rounded-lg border-gray-300 focus:ring-black focus:border-black" value="{{ substr($car_api_data['datum_eerste_toelating'] ?? '', 0, 4) }}">

                    </div>

                    <!-- Kleur -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Kleur</label>
                        <input type="text" name="color"  class="w-full rounded-lg border-gray-300 focus:ring-black focus:border-black" value="{{ $car_api_data['eerste_kleur'] ?? '' }}">
                    </div>

                    <!-- Kilometerstand -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Kilometerstand</label>
                        <input type="number" name="mileage" class="w-full rounded-lg border-gray-300 focus:ring-black focus:border-black">
                    </div>

                    <!-- Vraagprijs -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium mb-1">Vraagprijs (€)</label>
                        <input type="number" name="price" class="w-full rounded-lg border-gray-300 focus:ring-black focus:border-black">
                    </div>

                    <!-- Foto -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium mb-1">Foto</label>
                        <input type="file" name="image" accept="image/*" class="w-full rounded-lg border-gray-300 focus:ring-black focus:border-black">
                        <p class="mt-1 text-xs text-gray-500">Max 4MB. JPG, PNG of WEBP.</p>
                    </div>

                </div>

                <div class="pt-6">
                    <button
                        type="submit"
                        class="w-full md:w-auto px-8 py-3 bg-blue-700 text-white rounded-lg font-medium hover:bg-gray-800 transition"
                    >
                        Aanbod afronden
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-base-layout>
