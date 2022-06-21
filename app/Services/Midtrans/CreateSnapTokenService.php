<?php

namespace App\Services\Midtrans;

use Midtrans\Snap;

class CreateSnapTokenService extends Midtrans
{
    protected $order;

    public function __construct($order)
    {
        parent::__construct();
        $this->order = $order;
    }

    public function getSnapToken()
    {
        $params = [
            'transaction_details' => [
                'order_id' => $this->order->number,
                'gross_amount' => $this->order->total_price
            ],
            'item_details' => [
                [
                    'id' => 1,
                    'price' => '15000',
                    'quantity' => 1,
                    'name' => 'Flashdisk 32GB'
                ],
                [
                    'id' => 2,
                    'price' => '15000',
                    'quantity' => 1,
                    'name' => 'Memory Card 32GB'
                ]
            ],
            'customer_details' => [
                'first_name' => 'Ardiyan Agus',
                'email' => 'ardiyan@email.com',
                'phone' => '081293812932'
            ]
        ];

        $snapToken = Snap::getSnapToken($params);

        return $snapToken;
    }
}
