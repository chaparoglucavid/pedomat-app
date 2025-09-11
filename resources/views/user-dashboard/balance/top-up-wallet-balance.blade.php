@extends('user-dashboard.layouts.user-master')
@section('user-content')
    <form id="topupForm" method="POST" action="{{ route('user-top-up-wallet-balance') }}">
        @csrf

        <div class="balance-page">
            <form id="topupForm" method="POST" action="{{ route('user-top-up-wallet-balance') }}">
                @csrf

                <div class="balance-center">
                    <label for="amount" class="sr-only">Məbləğ</label>
                    <div class="balance-input-wrapper">
                        <input
                            id="amount"
                            name="amount"
                            type="text"
                            class="balance-input"
                            inputmode="decimal"
                            autocomplete="off"
                            aria-label="Top-up amount"
                        >
                        <span class="balance-prefix">₼</span>
                    </div>
                </div>

                <button type="submit" id="topupBtn" class="btn btn--ok w-100 mt-4" disabled>
                    Balansı artırın
                </button>
            </form>
        </div>

    </form>
@endsection

@section('js-code')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('topupForm');
            const input = document.getElementById('amount');
            const btn = document.getElementById('topupBtn');

            function toggleButton() {
                const val = parseFloat(input.value.replace(',', '.'));
                btn.disabled = !(isFinite(val) && val > 0);
            }

            input.addEventListener('input', function () {
                let v = this.value.replace(/\s+/g, '');
                v = v.replace(',', '.');
                v = v.replace(/[^\d.]/g, '');
                const parts = v.split('.');
                if (parts.length > 2) {
                    v = parts[0] + '.' + parts.slice(1).join('');
                }
                const [intPart, decPart = ''] = v.split('.');
                if (decPart.length > 2) {
                    v = intPart + '.' + decPart.slice(0, 2);
                }
                this.value = v;

                toggleButton();
            });

            form.addEventListener('submit', function (e) {
                let raw = (input.value || '').trim().replace(',', '.');
                const num = parseFloat(raw);
                if (!isFinite(num) || num <= 0) {
                    e.preventDefault();
                    alert('Düzgün məbləğ daxil edin (məs: 10.00).');
                    return;
                }
                input.value = num.toFixed(2);
            });
        });
    </script>
@endsection
