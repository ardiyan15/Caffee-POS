<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Transaction;
use App\Models\Transaction_details;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $products = Products::orderBy('id', 'DESC')->get();
        $data = [
            'products' => $products
        ];

        return view('home_menu')->with($data);
    }

    public function dashboard()
    {

        $products = count(Products::all());
        $users = count(User::where([['roles', '!=', 'customer']])->get());
        $customers = count(User::where([['roles', '=', 'customer']])->get());
        $transactions = count(Transaction::where([['is_finish', '=', 2]])->get());

        $amount_transaction = DB::select("SELECT SUM(transaction_details.total_price) AS 'total_transaction' FROM transactions JOIN transaction_details ON transaction_details.transaction_id = transactions.id WHERE DATE(transactions.created_at) = CURDATE() GROUP BY DATE(transactions.created_at)")[0];

        $data = [
            'products' => $products,
            'users' => $users,
            'customers' => $customers,
            'transactions' => $transactions,
            'menu' => 'Dashboard',
            'sub_menu' => '',
            'amount_transaction' => $amount_transaction
        ];

        return view('dashboard')->with($data);
    }
}
