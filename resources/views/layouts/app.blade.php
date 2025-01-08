<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ isset($title) ? $title . ' / ' . config('app.name', 'Laravel') : config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


        <script type="text/javascript"
            src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{ config('services.midtrans.clientKey') }}">
        </script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white mb-10 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            <!-- Footer Section -->
            <footer style="background-color: #820000; color: #ffffff; padding: 40px 0;">
                <div class="container">
                    <div class="row text-center text-md-start">
                        <!-- Left Column: Ayo Bantu -->
                        <div class="col-md-4 mb-4">
                            <h5 class="fw-bold mb-3">Ayo Bantu</h5>
                            <p class="mb-4" style="line-height: 1.6;">
                                Kami telah memiliki Izin Pengumpulan Uang dan Barang untuk Non Bencana di Kementerian Sosial 
                                Republik Indonesia dengan no surat izin 341/HUK-PS/2023.
                            </p>
                            <div class="d-flex justify-content-md-start justify-content-center gap-3">
                                <a href="https://facebook.com" target="_blank" class="text-light">
                                    <i class="bi bi-facebook fs-3"></i>
                                </a>
                                <a href="https://instagram.com" target="_blank" class="text-light">
                                    <i class="bi bi-instagram fs-3"></i>
                                </a>
                                <a href="https://youtube.com" target="_blank" class="text-light">
                                    <i class="bi bi-youtube fs-3"></i>
                                </a>
                            </div>
                        </div>

                        <!-- Right Column: Tentang -->
                        <div class="col-md-4 mb-4 ms-auto text-md-end text-center">
                            <h5 class="fw-bold mb-3">Tentang</h5>
                            <ul class="list-unstyled">
                                <li><a href="/about" class="text-light text-decoration-none">goBantu</a></li>
                                <li><a href="/terms" class="text-light text-decoration-none">Syarat & Ketentuan</a></li>
                                <li><a href="/contact" class="text-light text-decoration-none">Hubungi Kami</a></li>
                                <li><a href="/partners" class="text-light text-decoration-none">Partner Kami</a></li>
                                <li><a href="/faq" class="text-light text-decoration-none">FAQ</a></li>
                                <li><a href="/blog" class="text-light text-decoration-none">Blog</a></li>
                            </ul>
                        </div>
                        
                    </div>
                    <div class="text-center mt-4">
                        <p class="mb-0">&copy; Yayasan goBantu Peduli Indonesia 2024</p>
                    </div>
                </div>
            </footer>

            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
            {{-- @yield( 'script') --}}
        </div>
    </body>
</html>
