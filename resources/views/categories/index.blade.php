@extends('layouts.admin_app')

@section('admin_content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Master Kategori Produk</h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <a href="{{ route('categories.create') }}"
                                    class="btn btn-primary btn-sm rounded pull-right">Tambah Kategori Produk</a>
                            </div>
                            <div class="card-body">
                                <table id="table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Nama Kategori</th>
                                            <th class="text-center">Tanggal Dibuat</th>
                                            <th class="text-center">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($results as $result)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">{{ $result->nama }}</td>
                                                <td class="text-center">{{ substr($result->created_at, 0, 10) }}</td>
                                                <td class="text-center">
                                                    <form action="{{ route('categories.destroy', $result->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="{{ route('categories.edit', $result->id) }}"
                                                            class="btn btn-sm btn-info rounded"><i class="fas fa-edit"
                                                                title="Edit"></i></a>
                                                        <button class="delete-confirm btn btn-sm btn-danger rounded"><i
                                                                class="fa fa-trash" aria-hidden="true" data-toggle="tooltip"
                                                                title="Hapus"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
