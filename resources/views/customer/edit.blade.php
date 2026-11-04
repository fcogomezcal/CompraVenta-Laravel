
@extends('layouts.app')

@section('title', 'Editar cliente')

@section('content')

<div class="page-content">
    <div class="container-fluid">

        {{-- Título de la página --}}
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">

                    <h4 class="mb-sm-0">Editar cliente</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">
                                    Mantenimiento
                                </a>
                            </li>

                            <li class="breadcrumb-item">
                                <a href="{{ route('customers.index') }}">
                                    Clientes
                                </a>
                            </li>

                            <li class="breadcrumb-item active">
                                Editar cliente
                            </li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

        {{-- Formulario --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="card">

                    <div class="card-header">
                        <h4 class="card-title mb-0">
                            Datos del cliente
                        </h4>
                    </div>

                    <div class="card-body">

                        {{-- Errores de validación --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Revisa los siguientes campos:</strong>

                                <ul class="mb-0 mt-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form
                            action="{{ route('customers.update', $customer->id) }}"
                            method="POST"
                            enctype="multipart/form-data">

                            @csrf
                            @method('PUT')

                            <div class="row">

                                {{-- RUC --}}
                                <div class="col-md-6 mb-3">
                                    <label for="ruc" class="form-label">
                                        RUC
                                    </label>

                                    <input
                                        type="text"
                                        class="form-control @error('ruc') is-invalid @enderror"
                                        id="ruc"
                                        name="ruc"
                                        value="{{ old('ruc', $customer->ruc) }}"
                                        placeholder="Ingresa el RUC del cliente">

                                    @error('ruc')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- Nombre --}}
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">
                                        Nombre completo
                                    </label>

                                    <input
                                        type="text"
                                        class="form-control @error('name') is-invalid @enderror"
                                        id="name"
                                        name="name"
                                        value="{{ old('name', $customer->name) }}"
                                        placeholder="Ingresa el nombre del cliente"
                                        required>

                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- Correo electrónico --}}
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">
                                        Correo electrónico
                                    </label>

                                    <input
                                        type="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        id="email"
                                        name="email"
                                        value="{{ old('email', $customer->email) }}"
                                        placeholder="ejemplo@correo.com">

                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- Teléfono --}}
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">
                                        Teléfono
                                    </label>

                                    <input
                                        type="text"
                                        class="form-control @error('phone') is-invalid @enderror"
                                        id="phone"
                                        name="phone"
                                        value="{{ old('phone', $customer->phone) }}"
                                        placeholder="Ingresa el teléfono"
                                        required>

                                    @error('phone')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- Dirección --}}
                                <div class="col-md-12 mb-3">
                                    <label for="address" class="form-label">
                                        Dirección
                                    </label>

                                    <textarea
                                        class="form-control @error('address') is-invalid @enderror"
                                        id="address"
                                        name="address"
                                        rows="3"
                                        placeholder="Ingresa la dirección del cliente"
                                        required>{{ old('address', $customer->address) }}</textarea>

                                    @error('address')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- Fotografía actual --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        Fotografía actual
                                    </label>

                                    <div class="mb-3">
                                        @if ($customer->photo)
                                            <img
                                                src="{{ asset('storage/' . $customer->photo) }}"
                                                alt="Foto de {{ $customer->name }}"
                                                class="rounded"
                                                width="120"
                                                height="120"
                                                style="object-fit: cover;">
                                        @else
                                            <p class="text-muted mb-0">
                                                El cliente no tiene fotografía.
                                            </p>
                                        @endif
                                    </div>

                                    <label for="photo" class="form-label">
                                        Cambiar fotografía
                                    </label>

                                    <input
                                        type="file"
                                        class="form-control @error('photo') is-invalid @enderror"
                                        id="photo"
                                        name="photo"
                                        accept="image/*">

                                    <div class="form-text">
                                        Opcional. Si no seleccionas una imagen,
                                        se conservará la fotografía actual.
                                    </div>

                                    @error('photo')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- Estado --}}
                                <div class="col-md-6 mb-3">
                                    <label for="status" class="form-label">
                                        Estado
                                    </label>

                                    <select
                                        class="form-select @error('status') is-invalid @enderror"
                                        id="status"
                                        name="status"
                                        required>

                                        <option value="active"
                                            {{ old('status', $customer->status) === 'active' ? 'selected' : '' }}>
                                            Activo
                                        </option>

                                        <option value="inactive"
                                            {{ old('status', $customer->status) === 'inactive' ? 'selected' : '' }}>
                                            Inactivo
                                        </option>

                                    </select>

                                    @error('status')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>

                            {{-- Botones --}}
                            <div class="d-flex gap-2 mt-3">

                                <button type="submit" class="btn btn-success">
                                    <i class="ri-save-line align-middle me-1"></i>
                                    Actualizar cliente
                                </button>

                                <a href="{{ route('customers.index') }}"
                                   class="btn btn-secondary">
                                    <i class="ri-arrow-left-line align-middle me-1"></i>
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

@push('scripts')
<script>
    $(document).ready(function() {
        $('#status').select2({
            width: 'resolve' // O alternativamente usar 'resolve' en lugar de '100%'
        });
    })
</script>
@endpush