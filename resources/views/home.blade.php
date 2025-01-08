<x-app-layout>
    @slot('title', 'Home')
    <x-slot name="header">
        <h2
            class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
        >
            {{ __('Home') }}
        </h2>
    </x-slot>

    <main>
        <!-- Carousel Section -->
        <div
            id="carouselExampleControls"
            class="container carousel slide fade-in"
            data-bs-ride="carousel"
        >
            <div
                id="myCarousel"
                class="carousel slide mb-6"
                data-bs-ride="carousel"
            >
                <div class="carousel-indicators">
                    <button
                        type="button"
                        data-bs-target="#myCarousel"
                        data-bs-slide-to="0"
                        class="active"
                        aria-label="Slide 1"
                    ></button>
                    <button
                        type="button"
                        data-bs-target="#myCarousel"
                        data-bs-slide-to="1"
                        aria-label="Slide 2"
                    ></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img
                            class="d-block w-100"
                            src="/images/home/header-1.png"
                            alt="Gambar1"
                        />
                        <div class="container content-center">
                            <div class="carousel-caption">
                                <h1>Dana Anda Sangat Membantu</h1>
                                <p>
                                    Bantu Mereka Yang Membutuhkan Dengan
                                    Berdonasi
                                </p>
                                <p>
                                    <a
                                        class="btn btn-lg btn-primary"
                                        href="/donasi"
                                        >Donasi</a
                                    >
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img
                            class="d-block w-100"
                            src="/images/home/header-2.png"
                            alt="Gambar2"
                        />
                        <div class="container content-center">
                            <div class="carousel-caption">
                                <h1>Dana Anda Sangat Membantu</h1>
                                <p>Sekecil apapun dana anda membantu kami</p>
                                <p>
                                    <a
                                        class="btn btn-lg btn-primary"
                                        href="/urundana"
                                        >Galang Dana</a
                                    >
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
              <!-- Navigation Buttons -->
              <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

       <!-- Content Section -->
       <div class="container mt-5 content-wrapper">
            <div>
                <!-- Header -->
                <div class="text-start mb-4">
                    <h2 class="fw-bold">Ayo Bantu Mereka Yang Membutuhkan</h2>
                    <h3 class="text-secondary">Pilih Menu Kategori Anda</h3>
                </div>
                <!-- Grid Content -->
                <div class="row align-items-center">
                <!-- Donasi Sekarang -->
                <div class="col-md-6 mb-4">
                    <div class="border rounded p-4 shadow-sm d-flex align-items-center">
                        <img class="rounded-circle me-4" width="140" height="140" src="images/item/donasi_1.jpg" alt="Donasi">
                        <div>
                            <h5 class="fw-bold">Masih ingin berdonasi lebih banyak untuk mereka</h5>
                            <a href="/donasi" class="btn btn-outline-danger mt-3">
                                <i class="bi bi-wallet2 me-2"></i> Donasi Sekarang
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Galang Dana -->
                <div class="col-md-6 mb-4">
                    <div class="border rounded p-4 shadow-sm d-flex align-items-center">
                        <img class="rounded-circle me-4" width="140" height="140" src="images/item/galang_dana.png" alt="Galang Dana">
                        <div>
                            <h5 class="fw-bold">#AyoBantu galang dana bagi mereka yang membutuhkan</h5>
                            <a href="/urundana" class="btn btn-outline-danger mt-3">
                                <i class="bi bi-heart-fill me-2"></i> Galang Dana
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Section -->
        <h1 class="text-center mt-2 mb-3 font-bold">Mari Bantu Saudara Kita</h1>
        <div class="grid grid-cols-3 gap-3 container mt-5">
            @foreach ($donasis as $donasi)
            <div class="card h-100 rounded-4 bg-light border-0">
                <img
                    src="{{ asset('Storage/' . $donasi->foto) }}"
                    class="card-img-top rounded-4 p-2"
                    alt="{{ $donasi->name }}"
                />
                <div class="card-body">
                    <h5 class="card-title text-center fw-bold">
                        {{ $donasi->name }}
                    </h5>
                    <h6 class="card-description fw-bold">
                        {{ Str::limit($donasi->description, 260) }}
                    </h6>
                    <p class="text-secondary mb-2">
                        {{ number_format($donasi->jumlah_orang, 0) }} Orang
                        Telah Berdonasi
                    </p>
                    <div
                        class="d-flex justify-content-between align-items-center mb-3"
                    >
                        <span class="fw-bold"
                            >Rp. {{ number_format($donasi->dana_terkumpul, 2,
                            ',', '.') }}</span
                        >
                        <span class="text-secondary"
                            >Target Dana Rp. {{
                            number_format($donasi->jumlah_target_dana, 2, ',',
                            '.') }}</span
                        >
                    </div>
                    @php $persentase = ($donasi->dana_terkumpul /
                    $donasi->jumlah_target_dana) * 100; @endphp
                    <div
                        class="progress my-3"
                        role="progressbar"
                        aria-label="Animated striped example"
                        aria-valuenow="{{ $persentase }}"
                        aria-valuemin="0"
                        aria-valuemax="100"
                    >
                        <div
                            class="progress-bar progress-bar-striped progress-bar-animated"
                            style="width: {{ $persentase }}%"
                        ></div>
                    </div>
                    <button
                        class="btn btn-outline-success w-100 rounded-pill border"
                    >
                        Donasi
                    </button>
                </div>
            </div>
            @endforeach
        </div>

        <div class="block my-4 d-flex justify-content-center">
            {{ $donasis->links() }}
        </div>
 
        <!-- Keunggulan Section -->
 <div class="container mt-5">
            <div class="row text-center">
                <!-- Card 1: Bantu -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="p-4">
                        <div class="mb-3 text-danger">
                            <i class="bi bi-heart-fill fs-1"></i>
                        </div>
                        <h5 class="fw-bold">Bantu</h5>
                        <p>#AyoBantu sesama yang membutuhkan</p>
                    </div>
                </div>
                <!-- Card 2: Praktis -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="p-4">
                        <div class="mb-3 text-danger">
                            <i class="bi bi-phone-fill fs-1"></i>
                        </div>
                        <h5 class="fw-bold">Praktis</h5>
                        <p>Bantu sesama dari mana pun, cukup gunakan HP kita</p>
                    </div>
                </div>
                <!-- Card 3: Tepat Sasaran -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="p-4">
                        <div class="mb-3 text-danger">
                            <i class="bi bi-bullseye fs-1"></i>
                        </div>
                        <h5 class="fw-bold">Tepat Sasaran</h5>
                        <p>Program penggalangan dana di AyoBantu dapat dipertanggungjawabkan kebenarannya</p>
                    </div>
                </div>
                <!-- Card 4: Transparan -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="p-4">
                        <div class="mb-3 text-danger">
                            <i class="bi bi-search fs-1"></i>
                        </div>
                        <h5 class="fw-bold">Transparan</h5>
                        <p>Penyaluran dana dilakukan secara transparan</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
            crossorigin="anonymous"
        ></script>
    </main>
</x-app-layout>
