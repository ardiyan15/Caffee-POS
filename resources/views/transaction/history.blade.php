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
                            <div class="row p-3" id="card-content">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6>{{ $order->nomor_transaksi }}</h6>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <a target="_blank" href="{{ route('order.print-struk', $order->id) }}"
                                            class="text-right">Print
                                            Struk</a>
                                    </div>
                                </div>
                                <table class="table" id="table">
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
                                    <h6 for="" class="font-weight-bold">Metode Pembayaran</h6>
                                    <p>{{ $order->payment_method }}</p>
                                </div>
                            </div>
                            @if ($order->is_finish == 2)
                                <div class="bg-success mt-3 col-md-12 text-center rounded">
                                    <p class="text-white p-1">Selesai</p>
                                </div>
                            @elseif($order->is_finish == 3)
                                <div class="bg-danger mt-3 col-md-12 text-center rounded">
                                    <p class="text-white p-1">Dibatalkan</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
