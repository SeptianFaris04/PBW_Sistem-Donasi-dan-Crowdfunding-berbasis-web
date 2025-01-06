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

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-xl font-bold mb-4">Detail Donasi</h3>
                    <p><strong>Nama Donasi:</strong> {{ $donasi->name }}</p>
                    <p><strong>Jumlah Donasi:</strong> Rp{{ number_format($payment->amount, 0, ',', '.') }}</p>
                    <p><strong>Status Pembayaran:</strong> {{ $payment->status }}</p>
                    <p><strong>Pesan:</strong> {{ $payment->pesan }}</p>
                </div>
                <x-primary-button id="pay-button" class="mt-4">
                    Bayar Sekarang
                </x-primary-button>
            </div>
   <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="env('MIDTRANS_CLIENT_KEY')"></script>
    <script type="text/javascript">
      document.getElementById('pay-button').onclick = function(){
        // SnapToken acquired from previous step
        snap.pay('{{ $snapToken }}', {
          // Optional
          onSuccess: function(result){
            /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
          },
          // Optional
          onPending: function(result){
            /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
          },
          // Optional
          onError: function(result){
            /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
          }
        });
      };
    </script>
</x-app-layout> 