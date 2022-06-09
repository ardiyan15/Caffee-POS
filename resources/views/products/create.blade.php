@extends('layouts.admin_app')
@section('admin_content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Tambah Product</h1>
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
                                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="">Nama Product</label>
                                            <input class="form-control" type="text" name="name" placeholder="Nama Product"
                                                required value="{{ old('nama') }}">
                                            @error('nama')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Tipe Product</label>
                                            <select name="type" id="" class="form-control" required>
                                                <option value="">-- Pilih Tipe --</option>
                                                <option value="makanan">Makanan</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Harga</label>
                                            <input type="text" class="form-control rupiah" name="harga" required
                                                placeholder="Harga Product" value="{{ old('harga') }}">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Qty</label>
                                            <input type="text" class="form-control prevent" name="qty" required
                                                placeholder="Qty" value="{{ old('qty') }}">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Deskripsi</label>
                                            <textarea class="form-control" name="deskripsi" id="" cols="10" rows="3" placeholder="Deskripsi Product"></textarea>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Foto Product</label>
                                            <input type="file" class="form-control" name="foto">
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
@endsection
