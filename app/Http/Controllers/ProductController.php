<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    protected $menu = 'master';

    public function index()
    {
        $products = Products::with('category')->orderBy('id', 'DESC')->get();
        $data = [
            'menu' => $this->menu,
            'sub_menu' => 'produk',
            'products' => $products
        ];

        return view('products.index')->with($data);
    }

    public function create()
    {
        $data = [
            'menu' => $this->menu,
            'sub_menu' => 'produk',
            'categories' => Category::orderBy('id', 'DESC')->get()
        ];

        return view('products.create')->with($data);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        $price = str_replace('.', '', $request->harga);
        $ext_foto_product = $request->foto->getClientOriginalExtension();

        $foto_product = time() . "." . $ext_foto_product;

        try {
            Products::create([
                'name' => $request->name,
                'harga' => $price,
                'category_id' => $request->category_id,
                'deskripsi' => $request->deskripsi,
                'qty' => $request->qty,
                'foto' => $foto_product
            ]);

            $request->foto->storeAs('public/products', $foto_product);

            DB::commit();
            return redirect('admin/products')->with('success', 'Berhasil menambahkan Product');
        } catch (\Throwable $err) {
            DB::rollBack();
            throw $err;
            return back()->with('error', 'Gagal menambahkan product');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $product = Products::findOrFail($id);

        $data = [
            'menu' => $this->menu,
            'sub_menu' => 'produk',
            'product' => $product,
            'categories' => Category::orderBy('id', 'DESC')->get()
        ];

        return view('products.edit')->with($data);
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $price = str_replace('.', '', $request->harga);
            $product = Products::findOrFail($id);
            $product->name = $request->name;
            $product->harga = $price;
            $product->tipe = $request->type;
            $product->deskripsi = $request->deskripsi;
            $product->qty = $request->qty;

            if ($request->foto) {
                $image_path = storage_path('app' . '\\' . 'public' . '\\' . 'products' . '\\' . $product->foto);

                unlink($image_path);
                $ext_foto_product = $request->foto->getClientOriginalExtension();
                $foto_product = time() . "." . $ext_foto_product;

                $product->foto = $foto_product;
                $request->foto->storeAs('public/products', $foto_product);
            }

            $product->save();

            DB::commit();
            return redirect('admin/products')->with('success', 'Berhasil update product');
        } catch (\Throwable $err) {
            DB::rollBack();
            throw $err;
            return back()->with('error', 'Gagal update product');
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $product = Products::findOrFail($id);
            $product->delete();
            DB::commit();
            return back()->with('success', 'Berhasil hapus product');
        } catch (\Throwable $err) {
            DB::rollBack();
            return back()->with('error', 'Gagal hapus product');
        }
    }

    public function get_product(Request $request)
    {
        $product = Products::findOrFail($request->id);

        if ($product !== null) {
            return response()->json([
                'status' => 200,
                'message' => 'success',
                'data' => $product,
                'request' => $request->id
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'error',
                'data' => 'product not found'
            ]);
        }
    }
}
