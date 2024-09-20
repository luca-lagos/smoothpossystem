@extends('template')
@section('title', 'Crear una compra')
@push('css')
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        #box_social_reason {
            display: none;
        }
    </style>
@endpush
@section('content')
    <div class="container-fluid mb-4">
        <h1 class="h3 mb-3 text-gray-800">Crear una compra</h1>
        <ol class="breadcrumb mb-3">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"> <a href="{{ route('shops.index') }}">Compras</a></li>
            <li class="breadcrumb-item active">Crear una compra</li>
        </ol>
        <div class="w-100 mt-3 border border-3 border-primary rounded p-4">
            <form action="{{ route('shops.store') }}" method="post">
                @csrf
                <div class="container-fluid w-100">
                    <div class="row">
                        <div class="col-xl-8 mb-sm-4">
                            <div class="text-white bg-primary p-2 text-center rounded-top" style="font-size: 20px;">
                                Datos de la compra
                            </div>
                            <div class="p-3 border border-3 border-primary rounded-bottom">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="product_id" class="form-label">Seleccion de productos</label>
                                        <br>
                                        <select name="product_id" id="product_id"
                                            class="selectpicker form-control show-tick dropdown" data-dropup-auto="false"
                                            data-size="5" data-style="btn-primary" data-live-search="true"
                                            title="Elije un producto">
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}">
                                                    {{ $product->code . ' / ' . $product->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-4 mt-3">
                                        <label for="count" class="form-label">Cantidad</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-boxes"></i></span>
                                            </div>
                                            <input required type="number" step="any" name="count" id="count"
                                                class="form-control" placeholder="Ingrese la cantidad"
                                                value="{{ old('count') }}">
                                        </div>
                                    </div>
                                    <div class="col-4 mt-3">
                                        <label for="shop_price" class="form-label">Precio de compra</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                            </div>
                                            <input required type="number" step="any" name="shop_price" id="shop_price"
                                                class="form-control" placeholder="Ingrese el precio"
                                                value="{{ old('shop_price') }}">
                                        </div>
                                    </div>
                                    <div class="col-4 mt-3">
                                        <label for="sale_price" class="form-label">Precio de venta</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                            </div>
                                            <input required type="number" step="any" name="sale_price" id="sale_price"
                                                class="form-control" placeholder="Ingrese el precio"
                                                value="{{ old('sale_price') }}">
                                        </div>
                                    </div>
                                    <div class="col-12 mt-4 text-right">
                                        <button id="btn_add_product" class="btn btn-primary w-25"
                                            type="button">AGREGAR</button>
                                    </div>
                                    <hr style="border: 1px solid lightgrey; width: 95%;" />
                                    <div class="col-12">
                                        <table id="details_table" class="table table-hover">
                                            <thead class="bg-primary">
                                                <tr>
                                                    <th class="text-white">#</th>
                                                    <th class="text-white">Producto</th>
                                                    <th class="text-white">Cantidad</th>
                                                    <th class="text-white">Precio de compra</th>
                                                    <th class="text-white">Precio de venta</th>
                                                    <th class="text-white">Subtotal</th>
                                                    <th class="text-white">DEL</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th>-</th>
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                </tr>
                                            </tbody>
                                            <tfoot class="bg-secondary">
                                                <tr>
                                                    <th></th>
                                                    <th colspan="4" class="text-white">SUMAS</th>
                                                    <th colspan="2" class="text-white"><span id="sums">$0</span>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th></th>
                                                    <th colspan="4" class="text-white">IMPUESTOS</th>
                                                    <th colspan="2" class="text-white"><span
                                                            id="tax_percentage">$0</span>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th></th>
                                                    <th colspan="4" class="text-white">PRECIO TOTAL</th>
                                                    <th colspan="2" class="text-white"><input type="hidden"
                                                            name="total" value="0" id="input_total"><span
                                                            id="total">$0</span>
                                                    </th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="text-white bg-success p-2 text-center rounded-top" style="font-size: 20px;">
                                Datos generales
                            </div>
                            <div class="p-3 border border-3 border-success rounded-bottom">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="supplier_id" class="form-label">Proveedor</label>
                                        <br>
                                        <select name="supplier_id" id="supplier_id"
                                            class="selectpicker form-control show-tick dropdown" data-dropup-auto="false"
                                            data-size="5" data-style="btn-success" data-live-search="true"
                                            title="Elije un proveedor">
                                            @foreach ($suppliers as $supplier)
                                                <option value="{{ $supplier->id }}">
                                                    {{ $supplier->people->social_reason }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('supplier_id')
                                            <small class="text-danger">{{ '* ' . $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-12 mt-3">
                                        <label for="voucher_id" class="form-label">Tipo de comprobante</label>
                                        <br>
                                        <select name="voucher_id" id="voucher_id"
                                            class="selectpicker form-control show-tick dropdown" data-dropup-auto="false"
                                            data-size="5" data-style="btn-success" data-live-search="false"
                                            title="Elije un tipo de comprobante">
                                            @foreach ($vouchers as $voucher)
                                                <option value="{{ $voucher->id }}">
                                                    {{ strtoupper($voucher->voucher_type) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('voucher_id')
                                            <small class="text-danger">{{ '* ' . $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-12 mt-3">
                                        <label for="voucher_number" class="form-label">N° de comprobante</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                                            </div>
                                            <input required type="number" step="any" name="voucher_number"
                                                id="voucher_number" class="form-control"
                                                placeholder="Ingrese el N° de comprobante"
                                                value="{{ old('voucher_number') }}">
                                        </div>
                                        @error('voucher_number')
                                            <small class="text-danger">{{ '* ' . $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-6 mt-3">
                                        <label for="tax" class="form-label">Impuesto aplicado</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text border-success"><i
                                                        class="fas fa-money-bill-wave-alt"></i></span>
                                            </div>
                                            <input readonly type="text" name="tax" id="tax"
                                                class="form-control border-success">
                                        </div>
                                    </div>
                                    <div class="col-6 mt-3 mb-3">
                                        <label for="date_time" class="form-label">Fecha actual</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text border-success"><i
                                                        class="fas fa-calendar-minus"></i></span>
                                            </div>
                                            <input readonly type="date" name="date_time" id="date_time"
                                                class="form-control border-success" value="<?php echo date('Y-m-d'); ?>">
                                        </div>
                                    </div>
                                    <div class="col-12 mt-4">
                                        <button type="submit" class="btn btn-success text-center px-4 py-2 w-100"
                                            id="btn_create_shop">CREAR</button>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <button type="button" class="btn btn-danger text-center px-4 py-2 w-100"
                                            id="btn_modal_cancel_shop" data-toggle='modal'
                                            data-target="#confirmModal">CANCELAR</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Confirmar cancelación de compra
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                ¿Estás seguro de cancelar la compra?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="button" id="btn_cancel_shop" class="btn btn-danger "
                                    data-dismiss="modal">Confirmar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>
    <script>
        let counter = 0;
        let subtotal = [];
        let sums = 0;
        let tax_value = 0;
        let total = 0;

        const tax_percentage = 18;
        $(document).ready(function() {
            $('#btn_add_product').click(function() {
                addProduct();
            });

            $('#btn_cancel_shop').click(function() {
                cancelShop();
            });

            disableButtons();

            $('#tax').val(tax_percentage + '%');
        })

        function disableButtons() {
            if (total == 0) {
                $('#btn_create_shop').prop("disabled", true);
                $('#btn_modal_cancel_shop').prop("disabled", true);
            } else {
                $('#btn_create_shop').prop("disabled", false);
                $('#btn_modal_cancel_shop').prop("disabled", false);
            }
        }

        function addProduct() {
            let id_product = $('#product_id').val();
            let name_product = ($('#product_id option:selected').text()).split(' / ')[1];
            let count = $('#count').val();
            let shop_price = $('#shop_price').val();
            let sale_price = $('#sale_price').val();

            if (name_product != '' && name_product != undefined && count != '' && shop_price != '' && sale_price != '') {
                if (parseInt(count) > 0 && (count % 1 == 0) && parseFloat(shop_price) > 0 && parseFloat(sale_price) > 0) {
                    if (parseFloat(sale_price) > parseFloat(shop_price)) {
                        subtotal[counter] = round(count * shop_price);
                        sums += subtotal[counter];
                        tax_value = round(tax_percentage * (sums / 100));
                        total = round(sums + tax_value);

                        let row = '<tr id="row' + counter + '">' + '<th>' + (counter + 1) + '</th>' +
                            '<td><input type="hidden" name="array_id_product[]" value="' + id_product + '">' +
                            name_product + '</td>' + '<td><input type="hidden" name="array_count[]" value="' +
                            count + '">' +
                            count +
                            '</td>' + '<td><input type="hidden" name="array_shop_price[]" value="' + shop_price + '">$' +
                            shop_price + '</td>' + '<td><input type="hidden" name="array_sale_price[]" value="' +
                            sale_price + '">$' + sale_price + '</td>' +
                            '<td>$' + subtotal[
                                counter] +
                            '</td>' +
                            '<td>' +
                            '<button class="btn btn-danger rounded-circle" type="button" onClick="deleteProduct(' +
                            counter + ')"><i class="fas fa-trash-alt"></i></button>' +
                            '</td>' + '</tr>';

                        $('#details_table').append(row);
                        clearData();
                        counter++;
                        disableButtons();

                        $('#sums').html('$' + sums);
                        $('#tax_percentage').html('$' + tax_value);
                        $('#total').html('$' + total);
                        $('#tax').val('$' + tax_value);
                    } else {
                        showModal('El precio de venta no puede ser menor o igual al precio de compra');
                    }
                } else {
                    showModal('Valores incorrectos');
                }
            } else {
                showModal('Llene los campos faltantes');
            }
        }

        function deleteProduct(index) {
            sums -= round(subtotal[index]);
            tax_value = round(sums / 100 * tax_percentage);
            total = round(sums + tax_value);

            $('#sums').html('$' + sums);
            $('#tax_percentage').html('$' + tax_value);
            $('#total').html('$' + total);
            if (tax_value == 0) {
                $('#tax').val(tax_percentage + '%');
            } else {
                $('#tax').val('$' + tax_value);
            }

            $('#row' + index).remove();
            disableButtons();
        }

        function cancelShop() {
            $('#details_table tbody').empty();
            let row = '<tr>' + '<th>-</th>' + '<td>-</td>' + '<td>-</td>' + '<td>-</td>' + '<td>-</td>' + '<td>-</td>' +
                '<td>-</td>' + '</tr>'
            $('#details_table').append(row);

            counter = 0;
            subtotal = [];
            sums = 0;
            tax_value = 0;
            total = 0;

            $('#sums').html('$' + sums);
            $('#tax_percentage').html('$' + tax_value);
            $('#total').html('$' + total);
            $('#tax').val(tax_percentage + '%');

            clearData();
            disableButtons();
        }

        function clearData() {
            let select = $('#product_id');
            select.selectpicker();
            select.selectpicker('val', '');
            $('#count').val('');
            $('#shop_price').val('');
            $('#sale_price').val('');
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

        function showModal(message, icon = 'error') {
            const Toast = Swal.mixin({
                toast: true,
                position: "top",
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: icon,
                title: message
            });
        }
    </script>
@endpush
