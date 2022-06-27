<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Services\Midtrans\CreateSnapTokenService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderContrller extends Controller
{
    public function index()
    {
        $results = Transaction::with(['transaction_details' => function ($transaction) {
            $transaction->with('products');
        }])->withSum('transaction_details', 'total_price')->where([
            ['created_by', '=', Auth::user()->id],
            ['is_finish', '=', 0]
        ])->orWhere([
            ['created_by', '=', Auth::user()->id],
            ['is_finish', '=', 1]
        ])->orderBy('id', 'DESC')->get();

        foreach ($results as $result) {
            if ($result->snap_token == null) {
                $midtrans = new CreateSnapTokenService($result);
                $snap_token = $midtrans->getSnapToken();
                $result->snap_token = $snap_token;
                $result->save();
            }
        }

        $data = [
            'orders' => $results
        ];

        return view('orders.index')->with($data);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
