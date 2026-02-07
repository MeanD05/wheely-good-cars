<x-base-layout>
    <main class="max-w-4xl mx-auto p-6 space-y-6">

        @foreach ($cars as $car )

       
            <div class="bg-white shadow-lg rounded-xl hover:shadow-2xl transition-shadow duration-300 p-6 flex flex-col justify-between">
                
            
                <div class="text-2xl font-bold text-gray-800 mb-2">
                    @if ($car->model !== 'N/A' && $car->model !== 'N.v.t')
                        {{ $car->make }} {{ $car->model }} 
                    @else
                        {{ $car->make }}
                    @endif
                        
                </div>
                
                <div class="text-gray-600 mb-4">
                    <p>Door: {{ $car->user->name }}</p>
                </div>
                
            
                <div class="mt-auto text-right text-xl font-extrabold text-green-600">
                    <p>€ {{ number_format($car->price, 2, ',', '.') }}</p>
                </div>
            </div>
        @endforeach

    </main>
</x-base-layout>
