@extends('layouts.admin_app')
@section('admin_content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Detail Transaksi</h1>
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
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <table>
                                            <tr>
                                                <th width="200">Nomor Transaksi</th>
                                                <td width="20">:</td>
                                                <td>{{ $transaction->nomor_transaksi }}</td>
                                            </tr>
                                            <tr>
                                                <th>Metode Pembayaran</th>
                                                <td>:</td>
                                                <td>{{ $transaction->payment_method }}</td>
                                            </tr>
                                            <tr>
                                                <th>Alamat</th>
                                                <td>:</td>
                                                <td>{{ $transaction->alamat }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table>
                                            <tr>
                                                <th width="70">Keterangan</th>
                                                <td width="10">:</td>
                                                <td>{{ ucwords($transaction->status_order) }}</td>
                                            </tr>
                                            <tr>
                                                <th width="70">Total</th>
                                                <td width="10">:</td>
                                                <td>@currency($transaction->transaction_details_sum_total_price)</td>
                                            </tr>
                                            <tr>
                                                <th width="100">Status</th>
                                                <td width="10">:</td>
                                                <td>
                                                    @if ($transaction->is_finish == 2)
                                                        <small class="p-1 badge rounded text-white bg-success">
                                                            Selesai
                                                        </small>
                                                    @endif
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Nama Produk</th>
                                            <th class="text-center">Qty</th>
                                            <th class="text-center">Sub Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transaction->transaction_details as $details)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">{{ $details->products->name }}</td>
                                                <td class="text-center">{{ $details->qty }}</td>
                                                <td class="text-center">@currency($details->total_price)</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <a href="{{ route('backoffice_report.index') }}"
                                    class="btn btn-secondary btn-sm mt-3">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
