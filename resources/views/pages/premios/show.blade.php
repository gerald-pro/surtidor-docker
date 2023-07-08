@extends('adminlte::page')

@section('title', 'Informacion del premio')

@section('content')
     <section class="content">
        <div class="container-fluid py-4">
            <div class="card card-purple card-outline">
                <div class="card-header">
                    <div class="row justify-content-between">
                        <div class="col-xs-4 my-auto">
                            <h4 class="my-auto">
                                <strong>{{ $premio->nombre }}</strong>
                            </h4>
                            <p class="my-auto text-muted">
                                Premio
                            </p>
                        </div>
                        <div class="col-xs-2 text-right">
                            <span class="fa fa-gift fa-4x"></span>
                        </div>
                    </div>
                </div>

                <div class="card-footer text-muted text-sm">
                    <div class="d-flex justify-content-between my-n2">
                        <p class="my-auto"><small>Registrado: {{ $premio->created_at }}</small></p>
                        <p class="my-auto"><small>Ultima modificación: {{ ' ' . $premio->updated_at . '  ' }}</small></p>
                    </div>
                </div>

            </div>

            <div class="card card-purple card-tabs">
                <div class="card-header p-0 pt-1">
                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link {{ $errors->any() ? '' : 'active' }}" id="datos_premio_tab"
                                data-toggle="pill" href="#datos_premio" role="tab" aria-controls="datos_premio"
                                aria-selected="{{ $errors->any() ? 'false' : 'true' }}">Datos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $errors->any() ? 'active' : '' }}" id="datos_premio_edit_tab"
                                data-toggle="pill" href="#datos_premio_edit" role="tab"
                                aria-controls="datos_premio_edit" aria-selected="false">Editar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="datos_premio_delete_tab" data-toggle="pill" href="#datos_premio_delete"
                                role="tab" aria-controls="datos_premio_delete" aria-selected="false">Eliminar</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-one-tabContent">
                        <div class="tab-pane fade {{ $errors->any() ? '' : 'show active' }}" id="datos_premio"
                            role="tabpanel" aria-labelledby="datos_premio_tab">
                            @include('partials.premios.show_datos')
                        </div>

                        <div class="tab-pane fade {{ $errors->any() ? 'show active' : '' }}" id="datos_premio_edit"
                            role="tabpanel" aria-labelledby="datos_premio_edit_tab">
                            @include('partials.premios.form_edit')
                        </div>

                        <div class="tab-pane fade" id="datos_premio_delete" role="tabpanel"
                            aria-labelledby="datos_premio_delete_tab">
                            <p>Eliminar premio con todos sus canjeos</p>
                            <hr>
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-danger px-2" data-toggle="modal"
                                    data-target="#modal-delete-premio">
                                    Eliminar
                                </button>
                            </div>

                            <x-alert-confirmation titulo="¿Estás seguro?" id="modal-delete-premio">
                                <x-slot name="mensaje">
                                        Esta accion es irreversible<br>
                                        Se eliminará el premio '{{ $premio->nombre }}' y todos los canjeos
                                        registrados
                                        
                                    </p>
                                </x-slot>

                                <x-slot name="boton">
                                    <form action="{{ route('premios.destroy', $premio) }}" method="POST" id="form_delete_premio">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class ="btn btn-danger">Eliminar</button>
                                    </form>
                                </x-slot>
                            </x-alert-confirmation>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card card-purple">
                <div class="card-header">
                    <div class="row justify-content-between">
                        <div class="col-xs-4">
                            <h3 class="card-title mt-1">Canjeos</h3>
                        </div>
                        <div class="card-tools my-auto mx-n1">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card-body p-0">
                    @include('partials.premios.table_canjeos')
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
                    $('#unidades_producto').prop("disabled", true);
                    $('#unidades_producto').val('');
                } else {
                    $('#unidades_producto').prop("disabled", false);
                    $('#unidades_producto').prop("required", true);
                }
            }
        });
    </script>
@stop
