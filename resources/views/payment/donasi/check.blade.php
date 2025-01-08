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
    document.getElementById('pay-button').onclick = function() {
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                // Update status pembayaran menjadi success
                fetch('{{ route("payment.updateStatus") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        payment_id: '{{ $payment->id }}',
                        status: 'success'
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Redirect ke halaman donasi dengan slug dan tampilkan komentar
                        window.location.href = '{{ route("donasi.show", ["donasi" => $donasi->slug_donasis]) }}';
                    }
                });
            },
            onPending: function(result) {
                alert('Pembayaran Anda sedang diproses. Silakan tunggu beberapa saat.');
                location.reload(); // Muat ulang halaman
            },
            onError: function(result) {
                alert('Terjadi kesalahan dalam proses pembayaran. Silakan coba lagi.');
                location.reload(); // Muat ulang halaman
            }
        });
        return false;
    };
</script>
</x-app-layout> 