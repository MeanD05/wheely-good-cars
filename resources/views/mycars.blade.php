<x-base-layout>
    <h1 class="text-2xl font-semibold mb-6">
        Je aangeboden auto’s
    </h1>

    <div class="overflow-x-auto bg-white rounded-xl shadow">
        <table class="min-w-full text-sm text-left text-gray-700">
            <thead class="bg-gray-100 text-gray-900">
                <tr>
                    <th class="px-4 py-3">Kenteken</th>
                    <th class="px-4 py-3">Merk</th>
                    <th class="px-4 py-3">Model</th>
                    <th class="px-4 py-3">Bouwjaar</th>
                    <th class="px-4 py-3">Km stand</th>
                    <th class="px-4 py-3">Kleur</th>
                    <th class="px-4 py-3">Zitpl.</th>
                    <th class="px-4 py-3">Deuren</th>
                    <th class="px-4 py-3">Gewicht</th>
                    <th class="px-4 py-3">Prijs</th>
                    <th class="px-4 py-3">Bekeken</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3 text-right">Acties</th>
                </tr>
            </thead>

            <tbody class="divide-y">
                @forelse($cars as $car)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-semibold">
                            {{ $car->license_plate }}
                        </td>
                        <td class="px-4 py-3">{{ $car->make }}</td>
                        <td class="px-4 py-3">{{ $car->model }}</td>
                        <td class="px-4 py-3">{{ $car->production_year ?? '–' }}</td>
                        <td class="px-4 py-3">
                            {{ number_format($car->mileage, 0, ',', '.') }} km
                        </td>
                        <td class="px-4 py-3">{{ $car->color ?? '–' }}</td>
                        <td class="px-4 py-3">{{ $car->seats ?? '–' }}</td>
                        <td class="px-4 py-3">{{ $car->doors ?? '–' }}</td>
                        <td class="px-4 py-3">
                            {{ $car->weight ? number_format($car->weight, 0, ',', '.') . ' kg' : '–' }}
                        </td>
                        <td class="px-4 py-3 font-semibold">
                            € {{ number_format($car->price, 2, ',', '.') }}
                        </td>
                        <td class="px-4 py-3">{{ $car->views }}</td>
                        <td class="px-4 py-3">
                            @if($car->sold_at)
                                <span class="text-red-600 font-semibold">Verkocht</span>
                            @else
                                <span class="text-green-600 font-semibold">Te koop</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-right space-x-2">
                            <form
                                method="POST"
                                action="{{ route('cars.destroy', $car) }}"
                                class="inline"
                                onsubmit="return confirm('Weet je zeker dat je dit aanbod wilt verwijderen?');"
                            >
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="text-red-600 hover:underline">
                                    Verwijder
                                </button>
                            </form> 
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
