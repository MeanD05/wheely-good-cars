<x-base-layout>
    <div class="container page">
        <div style="max-width: 1100px; margin: 0 auto 1.5rem auto;">
            <h1>Dashboard</h1>
            <p class="muted">Overzicht: tag-gebruik en opvallende aanbieders.</p>
        </div>

        <div style="max-width: 1100px; margin: 0 auto; display:flex; gap:1rem; align-items:flex-start; flex-wrap:wrap;">
            <div style="flex: 0 0 360px; min-width:280px;">
                <h2 style="margin:0 0 .5rem 0;">Tag gebruik</h2>
                @if($tags->isEmpty())
                    <div style="padding:1rem; color:#6b7280;">Er zijn nog geen tags beschikbaar.</div>
                @else
                    <div style="max-width: 560px; border: 1px solid #ececec; border-radius: 10px; overflow: hidden; background: #fff;">
                        <div style="max-height: 220px; overflow-y: auto;">
                            <table style="width: 100%; border-collapse: collapse; font-size: .9rem;">
                                <thead>
                                    <tr>
                                        <th style="text-align: left; padding: .4rem .6rem; border-bottom: 1px solid #ddd; white-space: nowrap;">Tag</th>
                                        <th style="text-align: right; padding: .4rem .6rem; border-bottom: 1px solid #ddd; white-space: nowrap;">Totaal</th>
                                        <th style="text-align: right; padding: .4rem .6rem; border-bottom: 1px solid #ddd; white-space: nowrap;">Verkocht</th>
                                        <th style="text-align: right; padding: .4rem .6rem; border-bottom: 1px solid #ddd; white-space: nowrap;">Niet verkocht</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tags as $tag)
                                        <tr>
                                            <td style="padding: .4rem .6rem; border-bottom: 1px solid #f0f0f0;">{{ $tag->name }}</td>
                                            <td style="text-align: right; padding: .4rem .6rem; border-bottom: 1px solid #f0f0f0;">{{ $tag->cars_count }}</td>
                                            <td style="text-align: right; padding: .4rem .6rem; border-bottom: 1px solid #f0f0f0;">{{ $tag->sold_cars_count }}</td>
                                            <td style="text-align: right; padding: .4rem .6rem; border-bottom: 1px solid #f0f0f0;">{{ $tag->unsold_cars_count }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>

            <div style="flex: 1 1 600px; min-width:300px;">
                <h2 style="margin:0 0 .5rem 0;">Opvallende aanbieders</h2>
                @if(empty($suspiciousUsers) || $suspiciousUsers->isEmpty())
                    <div style="padding: 1rem; background: #fff; border: 1px solid #eee; border-radius: 8px;">Er zijn momenteel geen opvallende aanbieders.</div>
                @else
                    <div style="display:grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap:1rem;">
                        @foreach($suspiciousUsers as $user)
                            <div style="background:#fff; border:1px solid #ececec; border-radius:10px; padding:1rem;">
                                <div style="display:flex; gap:.75rem; align-items:center;">
                                    <div style="width:44px; height:44px; border-radius:999px; background:#f3f4f6; display:flex; align-items:center; justify-content:center; font-weight:700; color:#374151;">{{ strtoupper(substr($user->name,0,1)) }}</div>
                                    <div>
                                        <div style="font-weight:700;">{{ $user->name }}</div>
                                        <div style="font-size:.85rem; color:#6b7280;">{{ $user->email }}</div>
                                    </div>
                                </div>

                                <div style="margin-top:.6rem; display:flex; justify-content:space-between; color:#374151; font-size:.9rem;">
                                    <div>
                                        <div style="color:#6b7280; font-size:.8rem;">Telefoon</div>
                                        <div>{{ $user->phone_number ?: 'Geen telefoonnummer' }}</div>
                                    </div>
                                    <div style="text-align:right;">
                                        <div style="color:#6b7280; font-size:.8rem;">Aantal auto's</div>
                                        <div>{{ $user->cars->count() }}</div>
                                    </div>
                                </div>

                                @if($user->cars->isNotEmpty())
                                    <div style="margin-top:.6rem; font-size:.85rem; color:#6b7280;">Laatste aanbod: <span style="color:#111827; font-weight:600;">{{ $user->cars->first()->created_at->format('d M Y') }}</span></div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-base-layout>
