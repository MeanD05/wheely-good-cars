<x-base-layout>
    <div class="container page">
        <div class="card" style="margin: 0 auto 1.5rem auto; background: linear-gradient(120deg, var(--navy) 0%, var(--navy-dark) 100%); border: none; color: #fff;">
            <div style="display: flex; align-items: center; justify-content: space-between; gap: 1rem; flex-wrap: wrap;">
                <div>
                    <h1 style="color: #fff; margin-bottom: 0.25rem;">Admin Dashboard</h1>
                    <p style="color: rgba(255,255,255,0.7);">Data ververst automatisch elke 10 seconden.</p>
                </div>
                <div style="display: flex; gap: 0.75rem; align-items: center; flex-wrap: wrap;">
                    <span class="pill" style="background: rgba(255,255,255,0.12); color: #fff; border-color: rgba(255,255,255,0.2);">Laatste update: <span id="lastUpdated">-</span></span>
                    <button class="btn btn-outline" id="fullscreenButton" type="button" style="border-color: rgba(255,255,255,0.35); color: #fff; background: rgba(255,255,255,0.08);">Fullscreen</button>
                </div>
            </div>
        </div>

        <div class="stack">
            <div class="grid grid-3">
                <div class="card">
                    <div class="label">Aantal auto's aangeboden</div>
                    <div style="font-size: 1.8rem; font-weight: 700;" id="metricTotal">-</div>
                    <div class="muted" style="font-size: 0.85rem;">Totaal in de database</div>
                </div>
                <div class="card">
                    <div class="label">Aantal verkocht</div>
                    <div style="font-size: 1.8rem; font-weight: 700;" id="metricSold">-</div>
                    <div class="muted" style="font-size: 0.85rem;">Verkochte auto's</div>
                </div>
                <div class="card">
                    <div class="label">Aantal vandaag aangeboden</div>
                    <div style="font-size: 1.8rem; font-weight: 700;" id="metricToday">-</div>
                    <div class="muted" style="font-size: 0.85rem;">Nieuwe auto's vandaag</div>
                </div>
                <div class="card">
                    <div class="label">Aantal aanbieders</div>
                    <div style="font-size: 1.8rem; font-weight: 700;" id="metricProviders">-</div>
                    <div class="muted" style="font-size: 0.85rem;">Unieke aanbieders</div>
                </div>
                <div class="card">
                    <div class="label">Aantal views vandaag</div>
                    <div style="font-size: 1.8rem; font-weight: 700;" id="metricViews">-</div>
                    <div class="muted" style="font-size: 0.85rem;">Vanaf nu bijgehouden</div>
                </div>
                <div class="card">
                    <div class="label">Gemiddeld aantal auto's per aanbieder</div>
                    <div style="font-size: 1.8rem; font-weight: 700;" id="metricAverage">-</div>
                    <div class="muted" style="font-size: 0.85rem;">Gemiddelde per aanbieder</div>
                </div>
            </div>

            <div class="card">
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 0.6rem;">
                    <div style="font-weight: 700; color: var(--navy);">Verkocht vs aanbod</div>
                    <div id="soldRatioLabel" class="muted">0%</div>
                </div>
                <div style="height: 10px; border-radius: 999px; background: #e5e7eb; overflow: hidden;">
                    <div id="soldProgress" style="height: 100%; width: 0; background: linear-gradient(90deg, var(--navy) 0%, var(--accent) 100%); transition: width 0.6s ease;"></div>
                </div>
            </div>

            <div class="grid grid-2">
                <div class="card">
                    <div style="font-weight: 700; color: var(--navy); margin-bottom: 0.6rem;">Aanbod en verkoop laatste 7 dagen</div>
                    <canvas id="weeklyChart" height="160"></canvas>
                </div>
                <div class="card">
                    <div style="font-weight: 700; color: var(--navy); margin-bottom: 0.6rem;">Verdeling verkocht / niet verkocht</div>
                    <canvas id="soldChart" height="160"></canvas>
                </div>
            </div>

            <div class="card">
                <h2 style="margin-bottom: 0.8rem;">Tag gebruik</h2>
                @if($tags->isEmpty())
                    <div class="muted">Er zijn nog geen tags beschikbaar.</div>
                @else
                    <div style="max-height: 320px; overflow-y: auto;">
                        <table style="width: 100%; border-collapse: collapse; font-size: 0.9rem;">
                            <thead>
                                <tr>
                                    <th style="text-align: left; padding: 0.45rem 0.6rem; border-bottom: 1px solid var(--border);">Tag</th>
                                    <th style="text-align: right; padding: 0.45rem 0.6rem; border-bottom: 1px solid var(--border);">Totaal</th>
                                    <th style="text-align: right; padding: 0.45rem 0.6rem; border-bottom: 1px solid var(--border);">Verkocht</th>
                                    <th style="text-align: right; padding: 0.45rem 0.6rem; border-bottom: 1px solid var(--border);">Niet verkocht</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tags as $tag)
                                    <tr>
                                        <td style="padding: 0.45rem 0.6rem; border-bottom: 1px solid #f0f0f0;">{{ $tag->name }}</td>
                                        <td style="text-align:right; padding: 0.45rem 0.6rem; border-bottom: 1px solid #f0f0f0;">{{ $tag->cars_count }}</td>
                                        <td style="text-align:right; padding: 0.45rem 0.6rem; border-bottom: 1px solid #f0f0f0;">{{ $tag->sold_cars_count }}</td>
                                        <td style="text-align:right; padding: 0.45rem 0.6rem; border-bottom: 1px solid #f0f0f0;">{{ $tag->unsold_cars_count }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            <div class="card">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 0.8rem; flex-wrap: wrap; gap: 0.5rem;">
                        <h2 style="margin-bottom: 0;">Opvallende aanbieders</h2>
                        <span class="pill">Totaal: {{ $suspiciousUsers->total() }}</span>
                    </div>
                    @if($suspiciousUsers->total() === 0)
                        <div class="muted">Er zijn momenteel geen opvallende aanbieders.</div>
                    @else
                        <div class="grid" style="grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));">
                            @foreach($suspiciousUsers as $user)
                                <div style="border: 1px solid var(--border); border-radius: 10px; padding: 0.9rem; background: #f9fafb;">
                                    <div style="display:flex; gap: 0.75rem; align-items:center;">
                                        <div style="width: 44px; height: 44px; border-radius: 50%; background: var(--navy); display:flex; align-items:center; justify-content:center; color: #fff; font-weight: 700;">
                                            {{ strtoupper(substr($user->name,0,1)) }}
                                        </div>
                                        <div>
                                            <div style="font-weight: 700;">{{ $user->name }}</div>
                                            <div class="muted" style="font-size: 0.85rem;">{{ $user->email }}</div>
                                        </div>
                                    </div>
                                    <div style="margin-top: 0.6rem; display:flex; justify-content:space-between; font-size: 0.9rem;">
                                        <div>
                                            <div class="muted" style="font-size: 0.8rem;">Telefoon</div>
                                            <div>{{ $user->phone_number ?: 'Geen telefoonnummer' }}</div>
                                        </div>
                                        <div style="text-align:right;">
                                            <div class="muted" style="font-size: 0.8rem;">Aantal auto's</div>
                                            <div>{{ $user->cars->count() }}</div>
                                        </div>
                                    </div>
                                    @if($user->cars->isNotEmpty())
                                        <div class="muted" style="margin-top: 0.6rem; font-size: 0.85rem;">Laatste aanbod: <span style="color: var(--text); font-weight: 600;">{{ $user->cars->first()->created_at->format('d M Y') }}</span></div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        <div style="margin-top: 1rem;">
                            {{ $suspiciousUsers->links('pagination.custom') }}
                        </div>
                    @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>
    <script>
        const metricsUrl = "{{ route('admin.metrics') }}";
        const refreshMs = 10000;
        let weeklyChart = null;
        let soldChart = null;

        const formatNumber = (value) => {
            return new Intl.NumberFormat("nl-NL").format(value);
        };

        const updateDashboard = (payload) => {
            const totals = payload.totals;
            document.getElementById("metricTotal").textContent = formatNumber(totals.cars_total);
            document.getElementById("metricSold").textContent = formatNumber(totals.cars_sold);
            document.getElementById("metricToday").textContent = formatNumber(totals.cars_today);
            document.getElementById("metricProviders").textContent = formatNumber(totals.providers);
            document.getElementById("metricViews").textContent = formatNumber(totals.views_today);
            const averageValue = Number(totals.avg_cars_per_provider || 0);
            document.getElementById("metricAverage").textContent = averageValue.toLocaleString("nl-NL", {
                minimumFractionDigits: 0,
                maximumFractionDigits: 2,
            });

            const soldRatioLabel = document.getElementById("soldRatioLabel");
            const soldProgress = document.getElementById("soldProgress");
            soldRatioLabel.textContent = `${totals.sold_ratio}%`;
            soldProgress.style.width = `${totals.sold_ratio}%`;

            const updatedAt = new Date(payload.updated_at);
            document.getElementById("lastUpdated").textContent = updatedAt.toLocaleString("nl-NL", {
                timeZone: "Europe/Amsterdam",
            });

            const weeklyData = {
                labels: payload.charts.labels,
                datasets: [
                    {
                        label: "Aangeboden",
                        data: payload.charts.offered,
                        backgroundColor: "rgba(16, 36, 63, 0.4)",
                        borderColor: "rgba(16, 36, 63, 1)",
                        borderWidth: 2,
                        borderRadius: 6,
                    },
                    {
                        label: "Verkocht",
                        data: payload.charts.sold,
                        backgroundColor: "rgba(183, 28, 28, 0.35)",
                        borderColor: "rgba(183, 28, 28, 1)",
                        borderWidth: 2,
                        borderRadius: 6,
                    },
                ],
            };

            if (weeklyChart) {
                weeklyChart.data = weeklyData;
                weeklyChart.update();
            } else {
                weeklyChart = new Chart(document.getElementById("weeklyChart"), {
                    type: "bar",
                    data: weeklyData,
                    options: {
                        responsive: true,
                        plugins: {
                            legend: { position: "top" },
                        },
                        scales: {
                            y: { beginAtZero: true },
                        },
                    },
                });
            }

            const soldData = {
                labels: ["Verkocht", "Niet verkocht"],
                datasets: [
                    {
                        data: payload.charts.sold_vs_unsold,
                        backgroundColor: ["rgba(16, 36, 63, 0.85)", "rgba(183, 28, 28, 0.65)"],
                        borderColor: ["rgba(16, 36, 63, 1)", "rgba(183, 28, 28, 1)"],
                        borderWidth: 1,
                    },
                ],
            };

            if (soldChart) {
                soldChart.data = soldData;
                soldChart.update();
            } else {
                soldChart = new Chart(document.getElementById("soldChart"), {
                    type: "doughnut",
                    data: soldData,
                    options: {
                        responsive: true,
                        plugins: { legend: { position: "bottom" } },
                    },
                });
            }
        };

        const fetchMetrics = async () => {
            try {
                const response = await fetch(metricsUrl, { headers: { "Accept": "application/json" } });
                if (!response.ok) {
                    throw new Error("Metrics fetch failed");
                }
                const payload = await response.json();
                updateDashboard(payload);
            } catch (error) {
                console.error(error);
            }
        };

        document.getElementById("fullscreenButton").addEventListener("click", () => {
            const root = document.documentElement;
            if (!document.fullscreenElement) {
                root.requestFullscreen();
            } else {
                document.exitFullscreen();
            }
        });

        fetchMetrics();
        setInterval(fetchMetrics, refreshMs);
    </script>
</x-base-layout>
