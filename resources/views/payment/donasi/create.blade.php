<x-app-layout>
    @slot('title', 'Pembayaran Donasi')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Add Pembayaran Donasi
        </h2>
    </x-slot>

    {{-- $table->text('description');
            $table->unsignedBigInteger('jumlah_orang');
            $table->unsignedBigInteger('dana_terkumpul');
            $table->unsignedBigInteger('jumlah_target_dana');
            $table->dateTime('Tanggal_Batas_Donasi'); --}}

    <div class="justify-content-center align-middle"> {{--gk mau pindah tengah --}}
        <x-maincontainer class="max-w-2xl">
            <x-card class="hover:bg-red-400 max-w-2xl">
                <x-card.header>
                    <x-card.title>Create Pembayaran Donate</x-card.tittle>
                    <x-card.description>Mendonasikan Dana</x-card.description>
                    <x-card.content>
                        <form action="{{ Route('payment.storedonasi', ['donasi' => $donasi->id]) }}" method="POST" enctype="multipart/form-data" class="[&>div]:mb-6">
                            @csrf
                            <img src="{{ asset('Storage/' . $donasi->foto) }}" alt="{{ $donasi->name }}">
                            <legend>Donation</legend>
                            <strong>Isi Data Donasi</strong>
                                <div class="row">
                                    <input type="hidden" name="donasi_id" value="{{ $donasi->id }}">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Nama</label>
                                            <input type="text" name="name" class="form-control" id="name" required>
                                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">E-Mail</label>
                                            <input type="email" name="email" class="form-control" id="email" required>
                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="amount">Jumlah Dana Keuangan</label>
                                            <input type="number" name="amount" class="form-control" id="amount" required>
                                            <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone">Nomor Telephone</label>
                                            <input type="number" name="phone" id="phone" class="form-control" required>
                                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="form-group">
                                            <label for="pesan">Pesan</label>
                                            <textarea name="pesan" cols="30" rows="3" class="form-control" id="pesan" required></textarea>
                                            <x-input-error :messages="$errors->get('pesan')" class="mt-2" />
                                        </div>
                                    </div>
                                </div>
                                <x-primary-button>
                                    Selanjutnya
                                </x-primary-button>
                        </form>
                    </x-card.content>
                </x-card.header>
            </x-card>
        </x-maincontainer>
    </div>
</x-app-layout> 