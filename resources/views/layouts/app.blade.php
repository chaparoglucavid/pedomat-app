<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Pedomat - Sizin ən yaxın dostunuz</title>
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('css-code')
</head>
<body>
<div class="phone">


    @include('layouts.partials.topbar')

    <div class="screens pb-bottom-nav"> @yield('content') </div>

    @include('layouts.partials.footer')

</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@yield('js-code')
</body>
</html>
