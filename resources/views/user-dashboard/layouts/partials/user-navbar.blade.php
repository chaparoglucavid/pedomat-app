<nav class="subnav" role="navigation" aria-label="İstifadəçi bölmələri">
    <ul class="subnav__list">
        {{-- Profil --}}
        <li class="subnav__item">
            <a class="subnav__link {{ request()->routeIs('user-dashboard*') ? 'is-active' : '' }}"
               href="{{ route('user-dashboard') }}" aria-label="Profil">
                <svg class="icon-20" viewBox="0 0 24 24">
                    <path d="M5 20a7 7 0 1 1 14 0"></path><circle cx="12" cy="8" r="4"></circle>
                </svg>
            </a>
        </li>

        {{-- Balans --}}
        <li class="subnav__item">
            <a class="subnav__link {{ request()->routeIs('user-balance*') ? 'is-active' : '' }}"
               href="{{ route('user-balance') }}" aria-label="Balans">
                <svg class="icon-20" viewBox="0 0 24 24">
                    <path d="M3 7h14a4 4 0 0 1 4 4v2a4 4 0 0 1-4 4H3z"></path><path d="M17 9h2a2 2 0 1 1 0 6h-2z"></path>
                </svg>
            </a>
        </li>


        {{-- Tarixçə --}}
        <li class="subnav__item">
            <a class="subnav__link {{ request()->routeIs('user-transactions*') ? 'is-active' : '' }}"
               href="{{ route('user-transactions') }}" aria-label="Tarixcə">
                <svg class="icon-20" viewBox="0 0 24 24">
                    <path d="M3 12a9 9 0 1 0 3-6.7"></path><path d="M3 3v6h6"></path><path d="M12 7v6l4 2"></path>
                </svg>
            </a>
        </li>

        {{-- Təkliflər --}}
        <li class="subnav__item">
            <a class="subnav__link {{ request()->routeIs('user-suggestions*') ? 'is-active' : '' }}"
               href="{{ route('user-suggestions') }}" aria-label="Təkliflər">
                <svg class="icon-20" viewBox="0 0 24 24">
                    <path d="M3 11a8 8 0 1 1 5.3 7.6L5 21l.8-3.2A8 8 0 0 1 3 11z"></path>
                </svg>
            </a>
        </li>

        <li class="subnav__item">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="subnav__link btn btn-danger" type="submit">
                    <svg class="icon-20" viewBox="0 0 24 24">
                        <path d="M16 17l5-5-5-5"></path>
                        <path d="M21 12H9"></path>
                        <path d="M13 21H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h6"></path>
                    </svg>
                </button>
            </form>
        </li>
    </ul>
</nav>
