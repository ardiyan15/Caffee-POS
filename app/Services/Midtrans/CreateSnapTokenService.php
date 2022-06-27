<?php

namespace App\Services\Midtrans;

use Midtrans\Snap;
use Illuminate\Support\Facades\Auth;

class CreateSnapTokenService extends Midtrans
{
    protected $transaction;
    protected $item_details;

    public function __construct($transaction)
    {
        parent::__construct();
        $this->transaction = $transaction;
        $this->item_details = [];
    }

    public function getSnapToken()
    {
        foreach ($this->transaction->transaction_details as $detail) {
            $this->item_details['id'] = rand();
            $this->item_details['price'] = $detail->total_price;
            $this->item_details['quantity'] = $detail->qty;
            $this->item_details['name'] = $detail->products->name;
            $this->item_details['transaction_id'] = $detail->transaction->id;
        }

        // $params = [
        //     'transaction_details' => array(
        //         // 'order_id' => rand(),
        //         'order_id' => $this->transaction->nomor_transaksi,
        //         'gross_amount' => $this->transaction->transaction_details_sum_total_price,
        //     ),
        //     "item_details" => array($this->item_details),
        //     'customer_details' => array(
        //         'first_name' => Auth::user()->username,
        //         'last_name' => Auth::user()->username,
        //         'email' => Auth::user()->email,
        //         'phone' => Auth::user()->no_telepon,
        //     ),
        // ];

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => 10000,
            ),
            'customer_details' => array(
                'first_name' => 'budi',
                'last_name' => 'pratama',
                'email' => 'budi.pra@example.com',
                'phone' => '08111222333',
            ),
        );

        $snapToken = Snap::getSnapToken($params);

        return $snapToken;
    }
}
