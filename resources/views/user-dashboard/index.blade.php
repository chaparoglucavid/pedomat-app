@extends('user-dashboard.layouts.user-master')
@section('user-content')
    <div class="page__header d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page__title">Profil</h1>
            <p class="page__sub">{{ auth()->user()->phone ?? '+994 50 822 13 00' }}</p>
        </div>
        <a href="{{ route('user-top-up-wallet-balance') }}">
            <button class="btn btn--ok">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" height="18" width="18"><path
                        fill="#ffffff"
                        d="M352 128C352 110.3 337.7 96 320 96C302.3 96 288 110.3 288 128L288 288L128 288C110.3 288 96 302.3 96 320C96 337.7 110.3 352 128 352L288 352L288 512C288 529.7 302.3 544 320 544C337.7 544 352 529.7 352 512L352 352L512 352C529.7 352 544 337.7 544 320C544 302.3 529.7 288 512 288L352 288L352 128z"/></svg>
            </span>
                Balansı artırın
            </button>
        </a>
    </div>

    {{-- İki sürətli fəaliyyət kartı --}}
    <div class="quick-tiles">
        <a href="#" class="card quick-tiles__item">
            <div class="quick-tiles__icon" aria-hidden="true">
                {{-- user icon --}}
                <svg viewBox="0 0 24 24" class="icon-20" style="width:24px;height:24px">
                    <circle cx="12" cy="8" r="4" stroke="currentColor"></circle>
                    <path d="M4 20c0-3.3 3.6-6 8-6s8 2.7 8 6" stroke="currentColor"></path>
                </svg>
            </div>
            <div class="quick-tiles__text">Məlumatlarım</div>
        </a>

        <a href="#" class="card quick-tiles__item">
            <div class="quick-tiles__icon coin-azn" aria-hidden="true">
                <svg viewBox="0 0 64 64" class="coin-azn__svg" aria-hidden="true">
                    <defs>
                        <radialGradient id="aznGlow" cx="50%" cy="35%" r="70%">
                            <stop offset="0%" stop-color="#a78bfa"/>
                            <stop offset="55%" stop-color="#7c3aed"/>
                            <stop offset="100%" stop-color="#4f46e5"/>
                        </radialGradient>
                        <linearGradient id="aznShine" x1="0" y1="0" x2="1" y2="1">
                            <stop offset="0%" stop-color="rgba(255,255,255,.9)"/>
                            <stop offset="100%" stop-color="rgba(255,255,255,0)"/>
                        </linearGradient>
                    </defs>
                    <circle cx="32" cy="32" r="28" fill="url(#aznGlow)"/>
                    <ellipse cx="24" cy="18" rx="16" ry="10" fill="url(#aznShine)" opacity=".35"/>
                    <text x="32" y="39" text-anchor="middle"
                          font-size="26" font-weight="800" fill="#fff">₼
                    </text>
                </svg>
            </div>

            <div class="quick-tiles__text">Mənim balansım</div>

            <div class="quick-tiles__amount">
                <span class="azn">₼</span>{{ number_format(($userCurrentBalance ?? 0), 2, '.', ' ') }}
            </div>
        </a>
    </div>

    {{-- Menyu siyahısı (kart daxilində elementlər) --}}
    <div class="card menu-list">
        <a href="#" class="menu-list__item">
            <div class="menu-list__left">
        <span class="menu-list__icon">
            <!-- 🎟️ Biletlər -->
            <svg viewBox="0 0 24 24" class="icon-20">
                <path d="M4 6h16v4a2 2 0 0 0 0 4v4H4v-4a2 2 0 0 0 0-4V6z" stroke="currentColor" fill="none"/>
            </svg>
        </span>
                <span class="menu-list__text">Biletlərim
            <span class="ms-4 chip chip--new">Aktiv: 1</span>
        </span>
            </div>
            <span class="menu-list__chev">
        <svg viewBox="0 0 24 24" class="icon-20"><path d="M9 6l6 6-6 6" stroke="currentColor"/></svg>
    </span>
        </a>

        <a href="#" class="menu-list__item">
            <div class="menu-list__left">
        <span class="menu-list__icon">
            <!-- 🕑 İstifadə tarixçəsi -->
            <svg viewBox="0 0 24 24" class="icon-20">
                <circle cx="12" cy="12" r="9" stroke="currentColor" fill="none"/>
                <path d="M12 7v5l3 3" stroke="currentColor"/>
            </svg>
        </span>
                <span class="menu-list__text">İstifadə tarixçəsi</span>
            </div>
            <span class="menu-list__chev">
        <svg viewBox="0 0 24 24" class="icon-20"><path d="M9 6l6 6-6 6" stroke="currentColor"/></svg>
    </span>
        </a>

        <a href="{{ route('user-balance-history') }}" class="menu-list__item">
            <div class="menu-list__left">
        <span class="menu-list__icon">
            <!-- 💳 Balans tarixçəsi -->
            <svg viewBox="0 0 24 24" class="icon-20">
                <rect x="3" y="6" width="18" height="12" rx="2" stroke="currentColor" fill="none"/>
                <path d="M3 10h18" stroke="currentColor"/>
            </svg>
        </span>
                <span class="menu-list__text">Balans tarixçəsi</span>
            </div>
            <span class="menu-list__right">
                <span class="menu-list__chev">
                    <svg viewBox="0 0 24 24" class="icon-20"><path d="M9 6l6 6-6 6" stroke="currentColor"/></svg>
                </span>
            </span>
        </a>

        <a href="#" class="menu-list__item">
            <div class="menu-list__left">
        <span class="menu-list__icon">
            <!-- 📄 Sənədlər -->
            <svg viewBox="0 0 24 24" class="icon-20">
                <path d="M6 2h9l5 5v15H6z" stroke="currentColor" fill="none"/>
                <path d="M14 2v6h6" stroke="currentColor"/>
            </svg>
        </span>
                <span class="menu-list__text">Sənədlər</span>
            </div>
            <span class="menu-list__right">
                <span class="menu-list__chev">
                    <svg viewBox="0 0 24 24" class="icon-20"><path d="M9 6l6 6-6 6" stroke="currentColor"/></svg>
                </span>
            </span>
        </a>

        <a href="#" class="menu-list__item">
            <div class="menu-list__left">
        <span class="menu-list__icon">
            <!-- 📞 Əlaqə -->
            <svg viewBox="0 0 24 24" class="icon-20">
                <path
                    d="M22 16.92v3a2 2 0 0 1-2.18 2 19.9 19.9 0 0 1-8.63-3.07 19.77 19.77 0 0 1-6-6A19.9 19.9 0 0 1 2.12 4.18 2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.12.81.37 1.6.72 2.34a2 2 0 0 1-.45 2.18L8.09 9.91a16 16 0 0 0 6 6l1.67-1.32a2 2 0 0 1 2.18-.45c.74.35 1.53.6 2.34.72a2 2 0 0 1 1.72 2.06z"
                    stroke="currentColor" fill="none"/>
            </svg>
        </span>
                <span class="menu-list__text">Əlaqə</span>
            </div>
            <span class="menu-list__chev">
        <svg viewBox="0 0 24 24" class="icon-20"><path d="M9 6l6 6-6 6" stroke="currentColor"/></svg>
    </span>
        </a>

    </div>

    {{-- Çıxış kartı --}}
    <a href="{{ route('logout') }}" class="card logout-card"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <div class="logout-card__text">Çıxış edin
            <svg viewBox="0 0 24 24" class="icon-20">
                <path d="M9 6l6 6-6 6" stroke="currentColor"/>
            </svg>
        </div>
    </a>
    <form id="logout-form" method="POST" action="{{ route('logout') }}" class="d-none">
        @csrf
    </form>
@endsection
