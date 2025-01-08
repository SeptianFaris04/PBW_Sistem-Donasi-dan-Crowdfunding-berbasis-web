<x-app-layout>
    @slot('title', 'Donasi')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Donasi') }}
        </h2>
    </x-slot>

    <main>
        <h1 class="text-center mt-2 mb-3 font-bold">Mari Bantu Saudara Kita</h1>
        <!-- Grid Layout -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 container mx-auto mt-5">
            @foreach ($donasis as $donasi)
            <article class="h-full p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                <div class="flex justify-between items-center mb-5 text-gray-500">
                    <span class="bg-{{ $donasi->category->color ?? 'gray' }}-100 text-primary-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-primary-200 dark:text-primary-800">
                        <a class="hover:underline" href="/donasi?category={{ $donasi->category->slug_categories }}">
                            {{ $donasi->category->name ?? 'Tanpa Kategori' }}
                        </a>
                    </span> 
                    <span class="text-sm">{{ (new \Carbon\Carbon ($donasi->tanggal_batas_donasi))->format('d F Y') }}</span>
                </div>
                <div class="block">
                    @if ($donasi->foto)
                        <img src="{{ asset('Storage/' . $donasi->foto) }}" alt="{{ $donasi->name }}" class="w-full h-48 object-cover rounded-md">
                    @endif
                </div>
                <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    <a class="hover:underline" href="/donasi/{{ $donasi->slug_donasis }}">{{ $donasi->name }}</a>
                </h2>
                <p class="mb-5 font-light text-gray-500 dark:text-gray-400">{{ Str::limit($donasi->description, 150) }}</p>

                {{-- Progress Bar --}}
                @php 
                    $persentase = ($donasi->dana_terkumpul / $donasi->jumlah_target_dana) * 100; 
                @endphp
                <div class="progress my-3 bg-light rounded-full h-2">
                    <div
                        class="progress-bar progress-bar-striped progress-bar-animated"
                        style="width: {{ $persentase }}%"
                    ></div>
                </div>
                <p class="text-gray-500 text-sm mt-2">
                    Rp. {{ number_format($donasi->dana_terkumpul, 0, ',', '.') }} dari Rp. {{ number_format($donasi->jumlah_target_dana, 0, ',', '.') }}
                </p>
                
                <div class="flex justify-end text-end mb-4">
                    <a class="bg-primary-500 text-white border rounded-md p-2" href="/payment/donasi/create/{{ $donasi->id }}">Donate {{ $donasi->name }}</a>
                </div>
                <div class="flex justify-between items-center mt-auto">
                    <div class="flex items-center space-x-4">
                        <a class="hover:underline" href="/users/{{ $donasi->user->username }}">
                            <span class="font-medium text-xs dark:text-white">{{ $donasi->user->name }}</span>
                        </a>
                    </div>
                    @auth
                        @if ($donasi->user_id === auth()->user()->id)
                            <a href="{{ Route('donasi.edit', $donasi) }}" class="bg-primary-800 p-2 border rounded-md text-white hover:underline">Edit</a>
                            <form action="{{ Route('donasi.destroy', $donasi->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 p-2 border rounded-md text-white hover:underline" onclick="return confirm('Apakah Anda yakin ingin menghapus donasi ini?')">
                                    Hapus
                                </button>
                            </form>
                        @endif
                    @endauth
                </div>
            </article>
            @endforeach
        </div>

        @if (session('success'))
            <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800">
                {{ session('success') }}
            </div>
        @endif
    </main>
</x-app-layout>
