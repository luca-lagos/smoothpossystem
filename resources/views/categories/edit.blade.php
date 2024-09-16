@extends('template')
@section('title','Editar categoría')
@push('css')
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        #description{
            resize: none !important;
        }
    </style>
@endpush
@section('content')
    <div class="container-fluid mb-4">
        <h1 class="h3 mb-3 text-gray-800">Editar categoría</h1>
        <ol class="breadcrumb mb-3">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
           <li class="breadcrumb-item"> <a href="{{route('categories.index')}}">Categorías</a></li>
            <li class="breadcrumb-item active">Editar categoría</li>
        </ol>
        <div class="w-100 mt-3 border border-3 border-primary rounded p-4">
            <form action="{{ route('categories.update',['category' => $category]) }}" method="post">
                @method('PATCH')
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Ingrese un nombre" value="{{old('name',$category->characteristic->name)}}">
                        @error('name')
                            <small class="text-danger">{{'* '.$message}}</small>
                        @enderror
                    </div>
                    <div class="col-md-12 mt-3">
                        <label for="description" class="form-label">Descripción</label>
                        <textarea name="description" id="description" rows="10" class="form-control">{{old('description',$category->characteristic->description)}}</textarea>
                        @error('description')
                            <small class="text-danger">{{'* '.$message}}</small>
                        @enderror
                    </div>
                    <div class="col-md-12 text-right mt-3">
                        <button type="submit" class="btn btn-primary text-center px-4 py-2">ACTUALIZAR</button>
                        <button type="reset" class="btn btn-secondary text-center px-4 py-2">REINICIAR</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('js')
    
@endpush