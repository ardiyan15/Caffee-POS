<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Transaction;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
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
        $data = [
            'products' => $products,
            'users' => $users,
            'customers' => $customers,
            'transactions' => $transactions,
            'menu' => '',
            'sub_menu' => ''
        ];

        return view('dashboard')->with($data);
    }
}
