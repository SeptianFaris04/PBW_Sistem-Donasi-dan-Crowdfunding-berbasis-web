<x-app-layout>
    @slot('title', 'Create Donasi')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Create A Donasi
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
                    <x-card.title>Create A Donate</x-card.tittle>
                    <x-card.description>Membuat Sebuah Donasi Baru</x-card.description>
                    <x-card.content>
                        <form action="{{ $page_meta['url'] }}" method="POST" enctype="multipart/form-data" class="[&>div]:mb-6">
                            @csrf
                            <div>
                                <x-input-label for="image_donasi" :value="__('foto')" />
                                <input name="foto" id="image_donasi" type="file" required />
                                <x-input-error :messages="$errors->get('foto')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" class="block mt-1" type="text" name="name" :value="old('name')" required autofocus />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="description" :value="__('Description')" />
                                <x-text-area id="description" class="block mt-1" name="description" required autofocus>{{ old('description') }}</x-text-area>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="dana_terkumpul" :value="__('Jumlah Batas Maksimal Dana')" />
                                <input type="number" id="dana_terkumpul" class="block mt-1" name="jumlah_target_dana" required autofocus>{{ old('jumlah_target_dana') }}</input>
                                <x-input-error :messages="$errors->get('jumlah_target_dana')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="Tanggal_Batas" :value="__('Tanggal Batas Donasi')" />
                                <input type="date" id="Tanggal_Batas" class="block mt-1" name="tanggal_batas_donasi" required autofocus>{{ old('Tanggal_Batas_Donasi') }}</input>
                                <x-input-error :messages="$errors->get('Tanggal_Batas_Donasi')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label>Kategori Donasi</x-input-label>
                                <select name="category_id" required>
                                    <option value="">Pilih Kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <x-primary-button>
                                Create
                            </x-primary-button>
                        </form>
                    </x-card.content>
                </x-card.header>
            </x-card>
        </x-maincontainer>
    </div>
</x-app-layout> 