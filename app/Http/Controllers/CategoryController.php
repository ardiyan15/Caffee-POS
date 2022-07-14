<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    private $menu = 'master';
    private $sub_menu = 'category';

    public function index()
    {
        $data = [
            'menu' => $this->menu,
            'sub_menu' => $this->sub_menu,
            'results' => Category::orderBy('id', 'DESC')->get()
        ];

        return view('categories.index')->with($data);
    }

    public function create()
    {
        $data = [
            'menu' => $this->menu,
            'sub_menu' => $this->sub_menu
        ];

        return view('categories.create')->with($data);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            Category::create([
                'nama' => $request->kategori
            ]);
            DB::commit();
            return redirect('admin/categories')->with('success', 'Berhasil menambah kategori');
        } catch (\Exception $err) {
            DB::rollBack();
            throw $err;
            return back()->with('error', 'Gagal menambah kategori');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = [
            'menu' => $this->menu,
            'sub_menu' => $this->sub_menu,
            'category' => Category::findOrFail($id)
        ];

        return view('categories.edit')->with($data);
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $category = Category::findOrFail($id);
            $category->nama = $request->kategori;
            $category->save();
            DB::commit();
            return redirect('/admin/categories')->with('success', 'Berhasil edit kategori produk');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal edit kategori produk');
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $category = Category::findOrFail($id);
            $category->delete();
            DB::commit();
            return back()->with('success', 'Berhasil hapus kategori produk');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal hapus kategori produk');
        }
    }
}
