@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Crear Categoria</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Mantenimiento</a></li>
                            <li class="breadcrumb-item active">Categoria</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('categorias.store') }}" method="POST">
                                @csrf
                                <!-- Nombre -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">
                                        Nombre de la categoría
                                    </label>
                                    <input
                                        type="text"
                                        class="form-control @error('name') is-invalid @enderror"
                                        id="name"
                                        name="name"
                                        value="{{ old('name') }}"
                                        placeholder="Ingresa el nombre de la categoría"
                                        required>
                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <!-- Descripción -->
                                <div class="mb-3">
                                    <label for="description" class="form-label">
                                        Descripción
                                    </label>
                                    <textarea
                                        class="form-control @error('description') is-invalid @enderror"
                                        id="description"
                                        name="description"
                                        rows="4"
                                        placeholder="Ingresa una descripción">{{ old('description') }}</textarea>
                                    @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <!-- Botones -->
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-success">
                                        <i class="ri-save-line align-middle me-1"></i>
                                        Guardar
                                    </button>
                                    <a href="{{ route('categorias.index') }}"
                                        class="btn btn-secondary">
                                        Cancelar
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>

@endsection