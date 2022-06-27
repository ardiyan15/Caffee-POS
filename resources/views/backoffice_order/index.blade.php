@extends('layouts.admin_app')

@section('admin_content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>List Pesanan Customer</h1>
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
                                <table class="table" id="table">
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Nomor Transaksi</th>
                                        <th class="text-center">Pembayaran</th>
                                        <th class="text-center">Alamat Pengantaran</th>
                                        @if (Auth::user()->roles != 'driver')
                                            <th class="text-center">Status</th>
                                        @endif
                                        <th class="text-center">Opsi</th>
                                    </tr>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('backoffice_order.show', $order->id) }}">
                                                    {{ $order->nomor_transaksi }}
                                                </a>
                                            </td>
                                            <td class="text-center">{{ $order->payment_method }}</td>
                                            <td class="text-center">{{ $order->alamat }}</td>
                                            @if (Auth::user()->roles != 'driver')
                                                <td class="text-center">
                                                    @if ($order->status_order == 'pending')
                                                        <span class="p-1 badge rounded text-white bg-warning">
                                                            {{ $order->status_order }}
                                                        </span>
                                                    @elseif($order->status_order == 'pesanan disiapkan')
                                                        <span class="p-1 badge rounded text-white bg-info">
                                                            {{ $order->status_order }}
                                                        </span>
                                                    @elseif($order->status_order == 'pesanan sedang diantar')
                                                        <span class="p-1 badge rounded text-white bg-info">
                                                            {{ $order->status_order }}
                                                        </span>
                                                    @elseif($order->status_order == 'pesanan dibatalkan oleh customer')
                                                        <span class="p-1 badge rounded text-white bg-danger">
                                                            {{ $order->status_order }}
                                                        </span>
                                                    @else
                                                        <span class="p-1 badge rounded text-white bg-success">
                                                            Selesai
                                                        </span>
                                                    @endif
                                                </td>
                                            @endif
                                            <td class="text-center">
                                                @if ($order->status_order == 'pending')
                                                    <button id="detail" data-id="{{ $order->id }}" data-toggle="modal"
                                                        data-target="#exampleModal"
                                                        class="rounded taking-order btn btn-primary btn-sm">Proses
                                                        Pesanan</button>
                                                @elseif($order->status_order == 'pesanan disiapkan')
                                                    <button data-id={{ $order->id }} id="delivery" data-toggle="modal"
                                                        data-target="#driverModal"
                                                        class="btn btn-info btn-sm rounded">Berikan ke Driver</button>
                                                @elseif($order->status_order == 'pesanan sedang diantar' && Auth::user()->roles == 'driver')
                                                    <form
                                                        action="{{ route('transaction.finish_order_driver', $order->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button data-id={{ $order->id }}
                                                            class="btn btn-info btn-sm rounded finish_order">Pesanan sudah
                                                            diterima</button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
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
                    <h5 class="modal-title" id="exampleModalLabel">Siapkan pesanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('transaction.update', 1) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <input type="hidden" name="type" value="process">
                        <input type="hidden" name="transaction_id" value="" id="transaction_id">
                        <div class="card">
                            <div class="card-body">
                                <div class="row" id="card-content">
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm rounded"
                                data-dismiss="modal">Batal</button>
                            <button type="submit" id="process" class="btn btn-primary btn-sm rounded">Proses</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="driverModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Berikan pesanan ke driver</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('transaction.update', 1) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <input type="hidden" name="type" value="deliver">
                        <input type="hidden" name="transaction_id" value="" id="transaction_id_notes">
                        <div class="card">
                            <div class="card-body">
                                <div class="row" id="card-content-notes">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm rounded"
                                data-dismiss="modal">Batal</button>
                            <button type="submit" id="process" class="btn btn-primary btn-sm rounded">Proses</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function call_ajax(dom_id, id) {
            $.ajax({
                type: 'POST',
                url: '{{ route('get_order_transaction') }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    id
                },
                success: response => {
                    if (response.status == 200) {
                        response.data.transaction_details.forEach(item => {
                            console.log(item.total_price)
                            $(dom_id).append(`
                                <div class="col-md-6 mt-4">
                                    <img class="card-img-top" src='{{ asset('storage/products/1654159660.jpg') }}'>
                                </div>
                                <div class="col-md-6 mt-4">
                                    <h3>${item.products.name}</h3>
                                    <p>${item.qty} Pcs</p>
                                    <p>Rp. ${formatRupiah(item.total_price)}</p>
                                </div>
                            `)
                        })
                    } else {
                        Swal.fire(
                            'Gagal',
                            'Gagal memuat product',
                            'error'
                        )
                    }
                },
                error: err => console.log(err)
            })
        }

        $("#detail").on('click', function() {
            let id = $(this).data('id');
            $("#transaction_id").val(id)

            call_ajax("#card-content", id)
        })

        $("#delivery").on('click', function() {
            let id_note_transaction = $(this).data('id')
            $("#transaction_id_notes").val(id_note_transaction)
            call_ajax("#card-content-notes", id_note_transaction)
        })

        $('.finish_order').on('click', function(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Selesaikan Pesanan',
                text: 'Pesanan sudah diterima?',
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
    </script>
@endpush
