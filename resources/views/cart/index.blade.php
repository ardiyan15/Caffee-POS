@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center">
        <div class="col-md-8">
            <div class="card" id="card">
                <div class="card-body" id="cardItem">
                    <div class="row" id="card-content">
                    </div>
                    <div class="mt-3 col-md-12 text-center">
                        @guest
                            <button style="width: 100%" disabled class="text-white btn btn-success btn-sm">Checkout</button>
                            <small class="font-weight-bold">( Login untuk checkout )</small>
                        @else
                            <a href="{{ route('checkout.index') }}" style="width: 100%;" disabled
                                class="text-white btn btn-success btn-sm">Checkout</a>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
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
                            <input type="text" class="form-control" readonly id="input_stock">
                        </div>
                        <div class="col-sm-6 form-group">
                            <label for="">Qty</label>
                            <input type="text" class="form-control" id="orderQty" placeholder="Qty">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="orderButton" class="btn btn-primary btn-sm">Simpan</button>
                    <button type="button" class="btn btn-secondary btn-sm">Batal</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        dataStored = JSON.parse(localStorage.getItem('order'))
        let groupAndSumData = ''

        function sumObj(objArr) {
            // an object to store the `created` and `amount` as key=>value
            var newObj = {};
            // loop over the objects in the array
            objArr.forEach(function(obj) {
                // if the key is present in `newObj` then we need to add the amount to it's value
                if (obj.productId in newObj) {
                    newObj[obj.productId] += +obj.qty;
                } else {
                    // else just add the key and the amount as value
                    newObj[obj.productId] = +obj.qty;
                }
            });
            //  create an array to store the final objects
            var arr = [];
            // loop over the properties in `newObj`
            for (var prop in newObj) {
                // push an object each time
                arr.push({
                    productId: Number(prop),
                    qty: newObj[prop]
                });
            }
            // return the final result
            return arr;
        }

        if (dataStored != null) {
            groupAndSumData = sumObj(dataStored)
        } else {
            $("#cardItem").hide()
            $("#card").html("<h3 class='text-center p-3'>Tidak Ada Item</h3>")
        }

        let dataIds = []
        if (dataStored == null) {
            dataStored = []
        } else {
            dataStored.forEach(data => {
                dataIds.push(data.productId)
            })
            $.ajax({
                type: 'POST',
                url: '{{ route('cart.get_product_in_cart') }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    dataIds
                },
                success: response => {
                    if (response.status == 200) {
                        response.data.forEach(item => {
                            groupAndSumData.forEach(data => {
                                if (item.id == data.productId) {
                                    item.qty = data.qty
                                }
                            });
                            $("#card-content").append(`
                                <div class="col-md-6 mt-4">
                                    <img class="card-img-top" src='{{ asset('storage/products/1654159660.jpg') }}'>
                                </div>
                                <div class="col-md-6 mt-4">
                                    <h3>${item.name}</h3>
                                    <p>${item.qty} Pcs</p>
                                    <p>Rp. ${formatRupiah(item.harga)}</p>
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
        if (dataStored != null) {
            let totalItem = dataStored.reduce((accumulator, value) => {
                return accumulator + value.qty
            }, 0)

            $("#cart_item").text(totalItem)
        }
    </script>
@endpush
