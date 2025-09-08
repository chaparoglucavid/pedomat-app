@extends('layouts.app')

@section('content')
    <div class="container mt-4 pb-bottom-nav">

        <div class="page__header">
            <h2 class="page__title mb-1">Cihaz Məlumatları</h2>
            <div class="page__sub">ID: #{{ $equipment->id }}</div>
        </div>

        <div class="device-card">
            <div class="device-card__icon" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 21.5c-2.761-1.284-5.239-4.884-5.239-8.884S8.239 5.5 12 5.5c3.761 0 5.239 2.599 5.239 7.116S14.761 20.216 12 21.5z"/>
                    <path d="M15 15.5c-1.5 1-3.5 1-5 0"/>
                    <path d="M9 12.5a3.5 3.5 0 0 1 6 0"/>
                    <path d="M12 5.5V3.5c0-1.104-.896-2-2-2s-2 .896-2 2v2c0 1.104.896 2 2 2h2v-2zM12 5.5V3.5c0-1.104.896-2 2-2s2 .896 2 2v2c0 1.104-.896 2-2 2h-2v-2z"/>
                </svg>
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
                    <span class="chip w-100">Ümumi tutum: {{ $equipment->general_capacity }} ədəd</span>
                    <span class="chip w-100">Cari balans: {{ array_sum($equipment->qty_list->toArray()) }} ədəd</span>
                </div>

                <small class="device-card__address">
                    <svg class="battery-icn__svg" viewBox="0 0 640 640" width="28" height="16" aria-hidden="true">
                        <path d="M128 252.6C128 148.4 214 64 320 64C426 64 512 148.4 512 252.6C512 371.9 391.8 514.9 341.6 569.4C329.8 582.2 310.1 582.2 298.3 569.4C248.1 514.9 127.9 371.9 127.9 252.6zM320 320C355.3 320 384 291.3 384 256C384 220.7 355.3 192 320 192C284.7 192 256 220.7 256 256C256 291.3 284.7 320 320 320z"/>
                    </svg>
                    {{ $equipment->current_address }}
                </small>
            </div>
        </div>

        {{-- FORM KARTI --}}
        <div class="auth-card mt-4">
            <form id="pedForm" method="post" action="{{ route('user-reserve-ped') }}" novalidate>
                @csrf
                <input type="hidden" name="equipment_id" value="{{ $equipment->id }}">

                <div class="row g-3">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table align-middle">
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
                                            <strong class="cat-name">{{ $cat->category_name }}</strong><br>
                                            <div class="mt-1 small text-muted">
                                                <span class="unit-price">{{ number_format($price, 2, '.', ' ') }}</span>₼
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2 qty-control" data-max="{{ $max }}">
                                                <button type="button" class="btn btn-outline-secondary btn-sm qty-decrease"
                                                        data-target="#{{ $inputId }}" aria-label="Azalt">−</button>

                                                <input type="number" id="{{ $inputId }}"
                                                       name="quantities[{{ $cat->id }}]"
                                                       class="form-control qty-input"
                                                       value="0" min="0" max="{{ $max }}"
                                                       inputmode="numeric" pattern="[0-9]*"
                                                       style="max-width: 110px; text-align:center;">

                                                <button type="button" class="btn btn-outline-secondary btn-sm qty-increase"
                                                        data-target="#{{ $inputId }}" aria-label="Artır">+</button>
                                            </div>
                                            <small class="text-muted">Maksimum: {{ $max }}</small>
                                            <div class="mt-1 fw-semibold text-success">
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

                <div class="ms-auto">
                    <div class="h6 mb-0">
                        Sifarişin ümumi məbləği:
                        <span id="totalAmount" class="fw-bold">0.00</span> ₼
                    </div>
                    <div class="small text-muted">
                        Ümumi say: <span id="totalQty">0</span> ədəd
                    </div>
                </div>

                <div class="mt-3">
                    <div class="small text-muted mb-2">Ödəniş üsulu:</div>

                    <input class="btn-check" type="radio" name="payment_method" id="pay_balance" value="balance" autocomplete="off" required>
                    <label class="btn btn-outline-primary d-inline-flex align-items-center gap-2 me-2" for="pay_balance" style="border-radius: 0.75rem;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M20 7H5a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2h15a2 2 0 0 0 2-2v-1"/>
                            <path d="M16 3H6a2 2 0 0 0-2 2v2h12a2 2 0 0 1 2 2v1h3V9a6 6 0 0 0-6-6z"/>
                            <path d="M18 12h3v4h-3a2 2 0 0 1-2-2 2 2 0 0 1 2-2z"/>
                        </svg>
                        Balansdan ödə
                    </label>

                    <input class="btn-check" type="radio" name="payment_method" id="pay_card" value="card" autocomplete="off">
                    <label class="btn btn-outline-success d-inline-flex align-items-center gap-2" for="pay_card" style="border-radius: 0.75rem;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <rect x="2" y="5" width="20" height="14" rx="2" ry="2"></rect>
                            <line x1="2" y1="10" x2="22" y2="10"></line>
                            <line x1="6" y1="15" x2="10" y2="15"></line>
                        </svg>
                        Kart vasitəsi ilə ödə
                    </label>
                </div>

                <div class="d-flex gap-2 mt-3 align-items-center flex-wrap">
                    <button type="submit" class="btn btn-primary" id="continueBtn">
                        Sifarişi tamamla
                    </button>
                    <button type="button" class="btn btn-outline-secondary" id="resetForm">
                        Təmizlə
                    </button>
                </div>
            </form>

            @if(session('error'))
                <div class="alert alert-warning mt-3">{{ session('error') }}</div>
            @endif
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

            function toNumber(v){ const n = parseFloat(String(v).replace(',', '.')); return Number.isFinite(n) ? n : 0; }
            function fmt(n){ return toNumber(n).toFixed(2); }

            function recalcRow(row){
                const unit = toNumber(row.dataset.unitPrice);
                const qty = toNumber(row.querySelector('.qty-input')?.value || 0);
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
                const btn = incBtn || decBtn;

                let input;
                const targetSel = btn.getAttribute('data-target');
                if (targetSel) input = form.querySelector(targetSel);
                if (!input){
                    const row = btn.closest('.qty-control') || btn.closest('td') || btn.parentElement;
                    input = row ? row.querySelector('input[type="number"][name^="quantities"]') : null;
                }
                if (!input) return;

                const max = parseInt(input.getAttribute('max'), 10) || 0;
                const min = parseInt(input.getAttribute('min'), 10) || 0;
                let val = parseInt(input.value, 10);
                if (Number.isNaN(val)) val = 0;

                if (incBtn) val = Math.min(val + 1, max);
                if (decBtn) val = Math.max(val - 1, min);

                input.value = val;
                input.dispatchEvent(new Event('input'));
                input.dispatchEvent(new Event('change'));
            });

            form.querySelectorAll('input[type="number"][name^="quantities"]').forEach(inp=>{
                function sanitize(){
                    const max = parseInt(this.getAttribute('max'), 10) || 0;
                    const min = parseInt(this.getAttribute('min'), 10) || 0;
                    let val = parseInt(this.value, 10);
                    if (Number.isNaN(val)) val = 0;
                    if (val > max) val = max;
                    if (val < min) val = min;
                    this.value = val;

                    const row = this.closest('tr.ped-row');
                    if (row) recalcRow(row);
                    recalcAll();
                }
                inp.addEventListener('input', sanitize);
                inp.addEventListener('change', sanitize);
            });

            if (resetBtn){
                resetBtn.addEventListener('click', function(){
                    form.reset();
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
