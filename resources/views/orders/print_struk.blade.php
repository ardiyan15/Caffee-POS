<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        #tableInfo {
            border: none;
        }

        * {
            font-size: 12px;
            page-break-inside: avoid;
        }

        @media print {
            * {
                page-break-inside: avoid;
            }
        }
    </style>
</head>

<body>
    <table style="margin-top: -70px;">
        <tr>
            <td width="400" align="center" colspan="2">
                <img class="card-img-top" src='{{ asset('image/logo-transparent.png') }}' alt="Card image cap"
                    style="width: 150px; height: 150px;">
            </td>
            <td></td>
        </tr>
        <tr>
            <td align="center" colspan="2">
                <h5>Coffee Shop Jalur Singgah</h5>
            </td>
        </tr>
    </table>
    <div style="margin-left: -15px;">
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>{{ $orders->nomor_transaksi }}</h6>
                        </div>
                    </div>
                    <div class="row p-3" id="card-content">
                        <table class="table">
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama Produk</th>
                                <th class="text-center">Qty</th>
                                <th class="text-center">Sub Total</th>
                            </tr>
                            @foreach ($orders->transaction_details as $detail)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $detail->products->name }}</td>
                                    <td class="text-center">{{ $detail->qty }}</td>
                                    <td class="text-center">@currency($detail->total_price)</td>
                                </tr>
                            @endforeach
                        </table>
                        <div class="col-md-12">
                            <hr style="width: 100%;">
                        </div>
                        <table class="text-center" cellpadding="2" id="tableInfo">
                            <tr>
                                <th width="50">Alamat</th>
                                <th width="90">Total</th>
                                <th width="50">Pembayaran</th>
                            </tr>
                            <tr>
                                <td>
                                    <p style="font-size: 14px;" class="text-muted">{{ $orders->alamat }}</p>
                                </td>
                                <td>
                                    <p id="total_price">@currency($orders->transaction_details_sum_total_price)</p>
                                </td>
                                <td>
                                    <p>{{ $orders->payment_method }}</p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>
