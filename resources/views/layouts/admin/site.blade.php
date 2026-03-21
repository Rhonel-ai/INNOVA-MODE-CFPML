<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCHOOL'S VOICE 2025</title>
    <link rel="stylesheet" href="{{ asset('site/css/styles.css')}}">
    <link rel="stylesheet" href="{{ asset('site/css/responsive.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Vos styles CSS existants -->
    <!-- <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}"> -->

    <!-- KKiaPay SDK - Chargé globalement -->
    <script src="https://cdn.kkiapay.me/k.js"></script>
    @stack('styles')
</head>

<body>

    <!-- HEADER -->
    @include('sites.partials.header')
    <!-- HEADER -->

    <!-- CONTAINER -->
    @yield('content')
    <!-- / .container-fluid -->

    <!-- Footer -->
    @include('sites.partials.footer')
    <!-- Footer -->


    <script src="{{ asset('site/js/main.js')}}"></script>
    <script src="{{ asset('site/js/modal.js')}}"></script>
    <script src="{{ asset('site/js/share.js')}}"></script>
    @stack('scripts')
</body>

</html>