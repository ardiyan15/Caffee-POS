<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction;
use App\Models\Transaction_details;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            Transaction::create([
                'nomor_transaksi' => '001',
                'alamat' => $request->address,
                'payment_method' => $request->payment_method,
                'status_order' => 'pending',
                'created_by' => Auth::user()->id,
                'taken_by' => null,
                'is_finish' => 0
            ]);
            $transaction = Transaction::orderBy('id', 'DESC')->first();

            foreach ($request->dataStored as $data) {
                Transaction_details::create([
                    'product_id' => $data['productId'],
                    'qty' => $data['qty'],
                    'total_price' => $data['price'],
                    'transaction_id' => $transaction->id
                ]);
            }
            DB::commit();
            return response()->json([
                'status' => 200,
                'message' => 'success',
                'data' => $request->address
            ]);
        } catch (\Throwable $err) {
            DB::rollBack();
            return response()->json([
                'status' => 500,
                'message' => 'Failed to make transaction',
                'error' => $err->getMessage()
            ]);
        }
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
        DB::beginTransaction();
        try {
            $transaction = Transaction::findOrFail($request->transaction_id);
            if ($request->type == 'process') {
                $transaction->status_order = 'pesanan disiapkan';
            } else {
                $transaction->status_order = 'pesanan sedang diantar';
            }
            $transaction->save();
            DB::commit();
            return back()->with('success', 'Berhasil memproses pesanan');
        } catch (\Throwable $err) {
            DB::rollBack();
            throw $err;
            return back()->with('error', 'Gagal memproses pesanan');
        }
    }

    public function destroy($id)
    {
        //
    }

    public function finish_order_driver($id)
    {
        DB::beginTransaction();
        try {
            $transaction = Transaction::findOrFail($id);
            $transaction->is_finish = 1;
            $transaction->save();
            DB::commit();
            return back()->with('success', 'Berhasil update pesanan');
        } catch (\Throwable $err) {
            DB::rollBack();
            throw $err;
            return back()->with('error', 'Gagal menyelesaikan pesanan');
        }
    }

    public function finish_order_customer($id)
    {
        DB::beginTransaction();
        try {
            $productIds = [];
            $order_qty = [];
            $transaction = Transaction::findOrFail($id);
            $transaction->status_order = 'pesanan sudah diterima customer';
            $transaction->is_finish = 2;
            $order_products = Transaction_details::where('transaction_id', $id)->orderBy('id', 'DESC')->get();
            foreach ($order_products as $order_product) {
                array_push($productIds, $order_product->product_id);
                array_push($order_qty, $order_product->qty);
            }
            for ($i = 0; $i < count($productIds); $i++) {
                $product = Products::findOrFail($productIds[$i]);
                $result = $product->qty - $order_qty[$i];
                $product->qty = $result;
                $product->save();
            }
            $transaction->save();
            DB::commit();
            return back()->with('success', 'Berhasil menyelesaikan pesanan');
        } catch (\Throwable $err) {
            DB::rollBack();
            throw $err;
            return back()->with('error', 'Gagal menyelesaikan pesanan');
        }
    }
}
