<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>

    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{url('slick/slick.min.css')}}">
    <link rel="stylesheet" href="{{url('font-awesome/css/all.css')}}">
    @vite([
    'resources/css/style_main.scss',
    ])
</head>

<body>
    <x-client.header></x-client.header>
    @include('home.modal.login')
    @include('home.modal.register')
    @include('home.modal.checkout')
    @include('home.modal.orderDetail')
    <main class="main_form">
        @yield("content")
    </main>
    <x-client.footer></x-client.footer>

    <!-- JS -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{url('slick/slick.min.js')}}"></script>

    @vite([
    'resources/js/app_main.js',
    ])
</body>

</html>