<x-base-layout>
    <x-slot name="title">Offer Car - Wheely Good Cars</x-slot>

        <div class="container page">
            <div style="max-width: 860px; margin: 0 auto 2rem auto;">
                <div class="progressbar" style="height: 8px; background: #eceff3; border-radius: 6px; overflow: hidden;">
                    <div style="width: 60%; height: 100%; background: linear-gradient(90deg, #b71c1c 60%, #e57373 100%); transition: width 0.3s;"></div>
                </div>
                <div style="text-align: right; font-size: 0.9em; color: #b71c1c; margin-top: 0.2em;">Stap 2 van 3</div>
            </div>
            <div class="stack" style="max-width: 860px; margin: 0 auto;">

            <div class="plate plate-small">
                <div class="plate-eu">
                    <span>NL</span>
                </div>

                <div class="plate-input" style="display: flex; align-items: center; justify-content: center;">
                    {{ strtoupper($license_plate ?? '') }}
                </div>
            </div>

            <div>
                <h2>Aanbod plaatsen</h2>
                <p class="muted" style="margin-top: 0.5rem;">Controleer de gegevens van uw voertuig.</p>
                <p class="muted">Indien er onjuistheden zijn, pas deze dan aan en klik op "Aanbod afronden".</p>
            </div>

            <form action="{{ route('offercar.store') }}" method="POST" enctype="multipart/form-data" class="card">
            
                @csrf

                <input type="hidden" name="license_plate" value="{{ $license_plate ?? '' }}">

                <div class="grid grid-2">

                    
                    <div>
                        <label class="label">Merk</label>
                        <input type="text" name="make" class="input" required value="{{ $car_api_data['merk'] ?? '' }}">
                    </div>

                    
                    <div>
                        <label class="label">Model</label>
                        <input type="text" name="model" class="input" required value="{{ $car_api_data['handelsbenaming'] ?? '' }}">
                    </div>

                  
                    <div>
                        <label class="label">Zitplaatsen</label>
                        <input type="number" name="seats" class="input" value="{{ $car_api_data['aantal_zitplaatsen'] ?? '' }}">
                    </div>

                   
                    <div>
                        <label class="label">Aantal deuren</label>
                        <input type="number" name="doors" class="input" value="{{ $car_api_data['aantal_deuren'] ?? '' }}">
                    </div>

                  
                    <div>
                        <label class="label">Massa rijklaar (kg)</label>
                        <input type="number" name="weight" class="input" value="{{ $car_api_data['massa_rijklaar'] ?? '' }}">
                    </div>

                   
                    <div>
                        <label class="label">Jaar van productie</label>
                        <input type="number" name="year" class="input" value="{{ substr($car_api_data['datum_eerste_toelating'] ?? '', 0, 4) }}">

                    </div>

                   
                    <div>
                        <label class="label">Kleur</label>
                        <input type="text" name="color" class="input" value="{{ $car_api_data['eerste_kleur'] ?? '' }}">
                    </div>

                  
                    <div>
                        <label class="label">Kilometerstand</label>
                        <input type="number" name="mileage" class="input">
                    </div>

                    
                    <div>
                        <label class="label">Vraagprijs (€)</label>
                        <input type="number" name="price" class="input">
                    </div>

                 
                    <div>
                        <label class="label">Foto</label>
                        <input type="file" name="image" accept="image/*" class="input">
                        <p class="muted" style="margin-top: 0.4rem; font-size: 0.8rem;">Max 4MB. JPG, PNG of WEBP.</p>
                    </div>

                </div>

                <div style="padding-top: 1.5rem;">
                    <button
                        type="submit"
                        class="btn btn-red"
                    >
                        Aanbod afronden
                    </button>
                    <a href="{{ route('home') }}" class="btn btn-outline" style="margin-left: 0.5rem;">Annuleren</a>  
                </div>
            </form>

        </div>
    </div>
</x-base-layout>

