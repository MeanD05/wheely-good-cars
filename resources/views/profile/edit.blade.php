<x-base-layout>
    <div class="container page">

        {{-- Profiel header --}}
        <div class="card" style="max-width: 760px; margin: 0 auto 1.5rem auto; background: linear-gradient(120deg, var(--navy) 0%, var(--navy-dark) 100%); border: none; color: #fff;">
            <div style="display: flex; align-items: center; gap: 1.25rem;">
                <div style="width: 64px; height: 64px; border-radius: 50%; background: var(--accent); display: flex; align-items: center; justify-content: center; font-size: 1.75rem; font-weight: 700; color: #fff; flex-shrink: 0; text-transform: uppercase; letter-spacing: 0.02rem; user-select: none;">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div>
                    <h1 style="color: #fff; font-size: 1.35rem; font-weight: 700; margin-bottom: 0.2rem;">
                        {{ auth()->user()->name }}
                    </h1>
                    <p style="color: rgba(255,255,255,0.6); font-size: 0.9rem;">
                        {{ auth()->user()->email }}
                    </p>
                </div>
                <div style="margin-left: auto;">
                    <a href="{{ route('home') }}" class="btn btn-outline" style="border-color: rgba(255,255,255,0.25); color: #fff; background: rgba(255,255,255,0.08); font-size: 0.78rem;">
                        ← Terug
                    </a>
                </div>
            </div>
        </div>

        {{-- Secties --}}
        <div class="stack" style="max-width: 760px; margin: 0 auto;">

            {{-- Profielgegevens --}}
            <div class="card">
                <div class="card-header" style="margin-bottom: 1.25rem; padding-bottom: 1rem; border-bottom: 1px solid var(--border);">
                    <div style="display: flex; align-items: center; gap: 0.6rem;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="color: var(--navy);">
                            <circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.582-7 8-7s8 3 8 7"/>
                        </svg>
                        <span style="font-weight: 700; font-size: 1rem; color: var(--navy);">Profielgegevens</span>
                    </div>
                </div>
                @include('profile.partials.update-profile-information-form')
            </div>

            {{-- Wachtwoord --}}
            <div class="card">
                <div class="card-header" style="margin-bottom: 1.25rem; padding-bottom: 1rem; border-bottom: 1px solid var(--border);">
                    <div style="display: flex; align-items: center; gap: 0.6rem;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="color: var(--navy);">
                            <rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                        </svg>
                        <span style="font-weight: 700; font-size: 1rem; color: var(--navy);">Wachtwoord wijzigen</span>
                    </div>
                </div>
                @include('profile.partials.update-password-form')
            </div>

            {{-- Account verwijderen --}}
            <div class="card" style="border-color: #fca5a5;">
                <div class="card-header" style="margin-bottom: 1.25rem; padding-bottom: 1rem; border-bottom: 1px solid #fca5a5;">
                    <div style="display: flex; align-items: center; gap: 0.6rem;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="color: #dc2626;">
                            <polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/>
                        </svg>
                        <span style="font-weight: 700; font-size: 1rem; color: #dc2626;">Account verwijderen</span>
                    </div>
                </div>
                @include('profile.partials.delete-user-form')
            </div>

        </div>
    </div>
</x-base-layout>
