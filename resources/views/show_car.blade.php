<x-base-layout>
	<div class="container page stack">
		<a href="{{ route('home') }}" class="btn btn-outline" style="width: fit-content;">
			<span aria-hidden="true">←</span>
			Terug naar aanbod
		</a>

		<div class="grid grid-2">
			<section class="card">
				<div>
					<div class="card-media" style="height: 320px;">
						@if ($car->image)
							<img
								src="{{ $car->image }}"
								alt="{{ $car->make }} {{ $car->model }}"
								class="h-full w-full object-contain"
								loading="lazy"
								onerror="this.onerror=null;this.parentNode.innerHTML=document.getElementById('car-image-placeholder').innerHTML;"
							>
						@else
							<svg width="400" height="250" viewBox="0 0 400 250" class="h-full w-full">
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

					<div class="stack" style="flex-direction: row; flex-wrap: wrap; gap: 0.5rem; margin-top: 1rem;">
						<span class="badge">{{ $car->license_plate }}</span>
						@if ($car->sold_at)
							<span class="pill pill-success">Verkocht</span>
						@else
							<span class="pill pill-warning">Te koop</span>
						@endif
					</div>
				</div>

                <div class="stack" style="margin-top: 1rem;">
                    <div class="card-header">
                        <div>
                            <p class="muted">{{ $car->production_year ?? 'Onbekend' }}</p>
                            <h1>{{ $car->make }} {{ $car->model }}</h1>
                        </div>
                        <div>
                            <p class="muted">Prijs</p>
                            <p class="price">€{{ number_format($car->price, 0, ',', '.') }}</p>
                        </div>
                    </div>

                    <div class="grid grid-2">
                        <div class="card">
                            <p class="muted">Kilometerstand</p>
                            <p><strong>{{ number_format($car->mileage, 0, ',', '.') }} km</strong></p>
                        </div>
                        <div class="card">
                            <p class="muted">Kleur</p>
                            <p><strong>{{ $car->color ?? 'Onbekend' }}</strong></p>
                        </div>
                        <div class="card">
                            <p class="muted">Zitplaatsen</p>
                            <p><strong>{{ $car->seats ?? '–' }}</strong></p>
                        </div>
                        <div class="card">
                            <p class="muted">Deuren</p>
                            <p><strong>{{ $car->doors ?? '–' }}</strong></p>
                        </div>
                    </div>

                    <div class="card">
                        <p class="muted">Tags</p>
                        <div class="stack" style="flex-direction: row; flex-wrap: wrap; gap: 0.5rem;">
                            @if ($car->tags && $car->tags->isNotEmpty())
                                @foreach ($car->tags as $tag)
                                    <span class="tag" style="background-color: {{ $tag->color }}; color: #fff;">
                                        {{ $tag->name }}
                                    </span>
                                @endforeach
                            @else
                                <span class="muted">Geen tags toegevoegd</span>
                            @endif
                        </div>
                    </div>
                </div>
			</section>

			<aside class="stack">
				<div class="card">
					<p class="muted">Status</p>
					@if ($car->sold_at)
						<span class="pill pill-success">Verkocht</span>
					@else
						<span class="pill pill-warning">Te koop</span>
					@endif

					<div class="stack" style="margin-top: 1rem;">
						<div class="card">
							<p class="muted">Bouwjaar</p>
							<p><strong>{{ $car->production_year ?? '–' }}</strong></p>
						</div>
						<div class="card">
							<p class="muted">Gewicht</p>
							<p><strong>{{ $car->weight ? number_format($car->weight, 0, ',', '.') . ' kg' : '–' }}</strong></p>
						</div>
					</div>
				</div>

				<div class="card">
					<p class="muted">Aanbieder</p>
					<div class="stack" style="gap: 0.5rem;">
						<div class="card-header">
							<span>Naam</span>
							<span><strong>{{ $car->user->name ?? 'Onbekend' }}</strong></span>
						</div>
						<div class="card-header">
							<span>E-mailadres</span>
							<span><strong>{{ $car->user->email ?? 'Onbekend' }}</strong></span>
						</div>
						<div class="card-header">
							<span>Telefoon</span>
							<p><strong>{{ $car->user->phone_number ?? 'Onbekend' }}</strong></p>
						</div>
					</div>
				</div>

				<div class="card">
					<h2>Interesse?</h2>
					<p class="muted">Neem contact op met de aanbieder om een afspraak of proefrit te plannen.</p>
					<p class="muted">E-mail: <strong>{{ $car->user->email ?? 'Onbekend' }}</strong></p>
					<div class="stack" style="flex-direction: row; flex-wrap: wrap; gap: 0.5rem;">
						@if (!empty($car->user->email))
							<a href="mailto:{{ $car->user->email }}" class="btn btn-red">E-mail aanbieder</a>
						@endif
						@if (!empty($car->user->phone_number))
							<a href="tel:{{ $car->user->phone_number }}" class="btn btn-outline">Bel aanbieder</a>
						@endif
					</div>
				</div>

				<div class="card">
					<p class="muted">Registratie</p>
					<div class="stack" style="gap: 0.5rem;">
						<div class="card-header">
							<span>Kenteken</span>
							<span><strong>{{ $car->license_plate }}</strong></span>
						</div>
						<div class="card-header">
							<span>Merk</span>
							<span><strong>{{ $car->make }}</strong></span>
						</div>
						<div class="card-header">
							<span>Model</span>
							<span><strong>{{ $car->model }}</strong></span>
						</div>
					</div>
				</div>
			</aside>
		</div>
	</div>

	<template id="car-image-placeholder">
		<svg width="400" height="250" viewBox="0 0 400 250" class="h-full w-full">
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

	
	<div id="viewToast" style="display:none; position:fixed; right:16px; bottom:16px; z-index:2000;">
		<div class="card" style="max-width:360px; display:flex; gap:12px; align-items:flex-start; padding:10px 12px;">
			<div style="width:10px; background:var(--accent); border-radius:2px; margin-top:6px;"></div>
			<div style="flex:1">
				<div style="display:flex; align-items:center; justify-content:space-between; gap:8px;">
					<strong>Populair</strong>
					<small class="muted">Vandaag</small>
				</div>
				<div class="muted" style="margin-top:6px;">10 klanten bekeken deze auto vandaag</div>
			</div>
			<button id="viewToastClose" class="btn btn-outline" style="padding:6px 8px; height:36px; align-self:flex-start;">Sluiten</button>
		</div>
	</div>

	<script>
		document.addEventListener('DOMContentLoaded', function(){
			var toast = document.getElementById('viewToast');
			var close = document.getElementById('viewToastClose');
			if(!toast) return;

			var autoHideTimer;

			function showToast(){
				toast.style.display = 'block';
				autoHideTimer = setTimeout(hideToast, 6000);
			}

			function hideToast(){
				toast.style.display = 'none';
				clearTimeout(autoHideTimer);
			}

			
			setTimeout(showToast, 10000);

			if(close) close.addEventListener('click', hideToast);
		});
	</script>
	</x-base-layout>