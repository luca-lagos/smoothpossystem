@extends('template')
@section('title', 'Ver compra N°' . $shop->voucher_number)
@push('css')
    <!-- Custom styles for this page -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- SweetAlert2 plugin -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        #image_path {
            width: 350px !important;
            height: 350px !important;
            object-fit: cover;
        }
    </style>
@endpush
@section('content')
    @if (session('success'))
        <script>
            let message = "{{ session('success') }}";
            const Toast = Swal.mixin({
                toast: true,
                position: "bottom-start",
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "success",
                title: message
            });
        </script>
    @endif

    <div class="container-fluid mb-4 col-12">
        <h1 class="h3 mb-3 text-gray-800">Compra N° {{ $shop->voucher_number }}</h1>
        <ol class="breadcrumb mb-3">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('shops.index') }}">Compras</a></li>
            <li class="breadcrumb-item active">Ver compra</li>
        </ol>
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h5 class="m-0 font-weight-bold text-primary">Datos generales</h5>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-sm-4">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-file"></i></span>
                            </div>
                            <input disabled type="text" class="form-control font-weight-bold"
                                value="TIPO DE COMPROBANTE ">
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="input-group">
                            <input disabled type="text" class="form-control"
                                value="{{ strtoupper($shop->voucher->voucher_type) }}">
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-sm-4">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i
                                        class="fas fa-user-tie"></i></span></div>
                            <input disabled type="text" class="form-control font-weight-bold" value="PROVEEDOR ">
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="input-group">
                            <input disabled type="text" class="form-control"
                                value="{{ $shop->supplier->people->social_reason }}">
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-sm-4">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                            </div>
                            <input disabled type="text" class="form-control font-weight-bold" value="Fecha ">
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="input-group">
                            <input disabled type="text" class="form-control"
                                value="{{ \Carbon\Carbon::parse($shop->date_time)->format('d-m-Y') }}">
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-sm-4">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-clock"></i></span>
                            </div>
                            <input disabled type="text" class="form-control font-weight-bold" value="Hora ">
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="input-group">
                            <input disabled type="text" class="form-control"
                                value="{{ \Carbon\Carbon::parse($shop->date_time)->format('H:i') }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                            </div>
                            <input disabled type="text" class="form-control font-weight-bold" value="Impuestos ">
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="input-group d-flex">
                            <input disabled type="text" id="input_tax" class="form-control"
                                value="${{ round($shop->tax) }}"></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h5 class="m-0 font-weight-bold text-primary">Detalles de la compra</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-striped" width="100%" cellspacing="0">
                        <thead class="bg-primary">
                            <tr class="align-top">
                                <th class="text-white">Producto</th>
                                <th class="text-white">Cantidad</th>
                                <th class="text-white">Precio de compra</th>
                                <th class="text-white">Precio de venta</th>
                                <th class="text-white">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($shop->products as $product)
                                <tr>
                                    <td>
                                        {{ $product->name }}
                                    </td>
                                    <td>
                                        {{ $product->pivot->count }}
                                    </td>
                                    <td>
                                        ${{ round($product->pivot->shop_price) }}
                                    </td>
                                    <td>
                                        ${{ round($product->pivot->sale_price) }}
                                    </td>
                                    <td class="d-flex">
                                        $<p class="p_subtotal">
                                            {{ round($product->pivot->count * $product->pivot->shop_price) }}</p>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-secondary">
                            <tr>
                                <th class="text-white" colspan="4">SUMAS</th>
                                <th class="text-white" id="th_sums">-</th>
                            </tr>
                            <tr>
                                <th class="text-white" colspan="4">IMPUESTOS</th>
                                <th class="text-white" id="th_tax">-</th>
                            </tr>
                            <tr>
                                <th class="text-white" colspan="4">TOTAL</th>
                                <th class="text-white" id="th_total">-</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        let subtotal_rows = document.getElementsByClassName('p_subtotal');
        console.log(subtotal_rows);
        let counter = 0;
        let tax_value = $('#input_tax').val();

        $(document).ready(function() {
            calcValues();
        });

        function calcValues() {
            for (let i = 0; i < subtotal_rows.length; i++) {
                counter += parseFloat(subtotal_rows[i].innerHTML);
            }

            let result = tax_value.slice(1);

            $('#th_sums').html('$' + counter);
            $('#th_tax').html('$' + result);
            $('#th_total').html('$' + round(counter + parseFloat(result)));
        }

        function round(num, dec = 2) {
            var sign = (num >= 0 ? 1 : -1);
            num = num * sign;
            if (dec === 0) //con 0 decimales
                return sign * Math.round(num);
            // round(x * 10 ^ decimales)
            num = num.toString().split('e');
            num = Math.round(+(num[0] + 'e' + (num[1] ? (+num[1] + dec) : dec)));
            // x * 10 ^ (-decimales)
            num = num.toString().split('e');
            return sign * (num[0] + 'e' + (num[1] ? (+num[1] - dec) : -dec));
        }
    </script>
@endpush
