<x-base-layout>
    <div class="container page">
        <div style="max-width: 900px; margin: 0 auto 2rem auto;">
            <h1>Welkom terug, {{ auth()->user()->name }}!</h1>
            <p class="muted">Wat wil je vandaag doen?</p>
        </div>

        <div style="max-width: 900px; margin: 0 auto;">
            <h2>Tag gebruik</h2>

            @if($tags->isEmpty())
                <p class="muted">Er zijn nog geen tags beschikbaar.</p>
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
</x-base-layout>