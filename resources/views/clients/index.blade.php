@extends('template')
@section('title', 'Clientes')
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
        <h1 class="h3 mb-3 text-gray-800">Clientes</h1>
        <ol class="breadcrumb mb-3">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Clientes</li>
        </ol>
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h5 class="m-0 font-weight-bold text-primary">Listado de elementos</h5>
                <a href="{{ route('clients.create') }}"><button type="button" class="btn btn-primary">CREAR UN
                        CLIENTE</button></a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Razón social</th>
                                <th>Tipo de persona</th>
                                <th>Documento</th>
                                <th>Tipo de documento</th>
                                <th>Dirección</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clients as $client)
                                <tr>
                                    <td>{{ $client->people->social_reason }}</td>
                                    <td>{{ $client->people->person_type }}</td>
                                    <td>{{ $client->people->document_number }}</td>
                                    <td>{{ $client->people->document->document_type }}</td>
                                    <td>{{ $client->people->location }}</td>
                                    <td>
                                        @if ($client->people->status == 1)
                                            <span class="fw-bolder p-1 rounded bg-success text-white">ACTIVO</span>
                                        @else
                                            <span class="fw-bolder p-1 rounded bg-danger text-white">NO ACTIVO</span>
                                        @endif
                                    </td>
                                    <td class="d-flex justify-content-center align-items-center">
                                        <div class="btn-group">
                                            <form action="{{ route('clients.edit', ['client' => $client]) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-warning rounded px-4 ml-1 mr-1"><i
                                                        class="fas fa-edit"></i></button>
                                            </form>
                                            @if ($client->people->status == 1)
                                                <button class="btn btn-danger rounded px-4 ml-1" data-toggle="modal"
                                                    data-target="#confirmModal-{{ $client->id, $client->social_reason }}"><i
                                                        class="fa fa-trash"></i></button>
                                            @else
                                                <button class="btn btn-success rounded px-4 ml-1" data-toggle="modal"
                                                    data-target="#confirmModal-{{ $client->id, $client->social_reason }}"><i
                                                        class="fas fa-undo-alt"></i></button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                                <!-- Confirmation modal -->
                                <div class="modal fade" id="confirmModal-{{ $client->id}}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        @if ($client->people->status == 1)
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
                                                    ¿Estás seguro de desactivar al cliente
                                                    "{{ $client->people->social_reason }}"?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Cerrar</button>
                                                    <form
                                                        action="{{ route('clients.destroy', ['client' => $client->people->id]) }}"
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
                                                    ¿Estás seguro de activar al cliente
                                                    "{{ $client->people->social_reason }}"?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Cerrar</button>
                                                    <form
                                                        action="{{ route('clients.destroy', ['client' => $client->people->id]) }}"
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
@endpush
