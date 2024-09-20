@extends('template')
@section('title', 'Compras')
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
        <h1 class="h3 mb-3 text-gray-800">Compras</h1>
        <ol class="breadcrumb mb-3">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Compras</li>
        </ol>
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h5 class="m-0 font-weight-bold text-primary">Listado de elementos</h5>
                <a href="{{ route('shops.create') }}"><button type="button" class="btn btn-primary">CREAR UNA
                        COMPRA</button></a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Comprobante</th>
                                <th>Proveedor</th>
                                <th>Fecha y hora</th>
                                <th>Gasto total</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($shops as $shop)
                                <tr>
                                    <td>
                                        <p class="fw-semibold mb-1">{{ $shop->voucher->voucher_type }}</p>
                                        <p class="text-muted mb-0">{{ $shop->voucher_number }}</p>
                                    </td>
                                    <td>
                                        <p class="fw-semibold mb-1">{{ $shop->supplier->people->person_type }}</p>
                                        <p class="text-muted mb-0">{{ $shop->supplier->people->social_reason }}</p>
                                    </td>
                                    <td>{{ $shop->total }}</td>
                                    <td class="d-flex justify-content-center align-items-center">
                                        <div class="btn-group">
                                            <form action="{{ route('shops.edit', ['shop' => $shop]) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-warning rounded px-4 ml-1 mr-1"><i
                                                        class="fas fa-edit"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
    <script>
        $('#dataTable').DataTable({
            'language': {
                'url': '//cdn.datatables.net/plug-ins/2.1.6/i18n/es-MX.json',
            },
        })
    </script>
@endpush
