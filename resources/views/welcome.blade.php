<x-base-layout>
    <main class="bg-gray-50">
        <div class="max-w-5xl mx-auto px-4 py-16 text-center">

            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900">
                Welkom bij WheelyGoodCars
            </h1>

            <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">
                WheelyGoodCars is een online marktplaats waar kopen en verkopen van auto's
                eenvoudig, transparant en betrouwbaar samenkomt.
            </p>

            <p class="mt-2 text-gray-600 max-w-2xl mx-auto">
                Of je nu op zoek bent naar je volgende auto of jouw huidige auto wilt aanbieden,
                hier regel je het zonder gedoe.
            </p>

                <a href="{{ route('offercar') ?? '#' }}"
                   class="px-6 py-3 rounded-2xl bg-blue-600 text-white font-bold hover:bg-blue-700 transition mt-8 inline-block">
                    Auto verkopen
                </a>
            </div>

        </div>
    </main>
</x-base-layout>
