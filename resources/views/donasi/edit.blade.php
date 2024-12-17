<x-app-layout>
    @slot('title', 'Edit Donasi')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit A Donasi
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
                    <x-card.title>Edit Donasi: {{ $donasi->name }}</x-card.tittle>
                    <x-card.description>Mengubah Data Donasi</x-card.description>
                    <x-card.content>
                        <form action="{{ route('donasi.update', $donasi) }}" method="POST" enctype="multipart/form-data" class="[&>div]:mb-6">
                            @method('PUT')
                            @csrf
                            <div>
                                <x-input-label for="image_donasi" :value="__('foto')" />
                                <input name="foto" id="image_donasi" type="file" />
                                @if($donasi->foto)
                                    <img src="{{ Storage::url($donasi->foto) }}" alt="Foto Donasi" class="mt-2" width="200">
                                @endif
                                <x-input-error :messages="$errors->get('foto')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" class="block mt-1" type="text" name="name" value="{{ old('name', $donasi->name) }}" required autofocus />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="description" :value="__('Description')" />
                                <textarea id="description" class="block mt-1" name="description" required autofocus>{{ old('description', $donasi->description) }}</textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="jumlah_target_dana" :value="__('Jumlah Batas Maksimal Dana')" />
                                <input type="number" id="jumlah_target_dana" class="block mt-1" name="jumlah_target_dana" value="{{ old('jumlah_target_dana', $donasi->jumlah_target_dana) }}" required autofocus>
                                <x-input-error :messages="$errors->get('jumlah_target_dana')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="Tanggal_Batas" :value="__('Tanggal Batas Donasi')" />
                                <input type="date" id="Tanggal_Batas" class="block mt-1" name="tanggal_batas_donasi" :value="{{ old('tanggal_batas_donasi', $donasi->tanggal_batas_donasi) }}" required autofocus>
                                <x-input-error :messages="$errors->get('tanggal_batas_donasi')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label>Kategori Donasi</x-input-label>
                                <select name="category_id" required>
                                    <option value="{{ $donasi->category->id }}" selected>{{ $donasi->Category->name }}</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $category->id === $donasi->category_id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <x-primary-button>
                                Update
                            </x-primary-button>
                        </form>                        
                    </x-card.content>
                </x-card.header>
            </x-card>
        </x-maincontainer>
    </div>
</x-app-layout> 