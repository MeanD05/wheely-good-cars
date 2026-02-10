<x-base-layout>
    <main class="max-w-5xl mx-auto p-6 space-y-6">
    @if ($cars->isEmpty())
        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4" role="alert">
            <p class="font-bold">Geen auto's beschikbaar</p>
        </div>
    @endif

        @foreach ($cars as $car)
        
        
            <div class="bg-white border border-black ">
                
                <div class="flex">
                    
                    
                    <div class="w-1/3 bg-gray-100">
                        <img src="public/img/Foto-gastenwagen-vierkant-scaled.jpg">
                    </div>

                   
                    <div class="w-2/3 p-6 flex flex-col justify-between">
                        
                        <div>
                            <h2 class="text-2xl font-semibold text-gray-800">
                                @if ($car->model !== 'N/A' && $car->model !== 'N.v.t')
                                    {{ $car->make }} {{ $car->model }}
                                @else
                                    {{ $car->make }}
                                @endif
                            </h2>

                            <p class="text-sm text-gray-500 mt-1">
                                Verkoper: <span class="font-medium text-gray-700">{{ $car->user->name }}</span>
                            </p>
                        </div>

                        <div class="flex items-end justify-between mt-6">
                            <span class="text-sm text-gray-400">
                                Inclusief btw
                            </span>

                            <span class="text-2xl font-bold text-green-600">
                                € {{ number_format($car->price, 2, ',', '.') }}
                            </span>
                        </div>
                    </div>

                </div>
            </div>
        @endforeach

    </main>
</x-base-layout>
