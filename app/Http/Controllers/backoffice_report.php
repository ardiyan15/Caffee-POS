<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class backoffice_report extends Controller
{
    public function index()
    {
        $data = [
            'menu' => '',
            'sub_menu' => '',
            'transactions' => Transaction::where('is_finish', 2)->orWhere('is_finish', 3)->orderBy('id', 'DESC')->get()
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
            'menu' => '',
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
