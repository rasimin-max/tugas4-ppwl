<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Dashboard informasi akademik dan kegiatan kemahasiswaan.">
    <title>@yield('title', 'Dashboard Akademik') | CampusInfo</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="app-shell">
        @include('layouts.partials.navbar')

        <div class="app-body">
            @include('layouts.partials.sidebar')

            <main class="main-content">
                @yield('content')
                @include('layouts.partials.footer')
            </main>
        </div>
    </div>
</body>
</html>
