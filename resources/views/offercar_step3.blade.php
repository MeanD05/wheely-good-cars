<x-base-layout>
	<div class="container page">
		<div style="max-width: 900px; margin: 0 auto 2rem auto;">
			<div class="progressbar" style="height: 8px; background: #eceff3; border-radius: 6px; overflow: hidden;">
				<div style="width: 100%; height: 100%; background: linear-gradient(90deg, #b71c1c 60%, #e57373 100%); transition: width 0.3s;"></div>
			</div>
			<div style="text-align: right; font-size: 0.9em; color: #b71c1c; margin-top: 0.2em;">Stap 3 van 3</div>
		</div>
		<div class="stack" style="max-width: 900px; margin: 0 auto;">
			<div class="card">
				<h1>Kies tags voor je auto</h1>
				<p class="muted">Selecteer kenmerken zodat je aanbod sneller gevonden wordt.</p>
                <p class="muted">Je kunt later altijd nog tags toevoegen of verwijderen.</p>
				<div class="stack" style="flex-direction: row; flex-wrap: wrap; gap: 0.5rem;">
					<span class="badge">{{ $car->license_plate }}</span>
					<span class="muted">{{ $car->make }} {{ $car->model }}</span>
					<span class="muted">{{ $car->production_year ?? 'Onbekend' }}</span>
				</div>
			</div>

			<form
				method="POST"
				action="{{ route('offercar.store_tags') }}"
				class="card"
			>
				@csrf
				<input type="hidden" name="car_id" value="{{ $car->id }}">

				<div class="grid grid-3">
					@forelse ($tags as $tag)
						<label class="card tag-option" style="padding: 0.75rem;">
							<input
								type="checkbox"
								name="tags[]"
								value="{{ $tag->id }}"
							>
							<span
								class="tag"
								style="background-color: {{ $tag->color }}; color: #fff;"
								aria-hidden="true"
							></span>
							<span>{{ $tag->name }}</span>
						</label>
					@empty
						<div class="card muted" style="text-align: center;">
							Geen tags beschikbaar. Seed de tags om keuzes te tonen.
						</div>
					@endforelse
				</div>

				<div class="stack" style="flex-direction: row; flex-wrap: wrap; gap: 0.75rem; margin-top: 1.5rem;">
					<button type="submit" class="btn btn-red">Tags opslaan</button>
					<a href="{{ route('cars.mycars') }}" class="btn btn-outline">Opslaan zonder tags</a>
				</div>
			</form>
		</div>
	</div>
</x-base-layout>