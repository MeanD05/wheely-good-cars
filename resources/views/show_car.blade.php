<x-base-layout>
	<div class="mx-auto w-full max-w-6xl px-4 py-10 sm:px-6">
		<div class="mb-6 flex flex-wrap items-center justify-between gap-3">
			<a
				href="{{ route('home') }}"
				class="inline-flex items-center gap-2 rounded-full border border-gray-200 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition hover:-translate-y-0.5 hover:shadow"
			>
				<span aria-hidden="true">←</span>
				Terug naar aanbod
			</a>
		</div>

		<div class="grid gap-6 lg:grid-cols-5">
			<section class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm lg:col-span-3">
				<div class="relative">
					<div class="h-72 bg-gradient-to-br from-gray-50 via-white to-gray-100 sm:h-96">
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

					<div class="absolute left-6 top-6 flex flex-wrap items-center gap-2">
						<span class="rounded-full bg-gray-900 px-3 py-1 text-xs font-semibold uppercase tracking-widest text-white">
							{{ $car->license_plate }}
						</span>
						@if ($car->sold_at)
							<span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold uppercase tracking-widest text-green-700">
								Verkocht
							</span>
						@else
							<span class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold uppercase tracking-widest text-yellow-700">
								Te koop
							</span>
						@endif
					</div>
				</div>

				<div class="space-y-6 p-6">
					<div class="flex flex-wrap items-center justify-between gap-4">
						<div>
							<p class="text-xs uppercase tracking-[0.3em] text-gray-400">{{ $car->production_year ?? 'Onbekend' }}</p>
							<h1 class="text-3xl font-semibold text-gray-900">
								{{ $car->make }} {{ $car->model }}
							</h1>
						</div>
						<div class="rounded-2xl border border-gray-200 bg-gray-50 px-5 py-3 text-right">
							<p class="text-[10px] uppercase tracking-widest text-gray-400">Prijs</p>
							<p class="mt-1 text-2xl font-semibold text-gray-900">
								€{{ number_format($car->price, 0, ',', '.') }}
							</p>
						</div>
					</div>

					<div class="grid gap-4 sm:grid-cols-2">
						<div class="rounded-2xl border border-gray-200 bg-white p-4">
							<p class="text-[10px] uppercase tracking-widest text-gray-400">Kilometerstand</p>
							<p class="mt-2 text-lg font-semibold text-gray-900">
								{{ number_format($car->mileage, 0, ',', '.') }} km
							</p>
						</div>
						<div class="rounded-2xl border border-gray-200 bg-white p-4">
							<p class="text-[10px] uppercase tracking-widest text-gray-400">Kleur</p>
							<p class="mt-2 text-lg font-semibold text-gray-900">
								{{ $car->color ?? 'Onbekend' }}
							</p>
						</div>
						<div class="rounded-2xl border border-gray-200 bg-white p-4">
							<p class="text-[10px] uppercase tracking-widest text-gray-400">Zitplaatsen</p>
							<p class="mt-2 text-lg font-semibold text-gray-900">
								{{ $car->seats ?? '–' }}
							</p>
						</div>
						<div class="rounded-2xl border border-gray-200 bg-white p-4">
							<p class="text-[10px] uppercase tracking-widest text-gray-400">Deuren</p>
							<p class="mt-2 text-lg font-semibold text-gray-900">
								{{ $car->doors ?? '–' }}
							</p>
						</div>
					</div>

					<div class="rounded-2xl border border-dashed border-gray-200 bg-gray-50 p-5">
						<p class="text-[10px] uppercase tracking-widest text-gray-400">Tags</p>
						<div class="mt-3 flex flex-wrap gap-2">
							@if ($car->tags && $car->tags->isNotEmpty())
								@foreach ($car->tags as $tag)
									<span class="rounded-full border border-gray-200 bg-white px-3 py-1 text-xs font-semibold text-gray-700">
										{{ $tag->name }}
									</span>
								@endforeach
							@else
								<span class="text-sm text-gray-500">Geen tags toegevoegd</span>
							@endif
						</div>
					</div>
				</div>
			</section>

			<aside class="space-y-6 lg:col-span-2">
				<div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
					<div class="flex items-center justify-between">
						<p class="text-xs uppercase tracking-widest text-gray-400">Status</p>
						@if ($car->sold_at)
							<span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold uppercase tracking-widest text-green-700">
								Verkocht
							</span>
						@else
							<span class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold uppercase tracking-widest text-yellow-700">
								Te koop
							</span>
						@endif
					</div>
					<div class="mt-4 rounded-2xl border border-gray-100 bg-gray-50 p-4">
						<p class="text-[10px] uppercase tracking-widest text-gray-400">Snel overzicht</p>
						<div class="mt-3 space-y-2 text-sm text-gray-700">
							<div class="flex items-center justify-between">
								<span>Bouwjaar</span>
								<span class="font-semibold text-gray-900">{{ $car->production_year ?? '–' }}</span>
							</div>
							<div class="flex items-center justify-between">
								<span>Gewicht</span>
								<span class="font-semibold text-gray-900">
									{{ $car->weight ? number_format($car->weight, 0, ',', '.') . ' kg' : '–' }}
								</span>
							</div>
							<div class="flex items-center justify-between">
								<span>Bekeken</span>
								<span class="font-semibold text-gray-900">
									{{ number_format($car->views, 0, ',', '.') }} keer
								</span>
							</div>
						</div>
					</div>
				</div>

				<div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
					<p class="text-xs uppercase tracking-widest text-gray-400">Registratie</p>
					<div class="mt-4 grid gap-3 text-sm text-gray-700">
						<div class="flex items-center justify-between">
							<span>Kenteken</span>
							<span class="font-semibold text-gray-900">{{ $car->license_plate }}</span>
						</div>
						<div class="flex items-center justify-between">
							<span>Merk</span>
							<span class="font-semibold text-gray-900">{{ $car->make }}</span>
						</div>
						<div class="flex items-center justify-between">
							<span>Model</span>
							<span class="font-semibold text-gray-900">{{ $car->model }}</span>
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
</x-base-layout>