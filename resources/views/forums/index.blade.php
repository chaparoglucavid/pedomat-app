@extends('layouts.app')


@section('content')
    <div class="phone pb-bottom-nav">
        <div class="page__header">
            <h1 class="page__title">Forum</h1>
            <p class="page__sub">Sualınızı insanlarla bölüşün.</p>
        </div>

        <ul class="tx-cards" style="max-width: 760px; margin: 0 auto 12px;">
            {{-- 1 --}}
            <a href="{{ route('forum-show') }}" style="text-decoration: none">
                <li class="tx-card">
                    <div class="tx-card__icon icn--payment" aria-hidden="true">
                        <svg viewBox="0 0 24 24">
                            <path d="M21 15a4 4 0 0 1-4 4H8l-5 3V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4z"/>
                        </svg>
                    </div>
                    <div class="tx-card__body">
                        <div class="tx-card__top">
                            <h3 class="tx-card__title">Endometrioz təcrübələri: ağrı idarəsi üçün nə işə yaradı?</h3>
                            <span class="badge badge--ok">Q&A</span>
                        </div>
                        <div class="device-card__meta" style="margin-top:4px;">
                            <span class="chip">İstifadəçi: <strong>ayla</strong></span>
                            <span class="chip">30 dəq əvvəl</span>
                        </div>
                        <div class="tx-card__meta">
                            <div style="display:flex; gap:12px; align-items:center;">
                    <span class="device-card__address" title="Cavablar">
                        <svg class="icon-20" viewBox="0 0 24 24"><path
                                d="M21 15a4 4 0 0 1-4 4H8l-5 3V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4z"/></svg>
                        8 cavab
                    </span>
                                <span class="device-card__address" title="Bəyənmə">
                        <svg class="icon-20" viewBox="0 0 24 24"><path
                                d="M14 9V5a3 3 0 0 0-6 0v4H5a2 2 0 0 0-2 2l1 8a2 2 0 0 0 2 2h8l4-8V9z"/></svg>
                        19 like
                    </span>
                            </div>
                            <a href="#" class="auth-link">Daxil ol</a>
                        </div>
                    </div>
                </li>
            </a>

            {{-- 2 --}}
            <a href="{{ route('forum-show') }}" style="text-decoration: none">
                <li class="tx-card">
                    <div class="tx-card__icon icn--topup" aria-hidden="true">
                        <svg viewBox="0 0 24 24">
                            <path d="M5 9h14M3 15h14M9 3L7 21M17 3l-2 18"/>
                        </svg>
                    </div>
                    <div class="tx-card__body">
                        <div class="tx-card__top">
                            <h3 class="tx-card__title">PCOS üçün pəhriz və məşq planları — real nəticələr</h3>
                            <span class="chip chip--new">Yeni</span>
                        </div>
                        <div class="device-card__meta" style="margin-top:4px;">
                            <span class="chip">İstifadəçi: <strong>nigar</strong></span>
                            <span class="chip">1 saat əvvəl</span>
                        </div>
                        <div class="tx-card__meta">
                            <div style="display:flex; gap:12px; align-items:center;">
                    <span class="device-card__address" title="Cavablar">
                        <svg class="icon-20" viewBox="0 0 24 24"><path
                                d="M21 15a4 4 0 0 1-4 4H8l-5 3V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4z"/></svg>
                        5 cavab
                    </span>
                                <span class="device-card__address" title="Bəyənmə">
                        <svg class="icon-20" viewBox="0 0 24 24"><path
                                d="M14 9V5a3 3 0 0 0-6 0v4H5a2 2 0 0 0-2 2l1 8a2 2 0 0 0 2 2h8l4-8V9z"/></svg>
                        12 like
                    </span>
                            </div>
                            <a href="#" class="auth-link">Daxil ol</a>
                        </div>
                    </div>
                </li>
            </a>

            {{-- 3 --}}
            <a href="{{ route('forum-show') }}" style="text-decoration: none">
                <li class="tx-card">
                    <div class="tx-card__icon icn--refund" aria-hidden="true">
                        <svg viewBox="0 0 24 24">
                            <path d="M12 5v14m-7-7h14"/>
                        </svg>
                    </div>
                    <div class="tx-card__body">
                        <div class="tx-card__top">
                            <h3 class="tx-card__title">Uşaqlıq mioması: əməliyyatsız müalicə barədə suallar</h3>
                            <span class="badge badge--off">Müzakirə</span>
                        </div>
                        <div class="device-card__meta" style="margin-top:4px;">
                            <span class="chip">İstifadəçi: <strong>leyla</strong></span>
                            <span class="chip">Dünən</span>
                        </div>
                        <div class="tx-card__meta">
                            <div style="display:flex; gap:12px; align-items:center;">
                                <span class="device-card__address"><svg class="icon-20" viewBox="0 0 24 24"><path
                                            d="M21 15a4 4 0 0 1-4 4H8l-5 3V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4z"/></svg> 14 cavab</span>
                                <span class="device-card__address"><svg class="icon-20" viewBox="0 0 24 24"><path
                                            d="M14 9V5a3 3 0 0 0-6 0v4H5a2 2 0 0 0-2 2l1 8a2 2 0 0 0 2 2h8l4-8V9z"/></svg> 33 like</span>
                            </div>
                            <a href="#" class="auth-link">Daxil ol</a>
                        </div>
                    </div>
                </li>
            </a>

            {{-- 4 --}}
            <a href="{{ route('forum-show') }}" style="text-decoration: none">
                <li class="tx-card">
                    <div class="tx-card__icon icn--payment" aria-hidden="true">
                        <svg viewBox="0 0 24 24">
                            <path d="M21 15a4 4 0 0 1-4 4H8l-5 3V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4z"/>
                        </svg>
                    </div>
                    <div class="tx-card__body">
                        <div class="tx-card__top">
                            <h3 class="tx-card__title">Vaginal kandidiaz üçün tez-tez edilən səhvlər</h3>
                            <span class="badge badge--ok">Q&A</span>
                        </div>
                        <div class="device-card__meta" style="margin-top:4px;">
                            <span class="chip">İstifadəçi: <strong>selin</strong></span>
                            <span class="chip">2 gün əvvəl</span>
                        </div>
                        <div class="tx-card__meta">
                            <div style="display:flex; gap:12px; align-items:center;">
                                <span class="device-card__address"><svg class="icon-20" viewBox="0 0 24 24"><path
                                            d="M21 15a4 4 0 0 1-4 4H8l-5 3V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4z"/></svg> 3 cavab</span>
                                <span class="device-card__address"><svg class="icon-20" viewBox="0 0 24 24"><path
                                            d="M14 9V5a3 3 0 0 0-6 0v4H5a2 2 0 0 0-2 2l1 8a2 2 0 0 0 2 2h8l4-8V9z"/></svg> 9 like</span>
                            </div>
                            <a href="#" class="auth-link">Daxil ol</a>
                        </div>
                    </div>
                </li>
            </a>
        </ul>

        <div class="auth-card" style="max-width: 760px; margin: 0 auto;">
            <form method="POST" action="#">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Başlıq <span class="sr-only">(məcburidir)</span></label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" class="form-control"
                           placeholder="Məs: Doğuşdan sonra hansı pedlərdən istifadə etməliyəm?" required>
                </div>
                <div class="mb-3">
                    <label for="body" class="form-label">Mətn</label>
                    <textarea id="body" name="body" rows="8" class="form-control"
                              placeholder="Mövzunu ətraflı izah edin" required>{{ old('body') }}</textarea>
                </div>

                <div class="action-bar">
                    <button type="submit" class="btn btn--brand">Yarat</button>
                    <a href="{{ url()->previous() }}" class="btn btn--outline">Geri</a>
                </div>
            </form>
        </div>
    </div>
@endsection
