<x-base-layout>
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-semibold text-gray-900">
            Je aangeboden auto’s
        </h1>
        <span class="text-sm text-gray-500">
            Totaal: {{ $cars->count() }}
        </span>
    </div>

    <div class="bg-white rounded-2xl shadow-sm ring-1 ring-gray-200 w-full max-w-full">
        <table class="w-full table-auto text-xs text-left text-gray-700">
            <thead class="bg-gray-50 text-gray-700 uppercase text-[10px] tracking-wide">
                <tr>
                    <th class="px-3 py-2 whitespace-normal">Kenteken</th>
                    <th class="px-3 py-2 whitespace-normal">Merk</th>
                    <th class="px-3 py-2 whitespace-normal">Model</th>
                    <th class="px-3 py-2 whitespace-normal">Bouwjaar</th>
                    <th class="px-3 py-2 whitespace-normal">Km</th>
                    <th class="px-3 py-2 whitespace-normal">Kleur</th>
                    <th class="px-3 py-2 whitespace-normal">Zitpl.</th>
                    <th class="px-3 py-2 whitespace-normal">Deuren</th>
                    <th class="px-3 py-2 whitespace-normal">Gewicht</th>
                    <th class="px-3 py-2 whitespace-normal">Prijs/Status</th>
                    <th class="px-3 py-2 text-center whitespace-normal">Bekeken</th>
                    <th class="px-3 py-2 text-right whitespace-normal">Acties</th>
                </tr>
            </thead>

            <tbody class="divide-y">
                @forelse($cars as $car)
                    <tr class="hover:bg-gray-50/70 transition">
                        <td class="px-3 py-2 align-top font-semibold text-gray-900 break-words">
                            {{ $car->license_plate }}
                        </td>
                        <td class="px-3 py-2 align-top text-gray-800 break-words">{{ $car->make }}</td>
                        <td class="px-3 py-2 align-top text-gray-800 break-words">{{ $car->model }}</td>
                        <td class="px-3 py-2 align-top text-gray-600">{{ $car->production_year ?? '–' }}</td>
                        <td class="px-3 py-2 align-top text-gray-600">
                            {{ number_format($car->mileage, 0, ',', '.') }} km
                        </td>
                        <td class="px-3 py-2 align-top text-gray-600 break-words">{{ $car->color ?? '–' }}</td>
                        <td class="px-3 py-2 align-top text-gray-600">{{ $car->seats ?? '–' }}</td>
                        <td class="px-3 py-2 align-top text-gray-600">{{ $car->doors ?? '–' }}</td>
                        <td class="px-3 py-2 align-top text-gray-600">
                            {{ $car->weight ? number_format($car->weight, 0, ',', '.') . ' kg' : '–' }}
                        </td>
                        <td class="px-3 py-2 align-top">
                            <livewire:car-status :car="$car" />
                        </td>
                        <td class="px-3 py-2 align-top text-center text-gray-600">
                            {{ number_format($car->views, 0, ',', '.') }}
                        </td>
                        <td class="px-3 py-2 align-top text-right">
                            <div class="inline-flex items-center gap-2">
                                <a href="{{ route('cars.pdf', $car) }}"
                                   class="text-blue-600 hover:text-blue-700 hover:underline">
                                    Genereer PDF
                                </a>
                                <form
                                    method="POST"
                                    action="{{ route('cars.destroy', $car) }}"
                                    class="inline"
                                    onsubmit="return confirm('Weet je zeker dat je dit aanbod wilt verwijderen?');"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-red-600 hover:text-red-700 hover:underline">
                                        Verwijder
                                    </button>
                                </form> 
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="13" class="px-4 py-6 text-center text-gray-500">
                            Je hebt nog geen auto’s aangeboden.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-base-layout>
