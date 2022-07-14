@extends('layouts.admin_app')
@section('admin_content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Tambah Kategori Produk</h1>
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
                                <form action="{{ route('categories.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="">Nama Kategori</label>
                                            <input class="form-control" type="text" name="kategori"
                                                placeholder="Kategori" required value="{{ old('kategori') }}">
                                            @error('kategori')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-sm rounded">Simpan</button>
                                    <a href="{{ route('categories.index') }}"
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
