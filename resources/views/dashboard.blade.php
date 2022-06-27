@extends('layouts.admin_app')

@section('admin_content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <h1>Dashboard</h1>
                <div class="row">
                    <div class="col-md-3">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $customers }}</h3>
                                <p>Jumlah Customer</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-database"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="small-box bg-secondary">
                            <div class="inner">
                                <h3>{{ $users }}</h3>
                                <p>Jumlah User</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-database"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <h3>{{ $products }}</h3>
                                <p>Jumlah Produk</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-database"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $transactions }}</h3>
                                <p>Jumlah Pesanan</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-database"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>@currency($amount_transaction->total_transaction)</h3>
                                <p>Jumlah Transaksi Hari Ini</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-database"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
