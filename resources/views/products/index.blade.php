@extends('layouts.admin_app')

@section('admin_content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Master Products</h1>
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
                                <a href="{{ route('products.create') }}"
                                    class="btn btn-primary btn-sm rounded pull-right">Tambah Products</a>
                            </div>
                            <div class="card-body">
                                <table id="table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr style="background-color: #013066">
                                            <th class="text-center text-white">#</th>
                                            <th class="text-center text-white">Nama</th>
                                            <th class="text-center text-white">Harga</th>
                                            <th class="text-center text-white">Tipe</th>
                                            <th class="text-center text-white">Deskripsi</th>
                                            <th class="text-center text-white">Foto</th>
                                            <th class="text-center text-white">Qty</th>
                                            <th class="text-center text-white">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">{{ $product->name }}</td>
                                                <td class="text-center">@currency($product->harga)</td>
                                                <td class="text-center">{{ $product->tipe }}</td>
                                                <td class="text-center">{{ $product->deskripsi }}</td>
                                                <td class="text-center">
                                                    <a href="" class="product" data-toggle="modal"
                                                        data-target="#exampleModal" data-id="{{ $product->id }}">
                                                        <img class="text-center"
                                                            src='{{ asset("/storage/products/$product->foto") }}' width="
                                                                                        50" height="50" />
                                                    </a>
                                                </td>
                                                <td class="text-center">{{ $product->qty }}</td>
                                                <td class="text-center">
                                                    <form action="{{ route('products.destroy', $product->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="{{ route('products.edit', $product->id) }}"
                                                            class="btn btn-sm btn-info rounded"><i class="fas fa-edit"
                                                                title="Edit"></i></a>
                                                        <button class="delete-confirm btn btn-sm btn-danger rounded"><i
                                                                class="fa fa-trash" aria-hidden="true"
                                                                data-toggle="tooltip" title="Hapus"></i></button>
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

    <!-- Modal -->
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

@push('scripts')
    <script>
        $('.delete-confirm').on('click', function(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Hapus Data',
                text: 'Ingin menghapus data?',
                icon: 'question',
                showCloseButton: true,
                showCancelButton: true,
                cancelButtonText: "Batal",
                focusConfirm: false,
            }).then((value) => {
                if (value.isConfirmed) {
                    $(this).closest("form").submit()
                }
            });
        });

        $(".product").on('click', function(e) {
            e.preventDefault()
            let id = $(this).data('id')

            $("#img-content").empty()

            $.ajax({
                type: 'POST',
                url: '{{ route('get_product') }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id
                },
                success: ({
                    data
                }) => {
                    $("#img-content").append(
                        `<img class="text-center" src="{!! asset('/storage/products/${data.foto}') !!}" width="450" />`)
                },
                error: err => console.log(err)
            })
        })
    </script>
@endpush
