@php
    $isMap = request()->routeIs('equipments*');
    $isGuide = request()->routeIs('guide*');
    $isForum = request()->routeIs('forum*');
    $isAccount = request()->routeIs('account*');
@endphp

<footer class="bottom-nav">
    <nav>
        <ul class="bottom-nav__list">
            <li>
                <a href="{{ route('equipments') }}"
                   class="bottom-nav__link {{ $isMap ? 'bottom-nav__link--active' : '' }}"
                   aria-label="Xəritə">
                    {{-- Map Pin --}}
                    <svg viewBox="0 0 24 24" class="icon-20">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M19.5 10.5c0 7.5-7.5 10.5-7.5 10.5S4.5 18 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/>
                    </svg>
                    <span>Cihazlar</span>
                </a>
            </li>

            <li>
                <a href="{{ route('guide') }}"
                   class="bottom-nav__link {{ $isGuide ? 'bottom-nav__link--active' : '' }}"
                   aria-label="İstifadə qaydası">
                    {{-- Book Open --}}
                    <svg viewBox="0 0 24 24" class="icon-20">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M3.75 6.75A2.25 2.25 0 0 1 6 4.5h4.5v13.5H6a2.25 2.25 0 0 0-2.25 2.25v-13.5Z"/>
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M20.25 6.75A2.25 2.25 0 0 0 18 4.5h-4.5v13.5H18a2.25 2.25 0 0 1 2.25 2.25v-13.5Z"/>
                    </svg>
                    <span>Period</span>
                </a>
            </li>

            <li>
                <a href="{{ route('forum') }}"
                   class="bottom-nav__link {{ $isForum ? 'bottom-nav__link--active' : '' }}"
                   aria-label="Forum">
                    {{-- Chat Bubbles --}}
                    <svg viewBox="0 0 24 24" class="icon-20">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M7.5 8.25h9m-9 3h6.75M12 21l-3.75-2.25H6A3 3 0 0 1 3 15.75V8.25A3 3 0 0 1 6 5.25h12A3 3 0 0 1 21 8.25v7.5A3 3 0 0 1 18 18.75h-2.25L12 21Z"/>
                    </svg>
                    <span>Forum</span>
                </a>
            </li>
            <li>
                <a href="{{ route('user-dashboard') }}"
                   class="bottom-nav__link {{ $isAccount ? 'bottom-nav__link--active' : '' }}"
                   aria-label="Hesab məlumatları">
                    {{-- User Circle --}}
                    <svg viewBox="0 0 24 24" class="icon-20">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z"/>
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M4.5 19.5a7.5 7.5 0 0 1 15 0M12 22.5a10.5 10.5 0 1 0 0-21 10.5 10.5 0 0 0 0 21Z"/>
                    </svg>
                    <span>Profil</span>
                </a>
            </li>
        </ul>
    </nav>
</footer>
