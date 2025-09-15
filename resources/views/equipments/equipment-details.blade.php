@extends('layouts.app')

@section('content')
    <div class="container mt-4 pb-bottom-nav">

        <div class="page__header">
            <h2 class="page__title mb-1">Cihaz Məlumatları</h2>
            <div class="page__sub">ID: #{{ $equipment->id }}</div>
        </div>

        <div class="device-card mb-4">
            <div class="device-card__icon" aria-hidden="true">
                <!-- (mevcut svg) -->
            </div>
            <div class="device-card__body">
                <div class="device-card__top">
                    <h3 class="device-card__title">{{ $equipment->equipment_number }}</h3>
                    <span class="badge {{ $equipment->equipment_status==='active' ? 'badge--ok' : 'badge--off' }}">
                    {{ config('data.equipment_status')[$equipment->equipment_status] }}
                </span>

                    @php
                        $pct = max(4, min(100, $equipment->battery_level));
                        $fill = round($pct * 0.20);
                        $color = $pct < 20 ? 'var(--danger)' : ($pct < 60 ? 'var(--warning)' : 'var(--ok)');
                    @endphp
                    <span class="battery-icn" title="Batareya">
                    <svg class="battery-icn__svg" viewBox="0 0 28 16" aria-hidden="true">
                        <rect x="1" y="3" width="22" height="10" rx="2" ry="2" fill="none" stroke="#cbd5e1" stroke-width="1.5"></rect>
                        <rect x="24" y="5" width="3" height="6" rx="1" ry="1" fill="#cbd5e1"></rect>
                        <rect x="2" y="4" width="{{ $fill }}" height="8" rx="1" ry="1" fill="{{ $color }}"></rect>
                    </svg>
                    <span class="battery-icn__pct">{{ $pct }}%</span>
                </span>
                </div>

                <div class="device-card__meta">
                    <span class="chip w-100">Cari balans: {{ array_sum($equipment->qty_list->toArray()) }} ədəd</span>
                    <span class="chip w-100">
                            <small class="device-card__address">
                            {{ $equipment->current_address }}
                        </small>
                        </span>
                </div>

            </div>
        </div>

        {{-- FORM KARTI --}}
        <div class="order-card mt-4">
            <form id="pedForm" method="post" action="{{ route('user-reserve-ped') }}" novalidate>
                @csrf
                <input type="hidden" name="equipment_id" value="{{ $equipment->id }}">

                <div class="row g-3">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table align-middle table-modern">
                                <thead>
                                <tr>
                                    <th style="width:45%">Ped Kateqoriyası</th>
                                    <th style="width:55%">Rezerv Sayı</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($equipment->ped_categories as $cat)
                                    @php
                                        $max = (int) $cat->pivot->qty_available;
                                        $inputId = 'qty_'.$cat->id;
                                        $price = (float) $cat->unit_price;
                                    @endphp
                                    <tr class="ped-row" data-cat-id="{{ $cat->id }}" data-unit-price="{{ $price }}">
                                        <td>
                                            <strong class="cat-name">{{ $cat->category_name }}</strong>
                                            <div class="mt-1 small text-muted d-flex align-items-center gap-1">
                                                <span class="unit-price">{{ number_format($price, 2, '.', ' ') }}</span>₼
                                            </div>
                                        </td>
                                        <td>
                                            <div class="qty-control" data-max="{{ $max }}">
                                                <button type="button"
                                                        class="btn qty-decrease"
                                                        aria-label="Azalt">−</button>

                                                <div class="qty-display" aria-live="polite" aria-atomic="true">0</div>

                                                <button type="button"
                                                        class="btn qty-increase"
                                                        aria-label="Artır">+</button>

                                                <input type="hidden"
                                                       name="quantities[{{ $cat->id }}]"
                                                       class="qty-value"
                                                       value="0">
                                            </div>

                                            <small class="text-muted d-block">Maksimum: {{ $max }}</small>
                                            <div class="line-total-wrap">
                                                Məbləğ: <span class="line-total">0.00</span> ₼
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-muted">Bu cihaz üçün ped kateqoriyası yoxdur.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="summary">
                    <div class="h6 mb-0">
                        Sifarişin ümumi məbləği:
                        <span id="totalAmount" class="fw-bold">0.00</span> ₼
                    </div>
                    <div class="small text-muted">
                        Ümumi say: <span id="totalQty">0</span> ədəd
                    </div>
                </div>

                <div class="pay-section">
                    <div class="pay-label">Ödəniş üsulu:</div>

                    <div class="pay-grid">
                        <input class="btn-check" type="radio" name="payment_method" id="pay_balance" value="balance" autocomplete="off" required>
                        <label class="pay-card" for="pay_balance" aria-label="Balansdan ödə">
                            <div class="pay-icon" aria-hidden="true">
                                {{-- Büyük SVG ikon --}}
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                     stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 7H5a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2h15a2 2 0 0 0 2-2v-1"/>
                                    <path d="M16 3H6a2 2 0 0 0-2 2v2h12a2 2 0 0 1 2 2v1h3V9a6 6 0 0 0-6-6z"/>
                                    <path d="M18 12h3v4h-3a2 2 0 0 1-2-2 2 2 0 0 1 2-2z"/>
                                </svg>
                            </div>
                            <div class="pay-text">
                                <div class="pay-title">Balansdan ödə</div>
                                <div class="pay-sub">Tez və komissiyasız</div>
                            </div>
                        </label>

                        <input class="btn-check" type="radio" name="payment_method" id="pay_card" value="card" autocomplete="off">
                        <label class="pay-card" for="pay_card" aria-label="Kart vasitəsi ilə ödə">
                            <div class="pay-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                     stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="2" y="5" width="20" height="14" rx="2" ry="2"></rect>
                                    <line x1="2" y1="10" x2="22" y2="10"></line>
                                    <line x1="6" y1="15" x2="12" y2="15"></line>
                                </svg>
                            </div>
                            <div class="pay-text">
                                <div class="pay-title">Kartla ödə</div>
                                <div class="pay-sub">Visa/Mastercard</div>
                            </div>
                        </label>
                    </div>
                </div>

                <div class="action-bar">
                    <button type="submit" class="btn btn-primary" id="continueBtn">Sifarişi tamamla</button>
                    <button type="button" class="btn btn-outline-secondary" id="resetForm">Təmizlə</button>
                </div>

                @if(session('error'))
                    <div class="alert alert-warning mt-3">{{ session('error') }}</div>
                @endif
            </form>
        </div>

    </div>
@endsection

@section('js-code')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('pedForm');
            const totalAmountEl = document.getElementById('totalAmount');
            const totalQtyEl = document.getElementById('totalQty');
            const resetBtn = document.getElementById('resetForm');
            const continueBtn = document.getElementById('continueBtn');

            const toNumber = v => {
                const n = parseFloat(String(v).replace(',', '.'));
                return Number.isFinite(n) ? n : 0;
            };
            const fmt = n => toNumber(n).toFixed(2);

            function getRowQty(row){
                const valEl = row.querySelector('.qty-value');
                const v = parseInt(valEl?.value, 10);
                return Number.isFinite(v) ? v : 0;
            }
            function setRowQty(row, qty){
                const max = parseInt(row.querySelector('.qty-control')?.dataset.max || '0', 10) || 0;
                const clamped = Math.max(0, Math.min(qty, max));
                const valEl = row.querySelector('.qty-value');
                const dispEl = row.querySelector('.qty-display');
                if (valEl) valEl.value = clamped;
                if (dispEl) dispEl.textContent = clamped;
                return clamped;
            }
            function recalcRow(row){
                const unit = toNumber(row.dataset.unitPrice);
                const qty = getRowQty(row);
                const line = unit * qty;
                const lineEl = row.querySelector('.line-total');
                if (lineEl) lineEl.textContent = fmt(line);
                return {qty, line};
            }
            function recalcAll(){
                let total = 0, qtySum = 0;
                form.querySelectorAll('tr.ped-row').forEach(row=>{
                    const {qty, line} = recalcRow(row);
                    qtySum += qty; total += line;
                });
                totalAmountEl.textContent = fmt(total);
                totalQtyEl.textContent = qtySum;
                return {total, qtySum};
            }

            form.addEventListener('click', function(e){
                const incBtn = e.target.closest('.qty-increase');
                const decBtn = e.target.closest('.qty-decrease');
                if (!incBtn && !decBtn) return;

                const row = e.target.closest('tr.ped-row');
                if (!row) return;

                const current = getRowQty(row);
                const max = parseInt(row.querySelector('.qty-control')?.dataset.max || '0', 10) || 0;

                let next = current;
                if (incBtn) next = Math.min(current + 1, max);
                if (decBtn) next = Math.max(current - 1, 0);

                setRowQty(row, next);
                recalcAll();
            });

            if (resetBtn){
                resetBtn.addEventListener('click', function(){
                    form.reset(); // hidden input-ları da 0 edir (çünki default value=0-dır)
                    form.querySelectorAll('.qty-display').forEach(d => d.textContent = '0');
                    form.querySelectorAll('.line-total').forEach(el => el.textContent = '0.00');
                    recalcAll();
                });
            }

            if (continueBtn){
                continueBtn.addEventListener('click', function(e){
                    const {total, qtySum} = recalcAll();
                    const selectedPayment = form.querySelector('input[name="payment_method"]:checked');

                    if (qtySum <= 0 || total <= 0) {
                        e.preventDefault();
                        alert('Sifarişi tamamlamazdan əvvəl ən azı 1 ədəd seçin.');
                        return;
                    }
                    if (!selectedPayment){
                        e.preventDefault();
                        alert('Ödəniş üsulunu seçin: Balans və ya Kart.');
                        return;
                    }
                });
            }

            recalcAll();
        });
    </script>

@endsection
