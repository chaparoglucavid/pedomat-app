@extends('user-dashboard.layouts.user-master')
@section('user-content')
    <div class="phone">
        <header class="page__header">
            <h1 class="page__title">Balans</h1>
            <p class="page__sub">Balans artımı, ödəniş və geri qaytarma əməliyyatları</p>
        </header>

        <div class="d-flex justify-content-end">
            <a href="{{ route('user-top-up-wallet-balance') }}">
                <button class="btn btn--ok">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" height="18" width="18"><path
                            fill="#ffffff"
                            d="M352 128C352 110.3 337.7 96 320 96C302.3 96 288 110.3 288 128L288 288L128 288C110.3 288 96 302.3 96 320C96 337.7 110.3 352 128 352L288 352L288 512C288 529.7 302.3 544 320 544C337.7 544 352 529.7 352 512L352 352L512 352C529.7 352 544 337.7 544 320C544 302.3 529.7 288 512 288L352 288L352 128z"/></svg>                </span>
                    Balansı artırın
                </button>
            </a>
        </div>
        {{-- (opsional) xülasə kartı --}}
        <section class="card balance-summary">
            <div class="balance-summary__row">
                <div class="balance-summary__stat">
                    <span class="label">Cari balans</span>
                    <strong class="value">{{ $current_balance }} ₼</strong>
                </div>
                <div class="balance-summary__stat">
                    <span class="label">Bu ay əlavə</span>
                    <strong class="value">+ {{ $this_month_transactions }} ₼</strong>
                </div>
            </div>
        </section>
        {{-- Kart siyahı – 3 statik nümunə --}}
        <ul class="tx-cards">
            {{-- Balans artımı --}}
            @foreach($balance_history as $history)
                <li class="tx-card">
                    <div class="tx-card__icon icn--topup" aria-hidden="true">
                        <svg viewBox="0 0 24 24">
                            <path d="M12 4v12"></path>
                            <path d="M6 10h12"></path>
                        </svg>
                    </div>
                    <div class="tx-card__body">
                        <div class="tx-card__top">
                            <h3 class="tx-card__title">Balans artımı</h3>
                            <div class="tx-card__money">
                                <span class="chip chip--topup">Kart (VISA ···· 8212)</span>
                                <span class="tx-amount amount-positive">+{{ $history->amount }} ₼</span>
                            </div>
                        </div>
                        <div class="tx-card__meta">
                            <span>Ödəniş provayderi: Stripe</span>
                            <time
                                datetime="2025-08-30T16:40:00+04:00">{{ \Carbon\Carbon::parse($history->created_at)->format('d.m.Y H:i') }}</time>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
