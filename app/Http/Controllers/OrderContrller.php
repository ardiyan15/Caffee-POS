<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderContrller extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;
        $results = DB::select("SELECT transactions.*, transactions.id AS transaction_id, transaction_details.id AS detail_id , products.*, transaction_details.* FROM transactions JOIN transaction_details ON transactions.id = transaction_details.transaction_id JOIN products ON products.id = transaction_details.product_id WHERE transactions.created_by = $user_id AND transactions.is_finish = 0 OR transactions.is_finish = 1 ORDER BY transactions.id DESC");

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
