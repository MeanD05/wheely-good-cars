<x-base-layout>
    <main class="max-w-7xl mx-auto p-6">

        @if ($cars->isEmpty())
            <div class="bg-gray-50 border border-gray-200 text-gray-500 p-4 text-center italic rounded-md">
                Nog geen auto’s geplaatst.
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($cars as $car)
                    <div
                        class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm
                               hover:shadow-md transition-shadow duration-200">

                        {{-- Image --}}
                        <div class="h-40 bg-gray-100 flex items-center justify-center">
                            @if ($car->image)
                                <img
                                    src="{{ $car->image }}"
                                    alt="{{ $car->make }} {{ $car->model }}"
                                    class="object-cover w-full h-full"
                                    loading="lazy"
                                >
                            @else
                                <img
                                    src="{{ asset('images/placeholder-car.png') }}"
                                    alt="Geen afbeelding beschikbaar"
                                    class="object-contain w-full h-full p-4 opacity-60"
                                    loading="lazy"
                                >
                            @endif
                        </div>

                        {{-- Content --}}
                        <div class="p-4 space-y-3">

                            <div class="text-xs text-gray-400 tracking-wide">
                                {{ $car->license_plate }}
                            </div>

                            <h2 class="text-base font-semibold text-gray-800 leading-tight">
                                {{ $car->make }} {{ $car->model }}
                            </h2>

                            <div class="flex items-center justify-between pt-1">
                                <span class="text-lg font-bold text-green-600">
                                    €{{ number_format($car->price, 0, ',', '.') }}
                                </span>

                                <span class="text-sm text-gray-500">
                                    {{ $car->production_year }}
                                </span>
                            </div>

                            {{-- Badges --}}
                            <div class="flex flex-wrap gap-2 pt-2 text-xs text-gray-600">
                                <span class="bg-gray-100 px-2 py-1 rounded">
                                    {{ number_format($car->mileage, 0, ',', '.') }} km
                                </span>

                                @if ($car->sold_at)
                                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded">
                                        Verkocht
                                    </span>
                                @else
                                    <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded">
                                        Te koop
                                    </span>
                                @endif

                                <span class="bg-gray-100 px-2 py-1 rounded">
                                    👁 {{ $car->views }}
                                </span>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </main>
</x-base-layout>
