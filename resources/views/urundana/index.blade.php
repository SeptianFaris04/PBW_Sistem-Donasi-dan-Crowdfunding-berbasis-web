<x-app-layout>
    {{-- <x-slot name="tittle">Dashboard</x-slot> --}}
    @slot('title', 'Galang Dana')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Galang Dana') }}
        </h2></x-slot>

    <main>
        @foreach ($urundanas as $urundana)
        <article class="h-full p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
            <div class="flex justify-between items-center mb-5 text-gray-500">
                <span class="bg-{{ $urundana->category->color ?? 'gray' }}-100 text-primary-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-primary-200 dark:text-primary-800">
                    <a class="hover:underline" href="/urundana?category={{ $urundana->category->slug_categories }}">
                        {{ $urundana->category->name ?? 'Tanpa Kategori' }}
                    </a>
                </span> 
                <span class="text-sm">{{ (new \Carbon\Carbon ($urundana->tanggal_batas_urundana))->format('d F Y') }}</span>
            </div>
            <div class="block">
                @if ($urundana->foto)
                    <img src="{{ Storage::url($urundana->foto) }}" alt="{{ $urundana->name }}" class="w-full h-48 object-cover rounded-md">
                @endif
            </div>
            <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                <a class="hover:underline" href="/urundana/{{ $urundana->slug_urundana }}">{{ $urundana->name }}</a>
            </h2>
            <p class="mb-5 font-light text-gray-500 dark:text-gray-400">{{ Str::limit($urundana->description, 150) }}</p>
            <div class="flex justify-between items-center mt-auto">
                <div class="flex items-center space-x-4">
                    <a class="hover:underline" href="/users/{{ $urundana->user->username }}">
                        <span class="font-medium text-xs dark:text-white">{{ $urundana->user->name }}</span>
                    </a>
                </div>
                @auth
                    @if ($urundana->user_id === auth()->user()->id)
                        <a href="{{ Route('urundana.edit', $urundana) }}" class="underline text-blue-600">Edit</a>
                    @endif
                @endauth
                <a href="/urundana/{{ $urundana->slug_urundana }}" class="inline-flex font-medium text-primary-600 dark:text-primary-500 hover:underline">
                    Read more &raquo;
                </a>
            </div>
        </article>        
        @endforeach
    
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