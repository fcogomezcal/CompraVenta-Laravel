
@extends('layouts.app')

@section('title', 'Mantenimiento de clientes')

@section('content')

<div class="page-content">
    <div class="container-fluid">

        {{-- Título de la página --}}
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Listado de clientes</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">Mantenimiento</a>
                            </li>
                            <li class="breadcrumb-item active">Clientes</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        {{-- Contenido --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="card">

                    {{-- Encabezado --}}
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Clientes</h4>

                        <a href="{{ route('customers.create') }}"
                           class="btn btn-success">
                            <i class="ri-add-line align-middle me-1"></i>
                            Nuevo cliente
                        </a>
                    </div>

                    {{-- Cuerpo --}}
                    <div class="card-body">

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show"
                                 role="alert">
                                {{ session('success') }}

                                <button type="button"
                                        class="btn-close"
                                        data-bs-dismiss="alert"
                                        aria-label="Cerrar">
                                </button>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show"
                                 role="alert">
                                {{ session('error') }}

                                <button type="button"
                                        class="btn-close"
                                        data-bs-dismiss="alert"
                                        aria-label="Cerrar">
                                </button>
                            </div>
                        @endif

                        {{-- Tabla --}}
                        <div class="table-responsive">
                            <table id="tablaCustomers"
                                   class="table table-bordered table-hover align-middle">

                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Foto</th>
                                        <th>RUC</th>
                                        <th>Nombre</th>
                                        <th>Correo</th>
                                        <th>Teléfono</th>
                                        <th>Dirección</th>
                                        <th>Estado</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($customers as $customer)
                                        <tr>
                                            <td>{{ $customer->id }}</td>

                                            <td class="text-center">
                                                @if ($customer->photo)
                                                    @php
                                                        $foto = $customer->photo;

                                                        $esUrlExterna = filter_var(
                                                            $foto,
                                                            FILTER_VALIDATE_URL
                                                        );

                                                        $fotoUrl = $esUrlExterna
                                                            ? $foto
                                                            : asset('storage/' . $foto);
                                                    @endphp

                                                    <img
                                                        src="{{ $fotoUrl }}"
                                                        alt="Foto de {{ $customer->name }}"
                                                        class="rounded-circle"
                                                        width="45"
                                                        height="45"
                                                        style="object-fit: cover; display: inline-block;"
                                                        onerror="this.style.display='none'; this.nextElementSibling.style.display='inline';"
                                                    >

                                                    <span class="text-muted" style="display: none;">
                                                        Imagen no disponible
                                                    </span>
                                                @else
                                                    <span class="text-muted">Sin foto</span>
                                                @endif
                                            </td>

                                            <td>{{ $customer->ruc ?: 'No registrado' }}</td>
                                            <td>{{ $customer->name }}</td>
                                            <td>{{ $customer->email ?: 'No registrado' }}</td>
                                            <td>{{ $customer->phone }}</td>
                                            <td>{{ $customer->address }}</td>

                                            <td>
                                                @if ($customer->status === 'active')
                                                    <span class="badge bg-success">
                                                        Activo
                                                    </span>
                                                @else
                                                    <span class="badge bg-danger">
                                                        Inactivo
                                                    </span>
                                                @endif
                                            </td>

                                            <td class="text-center text-nowrap">
                                                {{-- Editar --}}

                                                <a href="{{ route('customers.edit', $customer->id) }}"
                                                   class="btn btn-sm btn-primary">
                                                    <i class="ri-edit-line align-middle"></i>
                                                    Editar
                                                </a>

                                                {{-- Editar con solo icono --}}
                                                <!-- <a href="{{ route('customers.edit', $customer->id) }}"
                                                class="btn btn-sm btn-soft-primary"
                                                title="Editar cliente">
                                                    <i class="ri-edit-line align-middle fs-16"></i>
                                                </a> -->

                                                {{-- Eliminar --}}
                                                <form
                                                    action="{{ route('customers.destroy', $customer->id) }}"
                                                    method="POST"
                                                    class="d-inline form-eliminar"
                                                    data-nombre="{{ $customer->name }}">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                            class="btn btn-sm btn-danger">
                                                        <i class="ri-delete-bin-line align-middle"></i>
                                                        Eliminar
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {

        new DataTable('#tablaCustomers', {
            pagingType: 'simple_numbers',
            columnDefs: [
                { orderable: false, targets: [1, 8] } // Deshabilitar ordenamiento en las columnas de foto y acciones
            ],
            language: {
                search: 'Buscar:',
                lengthMenu: 'Mostrar _MENU_ registros',
                info: 'Mostrando _START_ a _END_ de _TOTAL_ registros',
                infoEmpty: 'Mostrando 0 a 0 de 0 registros',
                infoFiltered: '(filtrado de _MAX_ registros)',
                zeroRecords: 'No se encontraron registros',
                emptyTable: 'No hay clientes registrados',
                paginate: {
                    // first: 'Primero',
                    // last: 'Último',
                    next: 'Siguiente',
                    previous: 'Anterior'
                }
            }
        });

        // Confirmación de eliminación con SweetAlert2
        document.addEventListener('submit', function (event) {

            if (!(event.target instanceof HTMLFormElement)) {
                return;
            }

            const formulario = event.target.closest('.form-eliminar');

            if (!formulario) {
                return;
            }

            event.preventDefault();

            const nombre = formulario.dataset.nombre;

            Swal.fire({
                title: '¿Estás seguro?',
                text: `Vas a eliminar al cliente "${nombre}".`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#f06548',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true,
                focusCancel: true
            }).then((resultado) => {
                if (resultado.isConfirmed) {
                    formulario.submit();
                }
            });
        });
    });
</script>
@endpush
