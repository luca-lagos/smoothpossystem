@extends('template')
@section('title', 'Editar proveedor')
@push('css')
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endpush
@section('content')
    <div class="container-fluid mb-4">
        <h1 class="h3 mb-3 text-gray-800">Editar proveedor</h1>
        <ol class="breadcrumb mb-3">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"> <a href="{{ route('suppliers.index') }}">Clientes</a></li>
            <li class="breadcrumb-item active">Editar proveedor</li>
        </ol>
        <div class="w-100 mt-3 border border-3 border-primary rounded p-4">
            <form action="{{ route('suppliers.update', ['supplier' => $supplier]) }}" method="post">
                @method('PATCH')
                @csrf
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="person_type" class="form-label">Tipo de proveedor</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user-alt"></i></span>
                            </div>
                            <input disabled type="text" name="person_type" id="person_type" class="form-control font-weight-bold"
                                value="{{ old('person_type', strtoupper($supplier->people->person_type)) }}">
                        </div>
                        @error('person_type')
                            <small class="text-danger">{{ '* ' . $message }}</small>
                        @enderror
                    </div>
                    <div id="box_social_reason" class="col-md-4">
                        @if ($supplier->people->person_type == 'fisica')
                            <label id="label_person_name" for="social_reason" class="form-label">Nombre de la persona</label>
                        @else
                            <label id="label_company_name" for="social_reason" class="form-label">Nombre de la
                                empresa</label>
                        @endif
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    @if ($supplier->people->person_type == 'fisica')
                                        <i id="icon_person" class="fas fa-user"></i>
                                    @else
                                        <i id="icon_company" class="fas fa-building"></i>
                                    @endif
                                </span>
                            </div>
                            <input type="text" name="social_reason" id="social_reason" class="form-control"
                                placeholder="Ingrese el nombre"
                                value="{{ old('social_reason', $supplier->people->social_reason) }}">
                        </div>
                        @error('social_reason')
                            <small class="text-danger">{{ '* ' . $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="location" class="form-label">Dirección</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-location-arrow"></i></span>
                            </div>
                            <input type="text" name="location" id="location" class="form-control"
                                placeholder="Ingrese la dirección" value="{{ old('location', $supplier->people->location) }}">
                        </div>
                        @error('location')
                            <small class="text-danger">{{ '* ' . $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mt-3">
                        <label for="document_id" class="form-label">Tipo de documento</label>
                        <br>
                        <select name="document_id" id="document_id" class="selectpicker form-control show-tick dropdown"
                            data-dropup-auto="false" data-size="5" data-style="btn-primary" data-live-search="false"
                            title="Elija un tipo de documento">
                            @foreach ($documents as $document)
                                @if ($supplier->people->document_id == $document->id)
                                    <option value="{{ $document->id }}" selected>{{ $document->document_type }}</option>
                                @else
                                    <option value="{{ $document->id }}">{{ $document->document_type }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('document_id')
                            <small class="text-danger">{{ '* ' . $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4 mt-3">
                        <label for="document_number" class="form-label">Número de documento</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-address-card"></i></span>
                            </div>
                            <input type="number" step="any" name="document_number" id="document_number"
                                class="form-control" placeholder="Ingrese el número de documento"
                                value="{{ old('document_number', $supplier->people->document_number) }}">
                        </div>
                        @error('document_number')
                            <small class="text-danger">{{ '* ' . $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-12 text-right mt-3">
                        <button type="submit" class="btn btn-primary text-center px-4 py-2">EDITAR</button>
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
        $(document).ready(function() {
            $("#person_type").on("change", function(e) {
                let selectValue = $(this).val();
                if (selectValue == "fisica") {
                    $("#label_company_name").hide();
                    $("#icon_company").hide();
                    $("#label_person_name").show();
                    $("#icon_person").show();
                } else {
                    $("#label_person_name").hide();
                    $("#icon_person").hide();
                    $("#label_company_name").show();
                    $("#icon_company").show();
                }
                $("#box_social_reason").show();
                $("#box_document_type").last().addClass("mt-3");
            });
        })
    </script>
@endpush
