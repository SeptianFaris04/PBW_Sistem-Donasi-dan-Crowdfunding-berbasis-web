<x-app-layout>
    {{-- <x-slot name="tittle">Dashboard</x-slot> --}}
    @slot('title', 'Donasi')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Donasi') }}
        </h2></x-slot>

    <main>
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

        @if (session('success'))
            <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800">
                {{ session('success') }}
            </div>
        @endif
    
        <style>
            /* ANIMASI */
            #animated-card {
                animation: scrollUp 1s ease-in-out forwards;
                box-shadow: 0 4px 30px rgba(0, 0, 0, 0.096), 0 6px 30px rgba(0, 0, 0, 0.096);
            }
    
            @keyframes scrollUp {
                0% {
                    transform: translateY(10px);
                    opacity: 0;
                }
    
                100% {
                    transform: translateY(0);
                    opacity: 1;
                }
            }
    
            .fa-circle-check {
                font-size: 0.9em;
                margin-right: 0.4em;
            }
    
            .card-title {
                font-weight: bold;
                font-size: 25px;
                margin-bottom: 0%;
            }
    
            #total-donatur {
                margin-bottom: 30px;
            }
    
            #total-kumpul {
                font-size: 20px;
                font-weight: bold;
                color: #007bff;
                margin-bottom: -0.3%;
            }
    
            #total-jumlah {
                font-size: 15px;/
            }
    
            #total-jumlah strong {
                font-weight: 600;
            }
    
            .progress {
                margin-top: 1rem;
                margin-bottom: 0.2rem;
                border-radius: 20px;
                height: 5px;
            }
    
            .progress-bar {
                /* background-color: #007bff; */
                border-radius: 20px;
                animation: animateProgressBar 2s ease-out;
                background: -webkit-linear-gradient(left, #4df3ff 0%, #007bff 100%);
            }
    
            .pushable {
                margin-top: 0.2rem;
                position: relative;
                background: transparent;
                padding: 0px;
                border: none;
                cursor: pointer;
                outline-offset: 4px;
                outline-color: deeppink;
                transition: filter 250ms;
                -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
            }
    
            .edge {
                position: absolute;
                top: 0;
                left: 0;
                height: 100%;
                width: 100%;
                border-radius: 12px;
                background: #073abb;
            }
    
            .front {
                display: block;
                position: relative;
                border-radius: 12px;
                background: #007bff;
                padding: 12px 32px;
                color: white;
                font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 1.5px;
                font-size: 1rem;
                transform: translateY(-4px);
                transition: transform 600ms cubic-bezier(0.3, 0.7, 0.4, 1);
            }
    
            .pushable:hover {
                filter: brightness(110%);
            }
    
            .pushable:hover .front {
                transform: translateY(-6px);
                transition: transform 250ms cubic-bezier(0.3, 0.7, 0.4, 1.5);
            }
    
            .pushable:active .front {
                transform: translateY(-2px);
                transition: transform 34ms;
            }
    
            .pushable:hover .shadow {
                transform: translateY(4px);
                transition: transform 250ms cubic-bezier(0.3, 0.7, 0.4, 1.5);
            }
    
            .pushable:active .shadow {
                transform: translateY(1px);
                transition: transform 34ms;
            }
    
            .pushable:focus:not(:focus-visible) {
                outline: none;
            }
        </style>
    </main>
</x-app-layout>