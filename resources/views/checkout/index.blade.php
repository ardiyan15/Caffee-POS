@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row" id="card-content">
                        <div class="col-md-12">
                            <hr style="width: 100%;">
                        </div>
                        <div class="col-sm-6 form-group mt-3">
                            <h4 for="">Alamat</label>
                                <textarea required name="" id="alamat" cols="30" rows="5" class="form-control"
                                    placeholder="Alamat antar"></textarea>
                        </div>
                        <div class="col-sm-6 mt-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 for="">Total</h4>
                                    <p id="total_price">Rp. 30.000</p>
                                </div>
                                <div class="col-md-12">
                                    <label for="" class="font-weight-bold">Method Pembayaran</label>
                                    <select id="payment_method" name="payment_method" class="form-control" required>
                                        <option value="">-- Pilih Method Pembayaran</option>
                                        <option value="Dana">Dana</option>
                                        <option value="Cash">Cash</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 col-md-12">
                        <button style="width: 100%;" id="order" class="text-white btn btn-primary btn-sm">Buat
                            Pesanan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"> --}}
    </script>
    <script>
        dataStored = JSON.parse(localStorage.getItem('order'))
        let address = ''
        let payment_method = ''
        let snapToken = ''

        let totalPrice = [];

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

        let groupAndSumData = sumObj(dataStored)

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
                        let i = 0;
                        response.data.forEach(item => {
                            groupAndSumData.forEach(data => {
                                if (item.id == data.productId) {
                                    item.qty = data.qty
                                }
                            });
                            dataStored[i].price = item.harga * item.qty
                            i++
                            let result = item.qty * item.harga
                            totalPrice.push(result)
                            $("#card-content").prepend(`
                                <div class="col-md-6 mt-4">
                                    <img class="card-img-top" src='{{ asset('storage/products/${item.foto}') }}'>
                                </div>
                                <div class="col-md-6 mt-4">
                                    <h3>${item.name}</h3>
                                    <p>${item.qty} Pcs</p>
                                    <p>Rp. ${formatRupiah(item.harga)}</p>
                                </div>
                            `)
                        })
                        let finalPrice = totalPrice.reduce((accumulator, value) => accumulator + value)
                        $("#total_price").text("Rp. " + formatRupiah(finalPrice))
                        snapToken = response.snapToken

                        // $("#order").on('click', function() {
                        // console.log(snapToken)
                        // snap.pay(snapToken, {
                        //     onSuccess: function(result) {
                        //         console.log(result)
                        //     },
                        //     onPending: function(result) {
                        //         console.log(result)
                        //     },
                        //     onError: function(result) {
                        //         console.log(result)
                        //     }
                        // })
                        //     if ($("#alamat").val() == '') {
                        //         Swal.fire(
                        //             'Gagal',
                        //             'Alamat harus diisi',
                        //             'error'
                        //         )
                        //         return false
                        //     } else if (payment_method == '') {
                        //         Swal.fire(
                        //             'Gagal',
                        //             'Metode pmebayaran harus diisi',
                        //             'error'
                        //         )
                        //         return false
                        //     } else {
                        //         address = $("#alamat").val()
                        //         $.ajax({
                        //             type: 'POST',
                        //             url: '{{ route('transaction.store') }}',
                        //             data: {
                        //                 "_token": "{{ csrf_token() }}",
                        //                 address: address,
                        //                 payment_method: payment_method,
                        //                 dataStored
                        //             },
                        //             success: response => {
                        //                 if (response.status == 200) {
                        //                     Swal.fire(
                        //                         'Berhasil',
                        //                         'Berhasil memnbuat pesanan',
                        //                         'success'
                        //                     ).then(() => {
                        //                         localStorage.clear()
                        //                         var APP_URL =
                        //                             {!! json_encode(url('/')) !!}
                        //                         window.location = APP_URL + '/order'
                        //                     })
                        //                 }
                        //             },
                        //             error: err => console.log(err)
                        //         })
                        //     }
                        // })
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

        $("#payment_method").on('change', function() {
            payment_method = $(this).val()
        })

        $("#order").on('click', function() {
            if ($("#alamat").val() == '') {
                Swal.fire(
                    'Gagal',
                    'Alamat harus diisi',
                    'error'
                )
                return false
            } else if (payment_method == '') {
                Swal.fire(
                    'Gagal',
                    'Metode pmebayaran harus diisi',
                    'error'
                )
                return false
            } else {
                address = $("#alamat").val()
                $.ajax({
                    type: 'POST',
                    url: '{{ route('transaction.store') }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        address: address,
                        payment_method: payment_method,
                        dataStored
                    },
                    success: response => {
                        if (response.status == 200) {
                            Swal.fire(
                                'Berhasil',
                                'Berhasil memnbuat pesanan',
                                'success'
                            ).then(() => {
                                localStorage.clear()
                                var APP_URL = {!! json_encode(url('/')) !!}
                                window.location = APP_URL + '/order'
                            })
                        }
                    },
                    error: err => console.log(err)
                })
            }
        })
    </script>
@endpush
