@extends('template')
@section('title', 'Productos')
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
        <h1 class="h3 mb-3 text-gray-800">Productos</h1>
        <ol class="breadcrumb mb-3">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Productos</li>
        </ol>
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h5 class="m-0 font-weight-bold text-primary">Listado de elementos</h5>
                <a href="{{ route('products.create') }}"><button type="button" class="btn btn-primary">CREAR UN
                        PRODUCTO</button></a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Categoría</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Marca</th>
                                <th>Presentación</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->code }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>
                                        @foreach ($product->categories as $category)
                                            <div class="container" style="font-size: small;">
                                                <div class="row">
                                                    <span
                                                        class="m-1 rounded-pill p-1 bg-secondary text-white text-center">{{ $category->characteristic->name }}</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </td>
                                    <td>${{ $product->price }}</td>
                                    <td>{{ $product->count }}</td>
                                    <td>{{ $product->brand->characteristic->name }}</td>
                                    <td>{{ $product->presentation->characteristic->name }}</td>
                                    <td>
                                        @if ($product->status == 1 && $product->count > 0)
                                            <span class="fw-bolder p-1 rounded bg-success text-white">ACTIVO</span>
                                        @endif
                                        @if ($product->status == 0 && $product->count > 0)
                                            <span class="fw-bolder p-1 rounded bg-danger text-white">NO ACTIVO</span>
                                        @endif
                                        @if ($product->count == 0)
                                            <span class="fw-bolder p-1 rounded bg-warning text-white">SIN STOCK</span>
                                        @endif
                                    </td>
                                    <td class="d-flex justify-content-center align-items-center">
                                        <div class="btn-group">
                                            <button class="btn btn-info rounded px-4 mr-1" data-toggle="modal"
                                                data-target="#showModal-{{ $product->id }}"><i
                                                    class="fas fa-eye"></i></button>
                                            <form action="{{ route('products.edit', ['product' => $product]) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-warning rounded px-4 ml-1 mr-1"><i
                                                        class="fas fa-edit"></i></button>
                                            </form>
                                            @if ($product->status == 1 && $product->count > 0)
                                                <button class="btn btn-danger rounded px-4 ml-1" data-toggle="modal"
                                                    data-target="#confirmModal-{{ $product->id, $product->name }}"><i
                                                        class="fa fa-trash"></i></button>
                                            @endif
                                            @if ($product->status == 0 && $product->count > 0)
                                                <button class="btn btn-success rounded px-4 ml-1" data-toggle="modal"
                                                    data-target="#confirmModal-{{ $product->id, $product->name }}"><i
                                                        class="fas fa-undo-alt"></i></button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                <!-- Show modal -->
                                <div class="modal fade" id="showModal-{{ $product->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Detalles del producto
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <p><span style="font-weight: bolder">Descripción:
                                                            </span>
                                                            @if ($product->description != null)
                                                                {{ $product->description }}
                                                            @else
                                                                -
                                                            @endif
                                                        </p>
                                                    </div>
                                                    <div class="col-12">
                                                        <p><span style="font-weight: bolder">Fecha de vencimiento:
                                                            </span>{{ $product->expiration_date == '' ? 'N/A' : $product->expiration_date }}
                                                        </p>
                                                    </div>
                                                    <div class="col-12">
                                                        <p style="font-weight: bolder">Imagen:</p>
                                                        <div class="d-flex justify-content-center">
                                                            @if ($product->image_path != null)
                                                                <img id="image_path"
                                                                    src="{{ Storage::url('public/products/' . $product->image_path) }}"
                                                                    alt="{{ $product->name }}"
                                                                    class="img-fluid img-thumbnail border-4 rounded">
                                                            @else
                                                                <img src="" alt="{{ $product->name }}">
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Confirmation modal -->
                                <div class="modal fade" id="confirmModal-{{ $product->id, $product->name }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        @if ($product->status == 1)
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
                                                    ¿Estás seguro de desactivar el producto
                                                    "{{ $product->name }}"?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Cerrar</button>
                                                    <form
                                                        action="{{ route('products.destroy', ['product' => $product->id]) }}"
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
                                                    ¿Estás seguro de activar el producto
                                                    "{{ $product->name }}"?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Cerrar</button>
                                                    <form
                                                        action="{{ route('products.destroy', ['product' => $product->id]) }}"
                                                        method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger">Activar</button>
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
