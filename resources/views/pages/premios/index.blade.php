@extends('adminlte::page')

@section('title', 'premios')

@section('content')
    <section class="content">
        <div class="container-fluid p-4">
            <div class="card">
                <div class="card-header justify-content-between">
                    <div class="row justify-content-between">
                        <div class="col-xs-4 my-auto">
                            <h3 class="card-title my-auto">
                                <strong>LISTA DE PREMIOS</strong>
                                <a class="btn"
                                    href="{{ route('premios.index') }}">
                                    <i class="fas fa-sync fa-md fa-fw"></i>
                                </a>
                            </h3>
                        </div>

                        <div class="col-xs">
                            <button data-toggle="modal" data-target="#formCreateModal" class="btn btn-primary"
                                type="button">Nuevo</button>
                        </div>
                        <div class="modal fade" id="formCreateModal" tabindex="-1" aria-labelledby="formCreateLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="fomrCreateLabel">Registrar nuevo premio</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        @include('partials.premios.form_create')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card-body p-0">
                    @if ($premios->count())
                        <table class="table table-hover table-head-fixed">
                            <thead class="table-light ">
                                <tr>
                                    <th>NOMBRE</th>
                                    <th>STOCK</th>
                                    <th>PUNTOS</th>
                                    <th>ESTADO</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($premios as $premio)
                                    <tr>
                                        <td><a href="{{ route('premios.show', $premio) }}">{{ $premio->nombre }}</a></td>
                                        <td class="{{ ($premio->stock == 0) ? 'text-danger' : ''}}">{{ ($premio->stock == 0) ? 'Agotado' : $premio->stock}}</td>
                                        <td>{{ $premio->puntos_requeridos }}</td>
                                        <td><span
                                                class="badge {{ $premio->estado ? 'bg-success' : 'bg-secondary' }}">{{ $premio->estado ? 'ACTIVO' : 'INACTIVO' }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex px-4 py-2 flex-row-reverse">
                            {{ $premios->links() }}
                        </div>
                    @else
                        <p class="text-center py-2">
                            No se encontraron premios
                        </p>
                    @endif
                </div>

            </div>
        </div>

    </section>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            desactivar_unidades();
            $('#producto_id').on('change', function() {
                desactivar_unidades();
            })

            function desactivar_unidades() {
                if (!$('#producto_id').val()) {
                    $('#unidades').prop("disabled", true);
                    $('#unidades').val('');
                } else {
                    $('#unidades').prop("disabled", false);
                    $('#unidades').prop("required", true);
                }
            }
        });
    </script>
@stop
