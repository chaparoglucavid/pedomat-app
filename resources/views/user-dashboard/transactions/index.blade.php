@extends('user-dashboard.layouts.user-master')
@section('user-content')
    <div class="phone">
        <header class="page__header">
            <h1 class="page__title">Tarixçə</h1>
            <p class="page__sub">Cihazlardan çıxardığın PED və ödənişlər</p>
        </header>

        {{-- (istəyə görə) filtr kartı – statik görünüş --}}
        <section class="card tx-filtercard">
            <div class="tx-filtercard__row">
                <input type="date" class="form-control" value="2025-08-26">
                <span class="tx-filters__sep">—</span>
                <input type="date" class="form-control" value="2025-08-30">
                <button class="btn btn-primary" type="button">Filtr</button>
            </div>
            <div class="tx-filtercard__stats">
                <span class="chip">Toplam PED: <strong>510</strong></span>
                <span class="chip">Toplam ödəniş: <strong>13,90 ₼</strong></span>
            </div>
        </section>

        {{-- Kart-larla səliqəli siyahı (3 statik item) --}}
        <ul class="tx-cards">
            <!-- 1) -->
            <li class="tx-card">
                <div class="tx-card__icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24">
                        <rect x="7" y="2" width="10" height="20" rx="2"></rect>
                        <path d="M11 18h2"></path>
                    </svg>
                </div>

                <div class="tx-card__body">
                    <div class="tx-card__top">
                        <h3 class="tx-card__title">Cihaz № 1023</h3>
                        <br>
                        <div class="tx-card__money">
                            <span class="chip tx-chip--ped">120 PED</span>
                            <span class="tx-amount">3,50 ₼</span>
                        </div>
                    </div>
                    <div class="tx-card__meta">
                        <time datetime="2025-08-29T10:24:00+04:00">29.08.2025 10:24</time>
                        <span class="badge badge--ok">Uğurlu</span>
                    </div>
                </div>
            </li>

            <!-- 2) -->
            <li class="tx-card">
                <div class="tx-card__icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24">
                        <rect x="7" y="2" width="10" height="20" rx="2"></rect>
                        <path d="M11 18h2"></path>
                    </svg>
                </div>

                <div class="tx-card__body">
                    <div class="tx-card__top">
                        <h3 class="tx-card__title">Cihaz № 0784</h3>
                        <br>
                        <div class="tx-card__money">
                            <span class="chip tx-chip--ped">300 PED</span>
                            <span class="tx-amount">8,00 ₼</span>
                        </div>
                    </div>
                    <div class="tx-card__meta">
                        <time datetime="2025-08-28T18:12:00+04:00">28.08.2025 18:12</time>
                        <span class="badge badge--ok">Uğurlu</span>
                    </div>
                </div>
            </li>

            <!-- 3) -->
            <li class="tx-card">
                <div class="tx-card__icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24">
                        <rect x="7" y="2" width="10" height="20" rx="2"></rect>
                        <path d="M11 18h2"></path>
                    </svg>
                </div>

                <div class="tx-card__body">
                    <div class="tx-card__top">
                        <h3 class="tx-card__title">Cihaz № 0560</h3>
                        <br>
                        <div class="tx-card__money">
                            <span class="chip tx-chip--ped">90 PED</span>
                            <span class="tx-amount">2,40 ₼</span>
                        </div>
                    </div>
                    <div class="tx-card__meta">
                        <time datetime="2025-08-26T09:05:00+04:00">26.08.2025 09:05</time>
                        <span class="badge badge--off">İmtina</span>
                    </div>
                </div>
            </li>
        </ul>
    </div>
@endsection
