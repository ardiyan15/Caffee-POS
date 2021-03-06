@extends('layouts.admin_app')
@section('admin_content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Product</h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('products.update', $product->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="">Nama Product</label>
                                            <input class="form-control" type="text" name="name"
                                                placeholder="Nama Product" required
                                                value="{{ old('nama', $product->name) }}">
                                            @error('nama')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Tipe Product</label>
                                            <select name="type" id="" class="form-control" required>
                                                <option value="">-- Pilih Tipe --</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        @if ($category->id == $product->category_id) selected @endif>
                                                        {{ $category->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Harga</label>
                                            <input type="text" class="form-control rupiah" name="harga" required
                                                placeholder="Harga Product" value="{{ old('harga', $product->harga) }}">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Qty</label>
                                            <input type="text" class="form-control prevent" name="qty" required
                                                placeholder="Qty" value="{{ old('qty', $product->qty) }}">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Deskripsi</label>
                                            <textarea class="form-control" name="deskripsi" id="" cols="10" rows="3"
                                                placeholder="Deskripsi Product">{{ $product->deskripsi }}</textarea>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="card">
                                                        <a href="" class="product" data-toggle="modal"
                                                            data-target="#exampleModal" data-id="{{ $product->id }}">
                                                            <img src='{{ asset("storage/products/$product->foto") }}'
                                                                width=" 100%" height="150" alt="">
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">Foto Product</label> <small>(Isi juka ingin
                                                        diubah)</small>
                                                    <input type="file" class="form-control" name="foto">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-sm rounded">Simpan</button>
                                    <a href="{{ route('products.index') }}"
                                        class="btn btn-secondary btn-sm rounded">Kembali</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Gambar Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="img-content">
                </div>
            </div>
        </div>
    </div>
@endsection
