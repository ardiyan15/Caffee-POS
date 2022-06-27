<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class backoffice_order extends Controller
{
    protected $menu = 'Order';
    public function index()
    {
        if (Auth::user()->roles == 'driver') {
            $orders = Transaction::where([
                ['is_finish', '=', 0],
                ['status_order', '!=', 'pending']
            ])->orderBy('id', 'DESC')->get();
        } else {
            $orders = Transaction::orderBy('id', 'DESC')->get();
        }

        $data = [
            'menu' => $this->menu,
            'sub_menu' => '',
            'orders' => $orders
        ];

        return view('backoffice_order.index')->with($data);
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
        $transaction = Transaction::with(['transaction_details' => function ($transaction_details) {
            $transaction_details->with('products');
        }])->withSum('transaction_details', 'total_price')->findOrFail($id);

        $data = [
            'menu' => $this->menu,
            'sub_menu' => '',
            'transaction' => $transaction
        ];

        return view('backoffice_order.detail')->with($data);
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

    public function get_order_transaction(Request $request)
    {
        $transactions = Transaction::with(['transaction_details' => function ($transaction_details) {
            $transaction_details->with('products');
        }])->findOrFail($request->id);

        if ($transactions != null) {
            return response()->json([
                'status' => 200,
                'message' => 'success',
                'data' => $transactions
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'mesasge' => 'failed to get data'
            ]);
        }
    }
}
