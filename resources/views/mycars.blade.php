<x-base-layout>
    <div class="container page stack">
        <div class="card">
            <div class="card-header">
                <div>
                    <h1>Je aangeboden auto's</h1>
                    <p class="muted">Overzicht van jouw actieve en concept aanbiedingen.</p>
                </div>
                <div class="badge">Totaal: {{ $cars->total() }}</div>
            </div>
        </div>

        <div class="stack">
            @forelse($cars as $car)
                <article class="card">
                    <div class="card-row">
                        <div class="card-media-square">
                            @if ($car->image)
                                <img
                                    src="{{ $car->image }}"
                                    alt="{{ $car->make }} {{ $car->model }}"
                                    class="h-full w-full object-contain"
                                    loading="lazy"
                                >
                            @else
                                <div class="muted" style="text-align: center;">
                                    Geen foto
                                </div>
                            @endif
                        </div>
                        <div class="stack" style="gap: 0.5rem; flex: 1;">
                            <div class="stack" style="flex-direction: row; flex-wrap: wrap; gap: 0.5rem; align-items: center;">
                                <span class="badge">{{ $car->license_plate }}</span>
                                <h2>{{ $car->make }} {{ $car->model }}</h2>
                                <span class="muted">{{ $car->production_year ?? '–' }}</span>
                            </div>

                            <div class="grid grid-3">
                                <div>
                                    <p class="muted">Kilometers</p>
                                    <p><strong>{{ number_format($car->mileage, 0, ',', '.') }} km</strong></p>
                                </div>
                                <div>
                                    <p class="muted">Kleur</p>
                                    <p><strong>{{ $car->color ?? '–' }}</strong></p>
                                </div>
                                <div>
                                    <p class="muted">Zitplaatsen</p>
                                    <p><strong>{{ $car->seats ?? '–' }}</strong></p>
                                </div>
                                <div>
                                    <p class="muted">Deuren</p>
                                    <p><strong>{{ $car->doors ?? '–' }}</strong></p>
                                </div>
                                <div>
                                    <p class="muted">Gewicht</p>
                                    <p><strong>{{ $car->weight ? number_format($car->weight, 0, ',', '.') . ' kg' : '–' }}</strong></p>
                                </div>
                                <div>
                                    <p class="muted">Bekeken</p>
                                    <p><strong>{{ number_format($car->views, 0, ',', '.') }} keer</strong></p>
                                </div>
                            </div>
                        </div>

                        <div class="stack" style="min-width: 220px;">
                            <div class="card" style="padding: 0.75rem;">
                                <p class="muted">Prijs / Status</p>
                                <div style="margin-top: 0.5rem;">
                                    <livewire:car-status :car="$car" />
                                </div>
                            </div>

                            <div class="stack" style="flex-direction: row; flex-wrap: wrap; gap: 0.5rem;">
                                <a href="{{ route('cars.pdf', $car) }}" class="btn btn-outline">Genereer PDF</a>
                                <a href="{{ route('cars.tags.edit', $car) }}" class="btn btn-outline">Tags bewerken</a>
                                <form
                                    method="POST"
                                    action="{{ route('cars.destroy', $car) }}"
                                    onsubmit="return confirm('Weet je zeker dat je dit aanbod wilt verwijderen?');"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Verwijder</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </article>
            @empty
                <div class="card" style="text-align: center;">
                    <p class="muted">Nog leeg</p>
                    <h2>Je hebt nog geen auto's aangeboden.</h2>
                    <p class="muted">Start met het plaatsen van een aanbod en het verschijnt hier meteen.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $cars->links() }}
        </div>
    </div>
</x-base-layout>
