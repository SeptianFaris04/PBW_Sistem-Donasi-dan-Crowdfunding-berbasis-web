<x-app-layout>
    {{-- <x-slot name="tittle">Dashboard</x-slot> --}}
    @slot('title', 'Home')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <style>
        .image{
            width: 381px;
            height: 220px;
        }
    </style>

    <main>
        <div id="carouselExampleControls" class="carousel slide fade-in" data-ride="carousel">
            <div id="myCarousel" class="carousel slide mb-6" data-bs-ride="carousel">
                <div class="carousel-indicators">
                  <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-label="Slide 1" aria-current="true"></button>
                  <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2" class=""></button>
                  <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3" class=""></button>
                </div>
                <div class="carousel-inner">
                  <div class="carousel-item carousel-item-next carousel-item-start">
                    <img class="d-block w-100" src="/images/home/header-1.png" alt="Gambar1">
                    <div class="container justify-center align-middle">
                      <div class="carousel-caption text-center">
                        <h1>Dana Anda Sangat Membantu</h1>
                        <p class="opacity-75">Bantu Mereka Yang Membutuhkan Dengan Berdonasi</p>
                        <p><a class="btn btn-lg btn-primary" href="/donasi">Donasi</a></p>
                      </div>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <img class="d-block w-100" src="/images/home/header-2.png" alt="Gambar2" />
                    <div class="container">
                      <div class="carousel-caption">
                        <h1>Dana Anda Sangat Membantu</h1>
                        <p>Sekecil apapun dana anda membantu kami</p>
                        <p><a class="btn btn-lg btn-primary" href="/urundana">Galang Dana</a></p>
                      </div>
                    </div>
                  </div>
                  <div class="carousel-item active carousel-item-start">
                    <img class=" image d-block w-100 h-50" src="/images/home/header-3.png" alt="Gambar3" />
                    <div class="container">
                      <div class="carousel-caption text-end">
                        <h1>Mari Saksikan Keseruannya!</h1>
                        <p>Murah Hemat & Meriah</p>
                        <p><a class="btn btn-lg btn-primary" href="/merchandise">Get Merchandise &raquo;</a></p>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
    
            {{-- <div class="content text-center fade-in mt-0">
                <button class="pushable" onclick="redirectDonasi()">
                    <span class="front">Mulai Donasi</span>
                </button>
            </div> --}}
    
            {{-- <script>
                function redirectDonasi() {
                    window.location.href = "/donasi";
                }
            </script> --}}
        </div>
        {{-- AKHIR SLIDE GAMBAR --}}
    
        {{-- konten kedua --}}
    <div class="container mt-5 ">
        <!-- Gray background container -->
        <div class="p-4 rounded" style="background-color: #e0e0e0;">
            <div class="row text-start mb-4">
                <div class="col-12">
                    <h2 class="fw-bold">Ayo Bantu Mereka Yang membutuhkan</h2>
                    <h3 class="text-secondary">Pilih Menu Kategori Anda</h3>
                </div>
            </div>
    
            <div class="grid grid-cols-3 justify-item-center">
                <!-- Donasi Column -->
                <div class="justify-content-center text-center">
                    <img class="bd-placeholder-img rounded-circle mb-3" width="140" height="140" src="images/item/donasi_1.jpg" alt="Donasi">
                    <h2 class="fw-normal">Donasi</h2>
                    <p>Mari Bantu Donasi</p>
                    <p><a class="btn btn-success px-4" href="/donasi">Donasi &raquo;</a></p>
                </div>
    
                <!-- Zakat Column -->
                <div class="col-auto text-center">
                    <img class="bd-placeholder-img rounded-circle mb-3" width="140" height="140" src="images/item/galang_dana.png" alt="Galang Dana">
                    <h2 class="fw-normal">Zakat</h2>
                    <p>Mari Galang Dana</p>
                    <p><a class="btn btn-success px-4" href="/urundana">Galang Dana &raquo;</a></p>
                </div>
    
                <!-- Merchandise Column -->
                <div class="col-auto text-center">
                    <img class="bd-placeholder-img rounded-circle mb-3" width="140" height="140" src="images/item/merchandise.jpg" alt="Merchandise">
                    <h2 class="fw-normal">Merchandise</h2>
                    <p>Mari Berbelanja</p>
                    <p><a class="btn btn-success px-4" href="/merchandise">Shop &raquo;</a></p>
                </div>
            </div>
        </div>
    </div>

  {{-- konten ketiga card --}}
<h1 class="text-center mt-2 mb-3 font-bold">Mari Bantu Saudara Kita</h1>
<div class="grid grid-cols-2 gap-3 container mt-5">
  @foreach ($donasis as $donasi)
  <div class="card h-100 rounded-4 bg-light border-0">
    <img src="{{ asset('Storage/' . $donasi->foto) }}" class="card-img-top rounded-4 p-2" alt="{{ $donasi->name }}">
    <div class="card-body">
      <h5 class="card-title text-center fw-bold">{{ $donasi->name }}</h5>
      <h6 class="card-description fw-bold">{{ Str::limit($donasi->description, 260) }}</h6>
      <p class="text-secondary mb-2">{{ number_format($donasi->jumlah_orang, 0) }} Orang Telah Berdonasi</p>
      <div class="d-flex justify-content-between align-items-center mb-3">
        <span class="fw-bold">Rp. {{ number_format($donasi->dana_terkumpul, 2, ',', '.') }}</span>
        <span class="text-secondary">Target Dana Rp. {{ number_format($donasi->jumlah_target_dana, 2, ',', '.') }}</span>
      </div>
      <button class="btn btn-outline-success w-100 rounded-pill border">Donasi</button>
    </div>
  </div>
  @endforeach
</div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    </main>
</x-app-layout>
