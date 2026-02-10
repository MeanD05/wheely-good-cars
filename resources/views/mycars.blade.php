<x-base-layout>
    <div class="mx-auto w-full max-w-6xl mt-20">
        <div class="mb-6 rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-xs uppercase tracking-[0.2em] text-gray-500">Mijn aanbod</p>
                    <h1 class="text-3xl font-semibold text-gray-900">Je aangeboden auto's</h1>
                    <p class="mt-1 text-sm text-gray-600">Overzicht van jouw actieve en concept aanbiedingen.</p>
                </div>
                <div class="flex items-center gap-3">
                    <div class="rounded-full border border-gray-200 bg-white px-4 py-2 text-sm text-gray-700 shadow-sm">
                        Totaal: <span class="font-semibold text-gray-900">{{ $cars->total() }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-4">
            @forelse($cars as $car)
                <article class="group rounded-2xl border border-gray-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                    <div class="flex flex-col gap-5 lg:flex-row lg:items-start lg:justify-between">
                        <div class="h-28 w-full overflow-hidden rounded-xl border border-gray-200 bg-gray-100 sm:h-32 sm:w-48 lg:w-44">
                            @if ($car->image)
                                <img
                                    src="{{ $car->image }}"
                                    alt="{{ $car->make }} {{ $car->model }}"
                                    class="h-full w-full object-contain bg-white"
                                    loading="lazy"
                                >
                            @else
                                <div class="flex h-full w-full items-center justify-center text-xs text-gray-400">
                                    Geen foto
                                </div>
                            @endif
                        </div>
                        <div class="min-w-0 flex-1">
                            <div class="flex flex-wrap items-center gap-3">
                                <span class="rounded-full bg-gray-900 px-3 py-1 text-xs font-semibold uppercase tracking-widest text-white">
                                    {{ $car->license_plate }}
                                </span>
                                <h2 class="text-lg font-semibold text-gray-900">
                                    {{ $car->make }} {{ $car->model }}
                                </h2>
                                <span class="text-sm text-gray-500">{{ $car->production_year ?? '–' }}</span>
                            </div>

                            <div class="mt-4 grid grid-cols-2 gap-4 text-sm text-gray-600 sm:grid-cols-3 lg:grid-cols-4">
                                <div>
                                    <p class="text-[10px] uppercase tracking-widest text-gray-400">Kilometers</p>
                                    <p class="mt-1 font-semibold text-gray-900">
                                        {{ number_format($car->mileage, 0, ',', '.') }} km
                                    </p>
                                </div>
                                <div>
                                    <p class="text-[10px] uppercase tracking-widest text-gray-400">Kleur</p>
                                    <p class="mt-1 font-semibold text-gray-900">{{ $car->color ?? '–' }}</p>
                                </div>
                                <div>
                                    <p class="text-[10px] uppercase tracking-widest text-gray-400">Zitplaatsen</p>
                                    <p class="mt-1 font-semibold text-gray-900">{{ $car->seats ?? '–' }}</p>
                                </div>
                                <div>
                                    <p class="text-[10px] uppercase tracking-widest text-gray-400">Deuren</p>
                                    <p class="mt-1 font-semibold text-gray-900">{{ $car->doors ?? '–' }}</p>
                                </div>
                                <div>
                                    <p class="text-[10px] uppercase tracking-widest text-gray-400">Gewicht</p>
                                    <p class="mt-1 font-semibold text-gray-900">
                                        {{ $car->weight ? number_format($car->weight, 0, ',', '.') . ' kg' : '–' }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-[10px] uppercase tracking-widest text-gray-400">Bekeken</p>
                                    <p class="mt-1 font-semibold text-gray-900">
                                        {{ number_format($car->views, 0, ',', '.') }} keer
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="flex w-full flex-col gap-3 lg:w-56 lg:items-end">
                            <div class="w-full rounded-2xl border border-gray-200 bg-white p-3">
                                <div class="flex items-center justify-between text-[10px] uppercase tracking-widest text-gray-400">
                                    <span>Views</span>
                                    <span aria-hidden="true">👁</span>
                                </div>
                                <p class="mt-2 text-2xl font-semibold text-gray-900">
                                    {{ number_format($car->views, 0, ',', '.') }}
                                </p>
                                <p class="text-xs text-gray-500">keer bekeken</p>
                            </div>
                            <div class="w-full rounded-2xl border border-gray-200 bg-gray-50 p-3">
                                <p class="text-[10px] uppercase tracking-widest text-gray-400">Prijs / Status</p>
                                <div class="mt-2">
                                    <livewire:car-status :car="$car" />
                                </div>
                            </div>
                            <div class="flex flex-wrap gap-2 lg:flex-col lg:items-end">
                                <a
                                    href="{{ route('cars.pdf', $car) }}"
                                    class="inline-flex items-center justify-center rounded-full border border-blue-200 bg-blue-50 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-blue-700 transition hover:border-blue-300 hover:bg-blue-100"
                                >
                                    Genereer PDF
                                </a>
                                <a
                                    href="{{ route('cars.tags.edit', $car) }}"
                                    class="inline-flex items-center justify-center rounded-full border border-emerald-200 bg-emerald-50 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-emerald-700 transition hover:border-emerald-300 hover:bg-emerald-100"
                                >
                                    Tags bewerken
                                </a>
                                <form
                                    method="POST"
                                    action="{{ route('cars.destroy', $car) }}"
                                    class="inline"
                                    onsubmit="return confirm('Weet je zeker dat je dit aanbod wilt verwijderen?');"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        class="inline-flex items-center justify-center rounded-full border border-red-200 bg-red-50 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-red-700 transition hover:border-red-300 hover:bg-red-100"
                                    >
                                        Verwijder
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </article>
            @empty
                <div class="rounded-3xl border border-dashed border-gray-300 bg-white p-10 text-center">
                    <p class="text-sm uppercase tracking-[0.3em] text-gray-400">Nog leeg</p>
                    <h2 class="mt-3 text-xl font-semibold text-gray-900">Je hebt nog geen auto's aangeboden.</h2>
                    <p class="mt-2 text-sm text-gray-600">Start met het plaatsen van een aanbod en het verschijnt hier meteen.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $cars->links() }}
        </div>
    </div>
</x-base-layout>
