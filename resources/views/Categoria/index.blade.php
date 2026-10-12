@extends('layouts.app')

@section('title', 'Mantenimiento de categorías')

@section('content')

<div class="page-content">
    <div class="container-fluid">
        <!-- Título de la página -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">
                        Listado de categorías
                    </h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">
                                    Mantenimiento
                                </a>
                            </li>
                            <li class="breadcrumb-item active">
                                Categorías
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contenido -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <!-- Encabezado de la tarjeta -->
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">
                            Categorías
                        </h4>
                        <a href="{{ route('categorias.create') }}"
                            class="btn btn-success">
                            <i class="ri-add-line align-middle me-1"></i>
                            Nueva Categoría
                        </a>
                    </div>
                    <!-- Cuerpo de la tarjeta -->
                    <div class="card-body">
                        {{-- Mensaje de éxito --}}
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
                        <!-- Tabla -->
                        <div class="table-responsive">
                            <table id="tablaCategorias" class="table table-bordered table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th class="text-center">
                                            Acciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($categorias as $categoria)
                                    <tr>
                                        <!-- ID -->
                                        <td>
                                            {{ $categoria->id }}
                                        </td>
                                        <!-- Nombre -->
                                        <td>
                                            {{ $categoria->name }}
                                        </td>
                                        <!-- Descripción -->
                                        <td>
                                            {{ $categoria->description ?? 'Sin descripción' }}
                                        </td>
                                        <!-- Acciones -->
                                        <td class="text-center">
                                            <!-- Editar -->
                                            <a href="{{ route('categorias.edit', $categoria->id) }}"
                                                class="btn btn-sm btn-primary">
                                                <i class="ri-edit-line align-middle"></i>
                                                Editar
                                            </a>
                                            <!-- Eliminar -->
                                            <!-- <form action="{{ route('categorias.destroy', $categoria->id) }}"
                                                method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-sm btn-danger"
                                                    onclick="return confirm('¿Está seguro de eliminar esta categoría?')">
                                                    <i class="ri-delete-bin-line align-middle"></i>
                                                    Eliminar
                                                </button>
                                            </form> -->
                                            <form action="{{ route('categorias.destroy', $categoria->id) }}"
                                                method="POST"
                                                class="d-inline form-eliminar"
                                                data-nombre="{{ $categoria->name }}">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="ri-delete-bin-line align-middle"></i>
                                                    Eliminar
                                                </button>

                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4"
                                            class="text-center text-muted py-4">
                                            No hay categorías registradas.
                                        </td>
                                    </tr>
                                    @endforelse
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
    document.addEventListener('DOMContentLoaded', function() {
        new DataTable('#tablaCategorias', {
            language: {
                search: "Buscar:",
                lengthMenu: "Mostrar _MENU_ registros",
                info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
                infoEmpty: "Mostrando 0 a 0 de 0 registros",
                infoFiltered: "(filtrado de _MAX_ registros)",
                zeroRecords: "No se encontraron registros",
                emptyTable: "No hay categorías registradas",
                paginate: {
                    first: "Primero",
                    last: "Último",
                    next: "Siguiente",
                    previous: "Anterior"
                }
            }
        });

        // Manejar el evento de envío del formulario de eliminación
        document.addEventListener('submit', function (event) {

            if (!(event.target instanceof HTMLFormElement)) {
                return;
            }

            const formulario = event.target.closest('.form-eliminar');

            if (!formulario) {
                return;
            }

            event.preventDefault();

            const nombreCategoria = formulario.dataset.nombre;

            Swal.fire({
                title: '¿Estás seguro?',
                text: `Vas a eliminar la categoría "${nombreCategoria}".`,
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