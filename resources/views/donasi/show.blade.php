<x-app-layout>
    @slot('title', 'Home')
    <x-slot name="header">
        @if ($donasi)
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $donasi->name }}
            </h2>
        @else
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Data tidak ditemukan
            </h2>
        @endif
    </x-slot>
  
    <main>
        <div class="container py-4">
            @if ($donasi)
                <div class="row">
                    <!-- Bagian kiri (Gambar dan deskripsi) -->
                    <div class="col-md-8">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                                <li class="breadcrumb-item"><a href="/donasi">Donasi</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $donasi->name }}</li>
                            </ul>
                        </nav>
                        <h1 class="fw-bold">{{ $donasi->name }}</h1>
                        <img src="{{ asset('Storage/' . $donasi->foto) }}" class="img-fluid rounded mb-3" alt="{{ $donasi->name }}">
                    </div>
            
                    <!-- Bagian kanan (Informasi donasi) -->
                    <div class="col-md-4">
                        <div class="card p-3 shadow-sm">
                            <h6>Dana terkumpul</h6>
                            <h3 class="fw-bold text-success">Rp 140.000</h3>
                            <p>dari target ∞ tidak terbatas</p>
                            <div class="progress mb-3" style="height: 10px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>4 Donasi</span>
                                <span>1 Bagikan</span>
                                <span>3 hari lagi</span>
                            </div>
                            <button class="btn btn-primary btn-block mt-3">Donasi 🤝</button>
                            <button class="btn btn-outline-secondary btn-block mt-2">Bagikan 🔗</button>
                        </div>
                        <div class="mt-4">
                            <p><strong>ASAR Humanity</strong></p>
                            <a href="#" class="text-primary">Rincian Penggunaan Dana</a>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#kisah" data-bs-toggle="tab">Deskripsi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#donatur" data-bs-toggle="tab">Komentar Donatur</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <!-- Kisah Tab -->
                                <div class="tab-pane fade show active" id="kisah">
                                   <h1 class="bg-red-500">{{ $donasi->name }}</h1>
                                    <p>{{ $donasi->description }}</p>
                                </div>
                                <!-- Berita Tab -->
                                <div class="tab-pane fade" id="berita">
                                    <p>Tidak ada berita saat ini.</p>
                                </div>
                                <!-- Donatur Tab -->
                                <div class="tab-pane fade" id="donatur">
                                    @if ($payment->count())
                                        @foreach ($payment as $pay)
                                            <h5 class="text-gray-600 mb-2">{{ $pay->name }} | {{ $pay->created_at->diffForHumans() }}</h5>
                                            <h5 class="text-black mb-2">Rp. {{ $pay->amount }}</h5>
                                            <p class="text-black mb-2">Pesan: {{ $pay->pesan }}</p>
                                        @endforeach
                                    @else
                                        <p>Tidak ada donasi saat ini.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center py-5">
                    <h3>Data tidak ditemukan</h3>
                    <a href="{{ route('donasi.index') }}" class="btn btn-primary">Kembali ke daftar donasi</a>
                </div>
            @endif
        </div>
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
    </main>
</x-app-layout>
