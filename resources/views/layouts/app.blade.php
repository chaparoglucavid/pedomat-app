<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <title>Pedomat - Sizin ən yaxın dostunuz</title>
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('css-code')
</head>
<body>
<div class="phone">

    @include('layouts.partials.topbar')

    <div class="screens pb-bottom-nav">
        @yield('content')
    </div>

    @include('layouts.partials.footer')

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    (function () {
        const nav = document.querySelector('.bottom-nav');
        const root = document.documentElement;
        if (!nav) return;

        let focusCount = 0;

        function setKbOpen(on) {
            root.classList.toggle('kb-open', !!on);
            nav.classList.toggle('bottom-nav--hidden', !!on);
        }

        document.addEventListener('focusin', (e) => {
            if (e.target.matches('input, textarea, [contenteditable="true"], .balance-input')) {
                focusCount++;
                setKbOpen(true);
            }
        });

        document.addEventListener('focusout', () => {
            setTimeout(() => {
                focusCount = Math.max(0, focusCount - 1);
                if (focusCount === 0) setKbOpen(false);
            }, 50);
        });

        if (window.visualViewport) {
            const onViewport = () => {
                const vv = window.visualViewport;
                const isShrunk = vv.height < window.innerHeight - 80;
                setKbOpen(isShrunk || focusCount > 0);
            };
            visualViewport.addEventListener('resize', onViewport);
            visualViewport.addEventListener('scroll', onViewport);
        }
    })();
</script>


@yield('js-code')
</body>
</html>
