@extends('user-dashboard.layouts.user-master')
@section('user-content')
    <div class="page__header d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page__title">Profil</h1>
            <p class="page__sub">{{ auth()->user()->phone ?? '+994 50 822 13 00' }}</p>
        </div>
    </div>

    <div class="quick-tiles">
        <a href="{{ route('user-top-up-wallet-balance') }}" class="card quick-tiles__item quick-tiles__item--hover">
            <div class="quick-tiles__icon quick-tiles__icon--wallet" aria-hidden="true">
                {{-- Wallet icon (mavi ton) --}}
                <svg viewBox="0 0 24 24" class="icon-24">
                    <rect x="3.5" y="7.5" width="17" height="9" rx="2" ry="2" stroke="currentColor" fill="none"/>
                    <path d="M3.5 9.5h12.5a2 2 0 0 1 2 2" stroke="currentColor" fill="none"/>
                    <path d="M20.5 11h-4a2 2 0 0 0 0 4h4v-4z" stroke="currentColor" fill="none"/>
                    <circle cx="16.5" cy="13" r="0.9" fill="currentColor"/>
                </svg>
            </div>
            <div class="quick-tiles__stack">
                <div class="quick-tiles__text">Balansı artırın</div>
                <div class="quick-tiles__amount">
                   {{ number_format(($userCurrentBalance ?? 0), 2, '.', ' ') }} <span class="azn">₼</span>
                </div>
            </div>
        </a>
    </div>


    {{-- Menyu siyahısı (kart daxilində elementlər) --}}
    <div class="card menu-list">
        <a href="#" class="menu-list__item">
            <div class="menu-list__left">
            <span class="menu-list__icon">
                <svg viewBox="0 0 24 24" class="icon-20">
                    <circle cx="12" cy="7.5" r="3.75" stroke="currentColor" fill="none"/>
                    <path d="M4 20c0-3.4 3.9-6.2 8-6.2s8 2.8 8 6.2" stroke="currentColor" fill="none"/>
                </svg>
            </span>
                <span class="menu-list__text">Məlumatlarım</span>
            </div>
            <span class="menu-list__chev">
            <svg viewBox="0 0 24 24" class="icon-20"><path d="M9 6l6 6-6 6" stroke="currentColor"/></svg>
        </span>
        </a>

        <a href="{{ route('user-orders') }}" class="menu-list__item">
            <div class="menu-list__left">
                <span class="menu-list__icon">
                    <!-- 🎟️ Biletlər -->
                    <svg viewBox="0 0 24 24" class="icon-20">
                        <path d="M4 6h16v4a2 2 0 0 0 0 4v4H4v-4a2 2 0 0 0 0-4V6z" stroke="currentColor" fill="none"/>
                    </svg>
                </span>
                <span class="menu-list__text">Sifarişlərim
                    <span class="ms-4 chip chip--new">Aktiv: {{ $userActiveOrders }}</span>
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
