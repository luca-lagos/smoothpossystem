@extends('template')
@section('title', 'Crear prodcucto')
@push('css')
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <style>
        #description {
            resize: none !important;
            height: 390px !important;
        }

        #preview {
            width: 100%;
            height: 300px !important;
            object-fit: cover;
            border-radius: 5px;
        }
    </style>
@endpush
@section('content')
    <div class="container-fluid mb-4">
        <h1 class="h3 mb-3 text-gray-800">Crear producto</h1>
        <ol class="breadcrumb mb-3">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"> <a href="{{ route('products.index') }}">Productos</a></li>
            <li class="breadcrumb-item active">Crear producto</li>
        </ol>
        <div class="w-100 mt-3 border border-3 border-primary rounded p-4">
            <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-md-3">
                        <label for="code" class="form-label">Código</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                            </div>
                            <input type="text" name="code" id="code" class="form-control"
                                placeholder="Ingrese un código" value="{{ old('code') }}">
                        </div>
                        @error('code')
                            <small class="text-danger">{{ '* ' . $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="name" class="form-label">Nombre</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-signature"></i></span>
                            </div>
                            <input type="text" name="name" id="name" class="form-control"
                                placeholder="Ingrese un nombre" value="{{ old('name') }}">
                        </div>
                        @error('name')
                            <small class="text-danger">{{ '* ' . $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="price" class="form-label">Precio</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                            </div>
                            <input type="number" min="1" step="any" name="price" id="price"
                                class="form-control" placeholder="Ingrese un precio" value="{{ old('price') }}">
                        </div>
                        @error('price')
                            <small class="text-danger">{{ '* ' . $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="count" class="form-label">Stock</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-boxes"></i></span>
                            </div>
                            <input type="number" step="any" name="count" id="count"
                                class="form-control" placeholder="Ingrese la cantidad" value="{{ old('count') }}">
                        </div>
                        @error('count')
                            <small class="text-danger">{{ '* ' . $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-9 mt-3">
                        <label for="description" class="form-label">Descripción</label>
                        <textarea name="description" id="description" rows="10" class="form-control">{{ old('description') }}</textarea>
                        @error('description')
                            <small class="text-danger">{{ '* ' . $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-3 mt-3">
                        <label class="form-label">Imagen</label>
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" name="image_path" id="image_path" class="custom-file-input" value="{{old('image_path')}}"
                                    accept="image/*">
                                <label for="image_path" class="custom-file-label" data-browse="Seleccionar">Elije una
                                    imagen</label>
                            </div>
                        </div>
                        <div class="border rounded-lg text-center p-3">
                            <img src="//placehold.it/140?text=IMAGE" id="preview" />
                        </div>

                        @error('image_path')
                            <small class="text-danger">{{ '* ' . $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-3 mt-3">
                        <label for="categories" class="form-label">Categoría</label>
                        <br>
                        <select name="categories[]" id="categories" class="selectpicker form-control show-tick dropup"
                            data-dropup-auto="false" multiple multiple data-actions-box="true" data-size="5"
                            data-style="btn-primary" data-live-search="true" title="Elije una categoría">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{(in_array($category->id, old('categories',[]))) ? 'selected' : ''}}>{{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('categories')
                            <small class="text-danger">{{ '* ' . $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-3 mt-3">
                        <label for="brand_id" class="form-label">Marca</label>
                        <br>
                        <select name="brand_id" id="brand_id" class="selectpicker form-control show-tick dropup"
                            data-dropup-auto="false" data-size="5" data-style="btn-primary" data-live-search="true"
                            title="Elije una marca">
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}"
                                    {{ old('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                            @endforeach
                        </select>
                        @error('brand_id')
                            <small class="text-danger">{{ '* ' . $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-3 mt-3">
                        <label for="presentation_id" class="form-label">Presentación</label>
                        <br>
                        <select name="presentation_id" id="presentation_id" class="selectpicker form-control show-tick dropup"
                            data-dropup-auto="false" data-size="5" data-style="btn-primary" data-live-search="true"
                            title="Elije una presentación">
                            @foreach ($presentations as $p)
                                <option value="{{ $p->id }}"
                                    {{ old('presentation_id') == $p->id ? 'selected' : '' }}>{{ $p->name }}</option>
                            @endforeach
                        </select>
                        @error('presentation_id')
                            <small class="text-danger">{{ '* ' . $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-3 mt-3">
                        <label for="expiration_date" class="form-label">Fecha de expiración</label>
                        <input type="date" name="expiration_date" id="expiration_date" class="form-control"
                            placeholder="Elija la fecha de expiración" value="{{ old('expiration_date') }}">
                        @error('expiration_date')
                            <small class="text-danger">{{ '* ' . $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-12 text-right mt-3">
                        <button type="submit" class="btn btn-primary text-center px-4 py-2">CREAR</button>
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

            // input plugin
            bsCustomFileInput.init();

            // get file and preview image
            $("#image_path").on('change', function() {
                var input = $(this)[0];
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#preview').attr('src', e.target.result).fadeIn('slow');
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            })

        })
    </script>
@endpush
