<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Services\Midtrans\CallbackService;

class PaymentCallbackController extends Controller
{
    public function receive()
    {
        $callback = new CallbackService;
        return response()->json([
            'data' => $callback->isSignatureKeyVerified()
        ]);

        // if ($callback->isSignatureKeyVerified()) {
        //     $notification = $callback->getNotification();
        //     $transaction = $callback->getOrder();

        //     if ($callback->isSuccess()) {
        //         Transaction::where('id', $transaction->id)->update(['is_finish' => 2]);
        //     }

        //     if ($callback->isExpire()) {
        //         Transaction::where('id', $transaction->id)->update(['is_finish' => 4]);
        //     }

        //     if ($callback->isCancelled()) {
        //         Transaction::where('id', $transaction->id)->update(['is_finish' => 3, 'status_order' => 'pesanan dibatalkan oleh customer']);
        //     }

        //     return response()->json([
        //         'success' => true,
        //         'message' => 'Notifikasi berhasil diproses'
        //     ], 200);
        // } else {
        //     return response()->json([
        //         'error' => true,
        //         'message' => 'Signature key tidak terverifikasi'
        //     ], 403);
        // }
    }
}
