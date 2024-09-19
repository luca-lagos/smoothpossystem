@extends('template')
@section('title', 'Marcas')
@push('css')
    <!-- Custom styles for this page -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- SweetAlert2 plugin -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        <h1 class="h3 mb-3 text-gray-800">Marcas</h1>
        <ol class="breadcrumb mb-3">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Marcas</li>
        </ol>
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h5 class="m-0 font-weight-bold text-primary">Listado de elementos</h5>
                <a href="{{ route('brands.create') }}"><button type="button" class="btn btn-primary">CREAR UNA
                        MARCA</button></a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $brand)
                                <tr>
                                    <td>{{ $brand->characteristic->name }}</td>
                                    <td>
                                        @if ($brand->characteristic->description != null)
                                            {{ $brand->characteristic->description }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if ($brand->characteristic->status == 1)
                                            <span class="fw-bolder p-1 rounded bg-success text-white">ACTIVO</span>
                                        @else
                                            <span class="fw-bolder p-1 rounded bg-danger text-white">NO ACTIVO</span>
                                        @endif
                                    </td>
                                    <td class="d-flex justify-content-center align-items-center">
                                        <div class="btn-group">
                                            <form action="{{ route('brands.edit', ['brand' => $brand]) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-warning rounded px-4 mr-1"><i
                                                        class="fas fa-edit"></i></button>
                                            </form>
                                            @if ($brand->characteristic->status == 1)
                                                <button class="btn btn-danger rounded px-4 ml-1" data-toggle="modal"
                                                    data-target="#confirmModal-{{ $brand->id, $brand->characteristic->name }}"><i
                                                        class="fa fa-trash"></i></button>
                                            @else
                                                <button class="btn btn-success rounded px-4 ml-1" data-toggle="modal"
                                                    data-target="#confirmModal-{{ $brand->id, $brand->characteristic->name }}"><i
                                                        class="fas fa-undo-alt"></i></button>
                                            @endif

                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal -->
                                <div class="modal fade"
                                    id="confirmModal-{{ $brand->id, $brand->characteristic->name }}"" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        @if ($brand->characteristic->status == 1)
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Confirmar desactivación
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    ¿Estás seguro de desactivar la marca
                                                    "{{ $brand->characteristic->name }}"?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Cerrar</button>
                                                    <form
                                                        action="{{ route('brands.destroy', ['brand' => $brand->id]) }}"
                                                        method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger">Desactivar</button>
                                                    </form>
                                                </div>
                                            </div>
                                        @else
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Confirmar activación
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    ¿Estás seguro de activar la marca
                                                    "{{ $brand->characteristic->name }}"?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Cerrar</button>
                                                    <form
                                                        action="{{ route('brands.destroy', ['brand' => $brand->id]) }}"
                                                        method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-success">Activar</button>
                                                    </form>
                                                </div>
                                            </div>
                                        @endif

                                    </div>
                                </div>
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
