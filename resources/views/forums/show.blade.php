@extends('layouts.app')

@section('content')
    <div class="phone pb-bottom-nav">
        {{-- Breadcrumbs / back --}}
        <a href="{{ route('forum') }}" class="menu-cta" aria-label="Geri dön">
            <div class="menu-cta__left">
                <div class="menu-cta__icon">
                    <svg viewBox="0 0 24 24" class="icon-20"><path d="M15 18l-6-6 6-6"/></svg>
                </div>
                <span class="menu-cta__text">Foruma geri dön</span>
            </div>
            <div class="menu-list__chev"><svg viewBox="0 0 24 24" class="icon-20"><path d="M9 18l6-6-6-6"/></svg></div>
        </a>

        {{-- Post header (TEST data) --}}
        <div class="card" style="max-width: 860px; margin: 0 auto 12px;">
            <div class="tx-card__top" style="margin-bottom:8px;">
                <h1 class="tx-card__title" style="margin:0;">Endometrioz təcrübələri: ağrı idarəsi üçün nə işə yaradı?</h1>
                <span class="badge badge--ok">Q&A</span>
            </div>
            <div class="device-card__meta" style="margin:8px 0 12px;">
                <span class="chip">İstifadəçi: <strong>ayla</strong></span>
                <span class="chip">30 dəq əvvəl</span>
                <span class="chip">Kateqoriya: <strong>Qadın sağlamlığı</strong></span>
            </div>
            <div class="tx-card__meta">
                <div style="display:flex; gap:12px; align-items:center;">
                <span class="device-card__address">
                    <svg class="icon-20" viewBox="0 0 24 24"><path d="M21 15a4 4 0 0 1-4 4H8l-5 3V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4z"/></svg>
                    8 cavab
                </span>
                    <span class="device-card__address">
                    <svg class="icon-20" viewBox="0 0 24 24"><path d="M14 9V5a3 3 0 0 0-6 0v4H5a2 2 0 0 0-2 2l1 8a2 2 0 0 0 2 2h8l4-8V9z"/></svg>
                    19 like
                </span>
                </div>
                <div class="actions">
                    <button class="btn btn--outline btn--sm" type="button">Bəyən</button>
                    <button class="btn btn--ghost btn--sm" type="button">Şikayət et</button>
                </div>
            </div>
        </div>

        {{-- Post body --}}
        <div class="auth-card" style="max-width: 860px; margin: 0 auto 16px;">
            <article class="prose" style="color:var(--ink);">
                <p>Salam! Endometriozla bağlı təcrübələrinizi toplamaq istəyirəm. Aşağıdakı üsullar sizdə necə nəticə verib?</p>
                <ul>
                    <li>Qidalanma dəyişiklikləri (antiinflamatuar pəhriz)</li>
                    <li>İstilik yastığı, fiziki terapiya</li>
                    <li>NSAID və ya həkim təyinatlı dərmanlar</li>
                    <li>Stress idarəetməsi, yuxu gigiyenası</li>
                </ul>
                <p>Həkim məsləhəti əvəzi deyil — sadəcə icma təcrübələri üçün mövzudur.</p>
            </article>
        </div>

        {{-- Answers list (TEST) --}}
        <h2 class="page__title" style="max-width:860px; margin: 0 auto 8px; font-size:18px;">Cavablar (3)</h2>
        <ul class="tx-cards" style="max-width: 860px; margin: 0 auto 16px;">
            <li class="tx-card">
                <div class="tx-card__icon icn--topup">
                    <svg viewBox="0 0 24 24"><path d="M12 6v12m6-6H6"/></svg>
                </div>
                <div class="tx-card__body">
                    <div class="tx-card__top">
                        <h3 class="tx-card__title">Fiziki terapiya xeyir etdi</h3>
                        <span class="chip chip--topup">+5 like</span>
                    </div>
                    <div class="device-card__meta">
                        <span class="chip">İstifadəçi: <strong>nigar</strong></span>
                        <span class="chip">20 dəq əvvəl</span>
                    </div>
                    <p style="margin:6px 0 0">Həftədə 2 dəfə pelvik PT ağrımı xeyli azaltdı. İstilik yastığı da çox kömək edir.</p>
                </div>
            </li>
            <li class="tx-card">
                <div class="tx-card__icon icn--payment">
                    <svg viewBox="0 0 24 24"><path d="M21 15a4 4 0 0 1-4 4H8l-5 3V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4z"/></svg>
                </div>
                <div class="tx-card__body">
                    <div class="tx-card__top">
                        <h3 class="tx-card__title">Pəhriz dəyişiklikləri</h3>
                        <span class="chip chip--payment">+2 like</span>
                    </div>
                    <div class="device-card__meta">
                        <span class="chip">İstifadəçi: <strong>selin</strong></span>
                        <span class="chip">1 saat əvvəl</span>
                    </div>
                    <p style="margin:6px 0 0">Qlüten və südü azaltdıqdan sonra sancılarım yüngülləşdi.</p>
                </div>
            </li>
            <li class="tx-card">
                <div class="tx-card__icon icn--refund">
                    <svg viewBox="0 0 24 24"><path d="M12 5v14m-7-7h14"/></svg>
                </div>
                <div class="tx-card__body">
                    <div class="tx-card__top">
                        <h3 class="tx-card__title">Dərman təcrübəsi</h3>
                        <span class="chip chip--refund">+0 like</span>
                    </div>
                    <div class="device-card__meta">
                        <span class="chip">İstifadəçi: <strong>kamila</strong></span>
                        <span class="chip">Dünən</span>
                    </div>
                    <p style="margin:6px 0 0">Həkimimlə məsləhətləşərək NSAID istifadə edirəm, kəskin günlərdə kömək edir.</p>
                </div>
            </li>
        </ul>

        {{-- Reply form (TEST) --}}
        <div class="auth-card" style="max-width: 860px; margin: 0 auto 90px;">
            <h2 class="auth-title" style="font-size:18px; margin-bottom:8px;">Cavab yaz</h2>
            <form method="POST" action="#">
                @csrf
                <div class="mb-3">
                    <label for="reply_body" class="form-label">Mətn</label>
                    <textarea id="reply_body" name="reply_body" rows="5" class="form-control" placeholder="Təcrübənizi bölüşün" required></textarea>
                </div>
                <div class="action-bar">
                    <button type="submit" class="btn btn--brand">Göndər</button>
                    <a href="{{ url()->previous() }}" class="btn btn--outline">Geri</a>
                </div>
            </form>
        </div>
    </div>
@endsection
