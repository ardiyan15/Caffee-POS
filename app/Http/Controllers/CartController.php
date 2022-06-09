<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $menu = '';

    public function index()
    {
        $data = [
            'menu' => $this->menu,
            'sub_menu' => 'test'
        ];

        return view('cart.index')->with($data);
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

    public function get_products(Request $request)
    {
        $products = Products::whereIn('id', [$request->data])->get();

        if ($products != null) {
            return response()->json([
                'status' => 200,
                'message' => 'success',
                'data' => $products
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'not found'
            ]);
        }
    }

    public function get_product_in_cart(Request $request)
    {
        $products = Products::whereIn('id', $request->dataIds)->get();

        if (count($products) > 0) {
            return response()->json([
                'status' => 200,
                'message' => 'success',
                'data' => $products
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data not found'
            ]);
        }
    }
}
