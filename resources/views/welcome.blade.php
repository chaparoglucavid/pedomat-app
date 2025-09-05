@extends('layouts.app')

@section('content')
    <div class="phone">
        <div class="page__header">
            <h1 class="page__title">Cihazlar</h1>
            <p class="page__sub">Status, batareya, kateqoriya və ünvan</p>
        </div>


        <div class="cards pb-bottom-nav">
            @foreach ($equipments as $equipment)
                <a class="device-card" href="{{ route('equipment-details', encrypt($equipment->id)) }}">
                    <div class="device-card__icon" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M12 21.5c-2.761-1.284-5.239-4.884-5.239-8.884S8.239 5.5 12 5.5c3.761 0 5.239 2.599 5.239 7.116S14.761 20.216 12 21.5z"
                                stroke-miterlimit="10"/>
                            <path d="M15 15.5c-1.5 1-3.5 1-5 0" stroke-miterlimit="10"/>
                            <path d="M9 12.5a3.5 3.5 0 0 1 6 0" stroke-miterlimit="10"/>
                            <path
                                d="M12 5.5V3.5c0-1.104-.896-2-2-2s-2 .896-2 2v2c0 1.104.896 2 2 2h2v-2zM12 5.5V3.5c0-1.104.896-2 2-2s2 .896 2 2v2c0 1.104-.896 2-2 2h-2v-2z"/>
                        </svg>
                    </div>
                    <div class="device-card__body">
                        <div class="device-card__top">
                            <h3 class="device-card__title">{{ $equipment->equipment_number }}</h3>
                            <span
                                class="badge {{ $equipment->equipment_status==='active' ? 'badge--ok' : 'badge--off' }}">
                                {{ config('data.equipment_status')[$equipment->equipment_status] }}
                            </span>

                            @php
                                $pct = max(4, min(100, $equipment->battery_level));
                                $fill = round($pct * 0.20);
                                $color = $pct < 20 ? 'var(--danger)' : ($pct < 60 ? 'var(--warning)' : 'var(--ok)');
                            @endphp
                            <span class="battery-icn" title="Batareya">
                            <svg class="battery-icn__svg" viewBox="0 0 28 16" aria-hidden="true">
                                <rect x="1" y="3" width="22" height="10" rx="2" ry="2" fill="none" stroke="#cbd5e1"
                                      stroke-width="1.5"></rect>
                                <rect x="24" y="5" width="3" height="6" rx="1" ry="1" fill="#cbd5e1"></rect>
                                <rect x="2" y="4" width="{{ $fill }}" height="8" rx="1" ry="1"
                                      fill="{{ $color }}"></rect>
                            </svg>
                            <span class="battery-icn__pct">{{ $pct }}%</span>
                        </span>
                        </div>


                        <div class="device-card__meta">
                            <span class="chip w-100">Ümumi tutum:{{ $equipment->general_capacity }} ədəd</span>
                            <span
                                class="chip w-100">Cari balans:{{ array_sum($equipment->qty_list->toArray()) }} ədəd</span>
                        </div>

                        <small class="device-card__address">
                                <svg class="battery-icn__svg" viewBox="0 0 640 640" width="28" height="16" aria-hidden="true">
                                    <path
                                        d="M128 252.6C128 148.4 214 64 320 64C426 64 512 148.4 512 252.6C512 371.9 391.8 514.9 341.6 569.4C329.8 582.2 310.1 582.2 298.3 569.4C248.1 514.9 127.9 371.9 127.9 252.6zM320 320C355.3 320 384 291.3 384 256C384 220.7 355.3 192 320 192C284.7 192 256 220.7 256 256C256 291.3 284.7 320 320 320z"/>
                                </svg>
                                {{ $equipment->current_address }}
                        </small>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection
