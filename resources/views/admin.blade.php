<x-base-layout>
    <div class="container page">
        <div style="max-width: 900px; margin: 0 auto 2rem auto;">
            <h1>Welkom terug, {{ auth()->user()->name }}!</h1>
            <p class="muted">Wat wil je vandaag doen?</p>
        </div>  
</x-base-layout>