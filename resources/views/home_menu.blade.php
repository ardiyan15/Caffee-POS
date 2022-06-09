@extends('layouts.app')

@section('content')
    <div class="container d-flex">
        @foreach ($products as $product)
            <div class="row text-center" style="margin-left: 5%;">
                <div class="col-md-4 mb-3">
                    <div class="card h-100 shadow" style="width: 18rem;">
                        <img class="card-img-top" src='{{ asset("storage/products/$product->foto") }}'
                            alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title text-bold" style="font-weight: bolder">{{ $product->name }}</h5>
                            <p>@currency($product->harga)</p>
                            <p>Qty: {{ $product->qty }}</p>
                            @if (strlen($product->deskripsi) >= 100)
                                <p class="card-text">{{ substr($product->deskripsi, 0, 100) . ' ...' }}</p>
                            @else
                                <p class="card-text"> {{ $product->deskripsi }}</p>
                            @endif
                        </div>
                        <div class="card-footer" style="background-color: white">
                            <button class="btn btn-primary btn-sm rounded order" data-toggle="modal"
                                data-target="#orderModal" data-qty="{{ $product->qty }}"
                                data-title="{{ $product->name }}" data-id="{{ $product->id }}">Order</button>
                            <button class="btn btn-info btn-sm rounded text-white detail" data-toggle="modal"
                                data-target="#modalDetail" data-id="{{ $product->id }}">Detail</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="orderModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Order Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <h5 id="title-order">Test Product 2</h5>
                        <div class="col-sm-6 form-group">
                            <label for="">Tersisa</label>
                            <input type="text" class="form-control" name="stock" readonly id="input_stock">
                            <input type="hidden" name="product_id" id="product_id">
                        </div>
                        <div class="col-sm-6 form-group">
                            <label for="">Qty</label>
                            <input type="text" required class="form-control" name="qty_order" id="orderQty"
                                placeholder="Qty">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="orderButton" class="btn btn-primary btn-sm">Simpan</button>
                    <button type="button" class="btn btn-secondary btn-sm">Batal</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let result = ''
        let dataStored = JSON.parse(localStorage.getItem('order'))
        if (dataStored == null) {
            dataStored = []
            $("#cart_item").hide()
        }

        if (dataStored != null) {
            let totalItem = dataStored.reduce((accumulator, value) => {
                return accumulator + value.qty
            }, 0)

            $("#cart_item").text(totalItem)
        }

        $('.order').on('click', function() {
            let stockQty = $(this).data('qty');
            let productTitle = $(this).data('title')
            let productId = $(this).data('id')

            $("#input_stock").val(stockQty)
            $("#title-order").text(productTitle)
            $("#product_id").val(productId)

            $("#orderButton").on('click', function() {
                let orderQty = $("#orderQty").val()
                if (orderQty > stockQty) {
                    Swal.fire(
                        'Gagal',
                        "Order melebihi stock",
                        'error'
                    )
                } else {
                    // result = dataStored.some(item => {
                    //     return item
                    // })

                    // if (result == false) {
                    //     dataStored.push({
                    //         'productId': productId,
                    //         'qty': orderQty
                    //     })
                    // } else if (result == true) {

                    //     let index = dataStored.findIndex(data => {
                    //         console.log(data.productId == productId)
                    //         return data.productId === productId
                    //     })
                    //     console.log(dataStored[index].qty)
                    // }
                    dataStored.push({
                        'productId': productId,
                        'qty': +orderQty
                    })
                    localStorage.setItem('order', JSON.stringify(dataStored))
                    Swal.fire(
                        'Berhasil',
                        'Product sudah masuk ke keranjang',
                        'success'
                    ).then(() => location.reload())
                }
            })
        })


        $(".detail").on('click', function() {
            $(".modal-body").empty()

            let id = $(this).data('id')
            $.ajax({
                type: 'POST',
                url: '{{ route('get_product') }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id
                },
                success: (data) => {
                    if (data.status == 200) {
                        $(".modal-body").append(`
                            <div class="col-md-12 mb-3 text-center">
                                <div>
                                    <img style="width: 100%;" src="{!! asset('storage/products/${data.data.foto}') !!}"
                                        alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title text-bold" style="font-weight: bolder">${data.data.name}</h5>
                                        <p>${formatRupiah(+data.data.harga, 'Rp. ')}</p>
                                        <p class="card-text">${data.data.deskripsi}</p>
                                    </div>
                                </div>
                            </div>
                        `)
                    } else {
                        console.log('Failed to get detail product')
                    }
                },
                error: err => consle.log(err)
            })
        })
    </script>
@endpush
