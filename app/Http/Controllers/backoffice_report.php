<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class backoffice_report extends Controller
{
    public function index(Request $request)
    {
        if ($request->start == null && $request->end == null) {
            $transactions = Transaction::where('is_finish', 2)->orWhere('is_finish', 3)->orderBy('id', 'DESC')->get();
        } else {
            $transactions = Transaction::where([
                ['is_finish', '=', 2],
                ['created_at', '>=', $request->start],
                ['created_at', '<=', $request->end]
            ])->orWhere([
                ['is_finish', '=', 3],
                ['created_at', '>=', $request->start],
                ['created_at', '<=', $request->end]
            ])->orderBy('id', 'DESC')->get();
        }


        $data = [
            'menu' => 'Report',
            'sub_menu' => '',
            'transactions' => $transactions
        ];
        return view('backoffice_report.index')->with($data);
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
            'menu' => 'Report',
            'sub_menu' => '',
            'transaction' => $transaction
        ];

        return view('backoffice_report.detail')->with($data);
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
