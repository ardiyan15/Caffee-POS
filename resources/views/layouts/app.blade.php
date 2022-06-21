<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        .card-img-top {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto">
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                        @else
                            <li class=" nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->username }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                                                                                                                                                                                                                                                                                                                                                      document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('order.index') }}">{{ __('Pesanan') }}</a>
                            </li>
                        @endguest
                        <li class="nav-item ml-3">
                            <div class="row">
                                <a class="nav-link" href="{{ route('cart.index') }}">{{ __('Cart') }}
                                    <small class="text-white text-center bg-warning"
                                        style="width: 20px; height: 20px; display: inline-block; border-radius: 20px;"
                                        id="cart_item"></small></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            @include('sweetalert::alert')
            @yield('content')
        </main>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @stack('scripts')

    <script>
        function formatRupiah(angka, prefix) {
            var number_string = angka.toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
    </script>

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

        // $('.order').on('click', function() {
        //     let stockQty = $(this).data('qty');
        //     let productTitle = $(this).data('title')
        //     let productId = $(this).data('id')

        //     $("#input_stock").val(stockQty)
        //     $("#title-order").text(productTitle)
        //     $("#product_id").val(productId)

        //     $("#orderButton").on('click', function() {
        //         let orderQty = $("#orderQty").val()
        //         if (orderQty > stockQty) {
        //             Swal.fire(
        //                 'Gagal',
        //                 "Order melebihi stock",
        //                 'error'
        //             )
        // } else {
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
        //             dataStored.push({
        //                 'productId': productId,
        //                 'qty': +orderQty
        //             })
        //             localStorage.setItem('order', JSON.stringify(dataStored))
        //             Swal.fire(
        //                 'Berhasil',
        //                 'Product sudah masuk ke keranjang',
        //                 'success'
        //             ).then(() => location.reload())
        //         }
        //     })
        // })


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
</body>

</html>
