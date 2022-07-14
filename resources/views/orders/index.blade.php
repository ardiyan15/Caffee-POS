@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center">
        <div class="col-md-8">
            @if (count($orders) == 0)
                <h2 class="text-center">Tidak Ada Pesanan</h2>
            @else
                @foreach ($orders as $order)
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6>{{ $order->nomor_transaksi }}</h6>
                                </div>
                            </div>
                            <div class="row p-3" id="card-content">
                                <table class="table">
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Nama Produk</th>
                                        <th class="text-center">Qty</th>
                                        <th class="text-center">Sub Total</th>
                                        <th class="text-center">Gambar</th>
                                    </tr>
                                    @foreach ($order->transaction_details as $detail)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">{{ $detail->products->name }}</td>
                                            <td class="text-center">{{ $detail->qty }}</td>
                                            <td class="text-center">@currency($detail->total_price)</td>
                                            <td class="text-center">
                                                <img width="50" height="50"
                                                    src='{{ asset('storage/products/' . $detail->products->foto) }}'>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                                <div class="col-md-12">
                                    <hr style="width: 100%;">
                                </div>
                                <div class="col-sm-4 form-group mt-3">
                                    <h6 for="" class="font-weight-bold">Alamat</h6>
                                    <p style="font-size: 14px;" class="text-muted">{{ $order->alamat }}</p>
                                </div>
                                <div class="col-sm-4 mt-3">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6 for="" class="font-weight-bold">Total</h6>
                                            <p id="total_price">@currency($order->transaction_details_sum_total_price)</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <h6 for="" class="font-weight-bold">Method Pembayaran</h6>
                                    <p>{{ $order->payment_method }}</p>
                                </div>
                            </div>
                            @if ($order->status_order == 'pesanan sedang diantar' && $order->is_finish == 0)
                                <div class="bg-info mt-3 col-md-12 text-center rounded">
                                    <p class="text-white p-1">{{ ucwords($order->status_order) }}</p>
                                </div>
                            @elseif($order->status_order == 'pesanan disiapkan')
                                <div class="bg-info mt-3 col-md-12 text-center rounded">
                                    <p class="text-white p-1">{{ ucwords($order->status_order) }}</p>
                                </div>
                            @elseif($order->status_order == 'pending')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="bg-secondary mt-3 col-md-12 text-center rounded">
                                            <p class="text-white p-1">Pesanan Dalam Antrian</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <form action="{{ route('cancel_order', $order->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button
                                                class="cancel_order btn btn-danger btn-sm mt-3 col-md-12 p-1">Batalkan</button>
                                        </form>
                                    </div>
                                </div>
                            @else
                                <div class="mt-3 col-md-12 text-center rounded">
                                    <form action="{{ route('finish_order_customer', $order->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button data-id={{ $order->snap_token }}
                                            data-payment={{ $order->payment_method }} style="width: 100%"
                                            class="finish_order_customer btn btn-success btn-sm rounded">Selesaikan
                                            Pesanan</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>

    <script>
        $('.finish_order_customer').on('click', function(event) {
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
                    let paymentMethod = $(this).data('payment')
                    let form = $(this).closest('form')
                    let snapToken = $(this).data('id')
                    if (paymentMethod == 'Dana') {
                        snap.pay(snapToken, {
                            onSuccess: function(result) {
                                console.log(result)
                                if (result.status_code == "200") {
                                    console.log(result.status_code == "200")
                                    form.submit()
                                }
                            },
                            onPending: function(result) {
                                console.log(result)
                            },
                            onError: function(result) {
                                console.log(result)
                            },
                            onClose: function(result) {
                                console.log($(this).find(".medium"))
                                console.log(result)
                            }
                        })
                    } else {
                        form.submit();
                    }
                }
            }).catch(err => console.log(err))
        });

        $('.cancel_order').on('click', function(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Batalkan Pesanan',
                text: 'Ingin membatalkan pesanan?',
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
