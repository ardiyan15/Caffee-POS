@extends('layouts.admin_app')

@section('admin_content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Report Transaksi</h1>
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
                                <form action="{{ route('backoffice_report.index') }}" method="GET" class="mb-3">
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="">Tanggal Awal</label>
                                            <input type="date" name="start" class="form-control">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Tanggal Akhir</label>
                                            <input type="date" name="end" class="form-control">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                    <a href="{{ route('backoffice_report.index') }}"
                                        class="btn btn-danger btn-sm">Reset</a>
                                </form>
                                <table id="table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Nomor Transaksi</th>
                                            <th class="text-center">Metode Pembayaran</th>
                                            <th class="text-center">Tanggal Transaksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transactions as $transaction)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('backoffice_report.show', $transaction->id) }}">
                                                        {{ $transaction->nomor_transaksi }}
                                                    </a>
                                                </td>
                                                <td class="text-center">{{ $transaction->payment_method }}</td>
                                                <td class="text-center">{{ substr($transaction->created_at, 0, 10) }}</td>
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
