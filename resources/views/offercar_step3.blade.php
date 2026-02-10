<x-base-layout>
	<div class="min-h-screen bg-gray-100 px-4 py-16">
		<div class="mx-auto w-full max-w-4xl">
			<div class="mb-6 rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
				<p class="text-xs uppercase tracking-[0.2em] text-gray-500">Laatste stap</p>
				<h1 class="text-3xl font-semibold text-gray-900">Kies tags voor je auto</h1>
				<p class="mt-2 text-sm text-gray-600">
					Selecteer kenmerken zodat je aanbod sneller gevonden wordt.
				</p>
                <p class="mt-1 text-sm text-gray-500">
                    Je kunt later altijd nog tags toevoegen of verwijderen.
				</p>
				<div class="mt-4 flex flex-wrap items-center gap-3 text-sm text-gray-600">
					<span class="rounded-full bg-gray-900 px-3 py-1 text-xs font-semibold uppercase tracking-widest text-white">
						{{ $car->license_plate }}
					</span>
					<span>{{ $car->make }} {{ $car->model }}</span>
					<span class="text-gray-400">{{ $car->production_year ?? 'Onbekend' }}</span>
				</div>
			</div>

			<form
				method="POST"
				action="{{ route('offercar.store_tags') }}"
				class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200"
			>
				@csrf
				<input type="hidden" name="car_id" value="{{ $car->id }}">

				<div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
					@forelse ($tags as $tag)
						<label class="flex cursor-pointer items-center gap-3 rounded-xl border border-gray-200 p-3 transition hover:border-gray-300">
							<input
								type="checkbox"
								name="tags[]"
								value="{{ $tag->id }}"
								class="h-4 w-4 rounded border-gray-300 text-gray-900 focus:ring-gray-900"
							>
							<span
								class="inline-flex h-6 w-6 items-center justify-center rounded-full"
								style="background-color: {{ $tag->color }}"
								aria-hidden="true"
							></span>
							<span class="text-sm font-semibold text-gray-800">
								{{ $tag->name }}
							</span>
						</label>
					@empty
						<div class="sm:col-span-2 lg:col-span-3 rounded-xl border border-dashed border-gray-300 bg-gray-50 p-6 text-center text-sm text-gray-500">
							Geen tags beschikbaar. Seed de tags om keuzes te tonen.
						</div>
					@endforelse
				</div>

				<div class="mt-8 flex flex-wrap items-center gap-3">
					<button
						type="submit"
						class="inline-flex items-center justify-center rounded-xl bg-blue-700 px-8 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-gray-800"
					>
						Tags opslaan
					</button>
					<a
						href="{{ route('home') }}"
						class="inline-flex items-center justify-center rounded-xl border border-gray-200 bg-white px-8 py-3 text-sm font-semibold text-gray-700 shadow-sm transition hover:-translate-y-0.5 hover:shadow"
					>
						Overslaan
					</a>
				</div>
			</form>
		</div>
	</div>
</x-base-layout>