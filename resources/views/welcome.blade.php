<x-base-layout>
    <main class="max-w-7xl mx-auto p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">
            Aanbod van {{ $cars->total() }} {{ Str::plural('auto', $cars->total()) }}
        </h1>

        @if ($cars->isEmpty())
            <div class="bg-gray-50 border border-gray-200 text-gray-500 p-4 text-center italic rounded-md">
                Nog geen auto’s geplaatst.
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($cars as $car)
                    <a
                        href="{{ route('car.show', $car) }}"
                        class="flex h-full flex-col bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm
                               hover:shadow-md transition-shadow duration-200"
                        aria-label="Bekijk {{ $car->make }} {{ $car->model }}"
                    >

                        {{-- Image --}}
                        <div class="h-40 bg-gray-100 flex items-center justify-center">
                            @if ($car->image)
                                <img
                                    src="{{ $car->image }}"
                                    alt="{{ $car->make }} {{ $car->model }}"
                                    class="object-cover w-full h-full"
                                    loading="lazy"
                                    onerror="this.onerror=null;this.parentNode.innerHTML=document.getElementById('car-image-placeholder').innerHTML;"
                                >
                            @else
                                <svg width="400" height="250" viewBox="0 0 400 250" class="w-full h-full">
                                    <defs>
                                        <linearGradient id="placeholder-bg" x1="0" y1="0" x2="0" y2="1">
                                            <stop offset="0%" stop-color="#f6f7f9" />
                                            <stop offset="100%" stop-color="#eceff3" />
                                        </linearGradient>
                                    </defs>
                                    <rect width="400" height="250" fill="url(#placeholder-bg)" rx="14" ry="14" />
                                    <rect x="24" y="24" width="352" height="202" rx="10" ry="10" fill="none" stroke="#d6dbe1" />
                                    <path d="M86 162 Q108 126 146 126 H254 Q292 126 314 162" fill="none" stroke="#b9c0c9" stroke-width="8" stroke-linecap="round" />
                                    <path d="M100 168 Q120 142 146 142 H254 Q280 142 300 168" fill="#d9dee5" />
                                    <circle cx="128" cy="176" r="12" fill="#9aa3ad" />
                                    <circle cx="272" cy="176" r="12" fill="#9aa3ad" />
                                    <rect x="172" y="118" width="56" height="16" rx="6" fill="#c6ccd4" />
                                    <text x="50%" y="196" text-anchor="middle" fill="#6b7280" font-family="Arial, sans-serif" font-size="15" letter-spacing="0.02em">
                                        Geen afbeelding beschikbaar
                                    </text>
                                </svg>
                            @endif
                        </div>

                        {{-- Content --}}
                        <div class="flex flex-1 flex-col p-4 space-y-3">

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
                                    <span class="bg-blue-100 text-green-700 px-2 py-1 rounded">
                                        Verkocht
                                    </span>
                                @else
                                    <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded">
                                        Te koop
                                    </span>
                                @endif
                            </div>

                            <div class="mt-auto flex max-w-full flex-nowrap gap-2 overflow-x-auto pt-2 pb-1 text-xs text-gray-600">
                                @if ($car->tags && $car->tags->isNotEmpty())
                                    @foreach ($car->tags as $tag)
                                        <span
                                            class="shrink-0 px-2 py-1 rounded text-white"
                                            style="background-color: {{ $tag->color }}"
                                        >
                                            {{ $tag->name }}
                                        </span>
                                    @endforeach
                                @else
                                    <span class="text-xs text-gray-400">Geen tags</span>
                                @endif
                            </div>

                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $cars->links() }}
            </div>
        @endif

        <template id="car-image-placeholder">
            <svg width="400" height="250" viewBox="0 0 400 250" class="w-full h-full">
                <defs>
                    <linearGradient id="placeholder-bg" x1="0" y1="0" x2="0" y2="1">
                        <stop offset="0%" stop-color="#f6f7f9" />
                        <stop offset="100%" stop-color="#eceff3" />
                    </linearGradient>
                </defs>
                <rect width="400" height="250" fill="url(#placeholder-bg)" rx="14" ry="14" />
                <rect x="24" y="24" width="352" height="202" rx="10" ry="10" fill="none" stroke="#d6dbe1" />
                <path d="M86 162 Q108 126 146 126 H254 Q292 126 314 162" fill="none" stroke="#b9c0c9" stroke-width="8" stroke-linecap="round" />
                <path d="M100 168 Q120 142 146 142 H254 Q280 142 300 168" fill="#d9dee5" />
                <circle cx="128" cy="176" r="12" fill="#9aa3ad" />
                <circle cx="272" cy="176" r="12" fill="#9aa3ad" />
                <rect x="172" y="118" width="56" height="16" rx="6" fill="#c6ccd4" />
                <text x="50%" y="196" text-anchor="middle" fill="#6b7280" font-family="Arial, sans-serif" font-size="15" letter-spacing="0.02em">
                    Geen afbeelding beschikbaar
                </text>
            </svg>
        </template>

    </main>
</x-base-layout>
