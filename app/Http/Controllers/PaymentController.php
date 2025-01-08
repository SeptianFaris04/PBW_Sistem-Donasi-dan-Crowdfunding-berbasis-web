<?php

namespace App\Http\Controllers;

use Response;
use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Donasi;
use App\Models\Payment;
use App\Models\UrunDana;
use Midtrans\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PaymentDonasiRequest;
use App\Http\Requests\PaymentUrunDanaRequest;

class PaymentController extends Controller
{
    // public function indexdonasi(Payment $payment){
    //     $hasildonasi = Donasi::find($payment->donasi_id);
    //     return view('donasi.komentar', compact('payment', 'hasildonasi'));
    // }

    // public function indexurundana(){
    //     $urundana = UrunDana::with(['category', 'user'])->get();
    //     return view('urundana.komentar', compact('urundana'));
    // }

    public function createdonasi($id) {
        $donasi = Donasi::findOrFail($id);

        return view('payment.donasi.create', compact('donasi'));
    }

    public function storedonasi(PaymentDonasiRequest $request, $id){
        $donasi = Donasi::findOrFail($id);

        $order_id = "DON-" . uniqid();

        $payment = new Payment([
            'user_id' => Auth::user()->id,
            'email' => $request->email,
            'name' => $request->name,
            'donasi_id' => $donasi->id,
            'pesan' => $request->pesan,
            'phone' => $request->phone,
            'amount' => $request->amount,
            'order_id' => $order_id,
            'status' => 'pending',
        ]);

        $payment->save();

        $donasi->increment('dana_terkumpul', $payment->amount);

        $userAlreadyDonated = Payment::where([
            ['donasi_id', $donasi->id],
            ['user_id', Auth::user()->id]
        ])->exists();

        if (!$userAlreadyDonated) {
            $donasi->jumlah_orang += 1;
            $donasi->save();
        }
        
        return redirect()->route('payment.donasi.check', [
            'donasi' => $donasi->id,
            'payment' => $payment->id,
        ]);
    }

    public function checkdonasi($donasiId, $paymentId){
        $donasi = Donasi::findOrFail($donasiId);
        $payment = Payment::findOrFail($paymentId);

        // Set your Merchant Server Key
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        // Set sanitization on (default)
        Config::$isSanitized = env('MIDTRANS_IS_SANITIZED', true);
        // Set 3DS transaction for credit card to true
        Config::$is3ds = env('MIDTRANS_IS_3DS', true);

        $transactionDetails = [
            'order_id' => $payment->order_id,
            'gross_amount' => $payment->amount
        ];

        $customerDetails = [
            'first_name' => $payment->name,
            'email' => Auth::user()->email,
            'phone' => $payment->phone
        ];

        $params = [
            'transaction_details' => $transactionDetails,
            'customer_details' => $customerDetails
        ];

        $snapToken = Snap::getSnapToken($params);

        return view('payment.donasi.check', compact('donasi', 'payment', 'snapToken'));
    }

    public function updateStatus(Request $request){
        $payment = Payment::find($request->payment_id);

        if($payment){
            $payment->status = $request->status;
            $payment->save();

            return response()->json(['success'=> true]);
        }
        return response()->json(['success' => false, 'message' => 'payment not found or miss'], 404);
    }

    
    public function createurundana($id) {
        $urundana = UrunDana::findOrFail($id);

        return view('payment.urundana.create', compact('urundana'));
    }

    public function storeurundana(PaymentUrunDanaRequest $request, $id){
        $urundana = UrunDana::findOrFail($id);

        $payment = new Payment([
            'user_id' => Auth::user()->id,
            'email' => $request->email,
            'name' => $request->name,
            'urundana_id' => $urundana->id,
            'pesan' => $request->pesan,
            'phone' => $request->phone,
            'amount' => $request->amount,
            'status' => 'pending',
        ]);

        $payment->save();

        return redirect()->route('payment.urundana.check', [
            'urundana' => $urundana->id,
            'payment' => $payment->id,
        ]);
    }

    public function checkurundana($urundanaId, $paymentId){
        $urundana = UrunDana::findOrFail($urundanaId);
        $payment = Payment::findOrFail($paymentId);

        // Set your Merchant Server Key
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        // Set sanitization on (default)
        Config::$isSanitized = env('MIDTRANS_IS_SANITIZED', true);
        // Set 3DS transaction for credit card to true
        Config::$is3ds = env('MIDTRANS_IS_3DS', true);

        $transactionDetails = [
            'order_id' => "URUNDANA-" . rand(),
            'gross_amount' => $payment['amount']
        ];

        $customerDetails = [
            'first_name' => $payment['name'],
            'email' => Auth::user()->email,
            'phone' => $payment['phone']
        ];

        $params = [
            'transaction_details' => $transactionDetails,
            'customer_details' => $customerDetails
        ];

        $snapToken = Snap::getSnapToken($params);

        return view('payment.urundana.check', compact('urundana', 'payment', 'snapToken'));
    }

//     public function callback(Request $request){
//         $serverKey = env('MIDTRANS_SERVER_KEY');
//         $signatureKey = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

//         if ($signatureKey != $request->signature_key) {
//             return response()->json(['message' => 'Invalid signature'], 403);
//         }

//         $payment = Payment::where('order_id', $request->order_id)->first();

//         if (!$payment) {
//             return response()->json(['message' => 'Transaksi tidak ditemukan'], 404);
//         }

//         // Perbarui status berdasarkan callback
//         if ($request->transaction_status == 'settlement') {
//             $payment->update(['status' => 'success']);
//             $payment->donasi->increment('dana_terkumpul', $payment->amount);
//         } elseif (in_array($request->transaction_status, ['cancel', 'expire', 'deny'])) {
//             $payment->update(['status' => 'failed']);
//         }

//         return response()->json(['message' => 'Callback diproses']);
//     }
}