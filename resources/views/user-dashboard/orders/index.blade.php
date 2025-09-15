@extends('user-dashboard.layouts.user-master')
@section('user-content')
    <div class="phone">
        <header class="page__header">
            <h1 class="page__title">Tarixçə</h1>
            <p class="page__sub">Cihazlardan çıxardığın PED və ödənişlər</p>
        </header>

        <ul class="tx-cards">
            @forelse($orders as $order)
                <li class="tx-card {{ $order->barcode_status ? 'unused_barcode' : 'used_barcode' }}">
                    <div class="tx-card__icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24">
                            <rect x="7" y="2" width="10" height="20" rx="2"></rect>
                            <path d="M11 18h2"></path>
                        </svg>
                    </div>

                    <div class="tx-card__body">
                        <div class="tx-card__top">
                            <h4 class="tx-card__title">#{{ $order->order_number }}</h4>
                            <br>
                            <div class="tx-card__money">
                                <span class="chip tx-chip--ped">{{ $order->order_qty_sum }} ədəd</span>
                                <span class="tx-amount">{{ $order->order_amount_sum }}₼</span>
                            </div>
                        </div>
                        <div class="tx-card__meta">
                            <time
                                datetime="2025-08-26T09:05:00+04:00">{{ \Carbon\Carbon::parse($order->created_at)->format('d.m.Y H:i') }}</time>

                            <span class="text-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" height="15" width="15"><!--!Font Awesome Free v7.0.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path fill="#f06a6a" d="M352 96C352 78.3 337.7 64 320 64C302.3 64 288 78.3 288 96L288 306.7L246.6 265.3C234.1 252.8 213.8 252.8 201.3 265.3C188.8 277.8 188.8 298.1 201.3 310.6L297.3 406.6C309.8 419.1 330.1 419.1 342.6 406.6L438.6 310.6C451.1 298.1 451.1 277.8 438.6 265.3C426.1 252.8 405.8 252.8 393.3 265.3L352 306.7L352 96zM160 384C124.7 384 96 412.7 96 448L96 480C96 515.3 124.7 544 160 544L480 544C515.3 544 544 515.3 544 480L544 448C544 412.7 515.3 384 480 384L433.1 384L376.5 440.6C345.3 471.8 294.6 471.8 263.4 440.6L206.9 384L160 384zM464 440C477.3 440 488 450.7 488 464C488 477.3 477.3 488 464 488C450.7 488 440 477.3 440 464C440 450.7 450.7 440 464 440z"/></svg>
                                İnvoys
                            </span>
                        </div>

                        <div style="margin-top:10px">
                            <button class="btn btn-primary w-100" type="button"
                                    onclick="openBarcodeModal('{{ $order->id }}')">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" height="24" width="24"><!--!Font Awesome Free v7.0.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M128 96C110.3 96 96 110.3 96 128L96 512C96 529.7 110.3 544 128 544C145.7 544 160 529.7 160 512L160 128C160 110.3 145.7 96 128 96zM216 96C202.7 96 192 106.7 192 120L192 520C192 533.3 202.7 544 216 544C229.3 544 240 533.3 240 520L240 120C240 106.7 229.3 96 216 96zM288 128L288 512C288 529.7 302.3 544 320 544C337.7 544 352 529.7 352 512L352 128C352 110.3 337.7 96 320 96C302.3 96 288 110.3 288 128zM496 120L496 520C496 533.3 506.7 544 520 544C533.3 544 544 533.3 544 520L544 120C544 106.7 533.3 96 520 96C506.7 96 496 106.7 496 120zM400 120L400 520C400 533.3 410.7 544 424 544C437.3 544 448 533.3 448 520L448 120C448 106.7 437.3 96 424 96C410.7 96 400 106.7 400 120z"/></svg>
                                İstifadə et
                            </button>
                        </div>
                    </div>

                </li>
            @empty
                <div class="empty" role="status" aria-live="polite">
                    <svg class="empty__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <circle cx="12" cy="12" r="9" opacity=".15"></circle>
                        <path d="M8 12h8M12 8v8" stroke-width="1.6"></path>
                    </svg>
                    <p class="empty__title">Əməliyyat yoxdur</p>
                    <p class="empty__sub">Yeni sifarişlər burada görsənəcək.</p>
                </div>
            @endforelse
        </ul>
    </div>

    <div id="barcode-modal" class="barcode-modal" aria-hidden="true" role="dialog" aria-modal="true" aria-labelledby="barcode-title">
        <div id="barcode-panel" class="barcode-modal__panel" tabindex="-1">
            <button class="modal-close" type="button" aria-label="Bağla">✕</button>
            <h3 id="barcode-title" class="barcode-title">Barkod</h3>
            <div id="barcode-canvas" class="barcode-canvas" aria-live="polite"></div>
        </div>
    </div>
@endsection
@section('js-code')
    <script>
        (function(){
            const overlay = document.getElementById('barcode-modal');
            const panel   = document.getElementById('barcode-panel');
            const canvas  = document.getElementById('barcode-canvas');
            const closeBtn= overlay?.querySelector('.modal-close');

            if(!overlay || !panel || !canvas || !closeBtn){
                console.warn('[barcode] Modal elementləri tapılmadı.');
                return;
            }

            function normalizeBarcode(el){
                if(el instanceof SVGElement){
                    el.removeAttribute('width');
                    el.removeAttribute('height');
                    el.style.width = 'auto';
                    el.style.height = 'auto';
                    el.style.maxWidth = 'none';
                    el.style.maxHeight = 'none';
                }
                el.classList.add('barcode-raw');
            }

            async function openBarcodeModal(orderId){
                overlay.classList.add('is-open');
                overlay.setAttribute('aria-hidden','false');
                document.documentElement.style.overflow = 'hidden';
                setTimeout(()=>panel.focus(), 0);

                try{
                    const res  = await fetch(`/orders/${orderId}/barcode`, {headers:{'X-Requested-With':'XMLHttpRequest'}});
                    if(!res.ok) throw new Error('HTTP '+res.status);
                    const data = await res.json();

                    canvas.innerHTML = data.barcode || '';
                    const raw = canvas.querySelector('svg, img');
                    if(raw) normalizeBarcode(raw);
                }catch(e){
                    console.error(e);
                    canvas.innerHTML = '<p style="color:#dc2626;margin:8px 0;">Barkodu açmaq mümkün olmadı.</p>';
                }
            }

            function closeBarcodeModal(){
                overlay.classList.remove('is-open');
                overlay.setAttribute('aria-hidden','true');
                document.documentElement.style.overflow = '';
                canvas.innerHTML = '';
            }

            window.openBarcodeModal  = openBarcodeModal;
            window.closeBarcodeModal = closeBarcodeModal;

            closeBtn.addEventListener('click', (e)=>{ e.preventDefault(); e.stopPropagation(); closeBarcodeModal(); });
            overlay.addEventListener('click', (e)=>{ if(e.target === overlay) closeBarcodeModal(); });
            document.addEventListener('keydown', (e)=>{ if(e.key === 'Escape' && overlay.classList.contains('is-open')) closeBarcodeModal(); });

        })();
    </script>

@endsection
