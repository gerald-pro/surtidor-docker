@extends('adminlte::page')

@section('title', 'Clientes')

@section('content')
    <section class="content">
        <div class="container-fluid py-4">
            <div class="card card-cyan card-outline">
                <div class="card-header">
                    <div class="row justify-content-between">
                        <div class="col-xs-4 my-auto">
                            <h4 class="my-auto ">
                                <strong>{{ $cliente->nombre . ' ' . $cliente->apellido }}</strong>
                            </h4>
                            <p class="my-auto text-muted">
                                Cliente
                            </p>
                        </div>
                        <div class="col-xs-2 text-right">
                            <span class="fa fa-address-card fa-4x"></span>
                        </div>
                    </div>
                </div>

                <div class="card-footer text-muted text-sm">
                    <div class="d-flex justify-content-between my-n2">
                        <p class="my-auto"><small>Registrado: {{ $cliente->created_at }}</small></p>
                        <p class="my-auto"><small>Ultima modificación: {{ ' ' . $cliente->updated_at . '  ' }}</small></p>
                    </div>
                </div>
            </div>

            <div class="card card-cyan card-tabs">
                <div class="card-header p-0 pt-1">
                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link {{ $errors->cliente->any() ? '' : 'active' }}" id="datos_cliente_tab"
                                data-toggle="pill" href="#datos_cliente" role="tab"
                                aria-controls="datos_cliente">Datos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $errors->cliente->any() ? 'active' : '' }}" id="datos_cliente_edit_tab"
                                data-toggle="pill" href="#datos_cliente_edit" role="tab"
                                aria-controls="datos_cliente_edit">Editar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $errors->cliente->any() ? 'active' : '' }}" id="delete_cliente_tab"
                                data-toggle="pill" href="#delete_cliente" role="tab"
                                aria-controls="delete_cliente">Eliminar</a>
                        </li>
                    </ul>
                </div>

                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-one-tabContent">
                        <div class="tab-pane fade {{ $errors->cliente->any() ? '' : 'show active' }}" id="datos_cliente"
                            role="tabpanel" aria-labelledby="datos_cliente_tab">
                            @include('partials.clientes.show_datos')
                        </div>

                        <div class="tab-pane fade {{ $errors->cliente->any() ? 'show active' : '' }}"
                            id="datos_cliente_edit" role="tabpanel" aria-labelledby="datos_cliente_edit_tab">
                            @include('partials.clientes.form_edit')
                        </div>

                        <div class="tab-pane fade" id="delete_cliente" role="tabpanel"
                            aria-labelledby="delete_cliente_tab">
                            <p>Eliminar cliente con todos los registros asociados</p>
                            <hr>
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-danger px-2" data-toggle="modal"
                                    data-target="#modal-delete-cliente">
                                    Eliminar
                                </button>
                            </div>

                            <x-alert-confirmation titulo="¿Estás seguro?" id="modal-delete-cliente">
                                <x-slot name="mensaje">
                                    Esta accion es irreversible<br>
                                    Se eliminará al cliente '{{ $cliente->nombre.' '.$cliente->apellido  }}' y todos los registros
                                    asociados al mismo
                                </x-slot>

                                <x-slot name="boton">
                                    <form action="{{ route('clientes.destroy', $cliente) }}" method="POST"
                                        id="form_delete_cliente">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </form>
                                </x-slot>
                            </x-alert-confirmation>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>

            <div class="card card-success card-tabs">
                <div class="card-header p-0 pt-1">
                    <div class="d-flex justify-content-between p-0">
                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">

                            <li class="nav-item">
                                <a class="nav-link {{ $errors->any() ? '' : 'active' }}" id="vehiculos_tab"
                                    data-toggle="pill" href="#vehiculos_list" role="tab"
                                    aria-controls="vehiculos_tab">Vehiculos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ $errors->any() ? 'active' : '' }}" id="vehiculos_edit_tab"
                                    data-toggle="pill" href="#vehiculo_registrar" role="tab"
                                    aria-controls="vehiculos_edit_tab">Registrar</a>
                            </li>

                        </ul>
                        <div class="card-tools my-auto">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>

                </div>

                <div class="card-body p-0">
                    <div class="tab-content" id="custom-tabs-one-tabContent">
                        <div class="tab-pane fade {{ $errors->any() ? '' : 'show active' }}" id="vehiculos_list"
                            role="tabpanel" aria-labelledby="vehiculos_list">
                            @include('partials.vehiculos.table_vehiculos')
                        </div>
                        <div class="tab-pane fade p-4 {{ $errors->any() ? 'show active' : '' }}" id="vehiculo_registrar"
                            role="tabpanel" aria-labelledby="vehiculo_registrar">
                            @include('partials.vehiculos.form_create')
                        </div>
                    </div>
                </div>

            </div>

            <div class="card card-purple">
                <div class="card-header">
                    <div class="row justify-content-between">
                        <div class="col-xs-4">
                            <h3 class="card-title mt-1">Premios</h3>
                            <a class="btn bg-gradient-danger btn-sm mx-4"
                                href="{{ route('clientes.canjeo', $cliente) }}">Canjear</a>
                        </div>
                        <div class="card-tools my-auto mx-n1">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    @include('partials.clientes.table_premios')
                </div>
            </div>
    </section>
@stop
