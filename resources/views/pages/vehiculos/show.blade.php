@extends('adminlte::page')

@section('title', 'vehiculos')

@section('plugins.Sweetalert2', true)

@section('content')
    <section class="content">
        <div class="container-fluid py-4">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title my-auto">
                            <strong>VEHICULO</strong>
                        </h4>
                        <div class="card-tools">
                            <div class="d-flex">
                                <a href="{{ route('vehiculos.edit', $vehiculo) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-pen" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <label>Placa</label>
                            <p class="form-control ">{{ $vehiculo->placa }}</p>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Tipo</label>
                                <p class="form-control">
                                    {{ $vehiculo->tipo }}</p>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Marca</label>
                                <p class="form-control">
                                    {{ $vehiculo->marca }}</p>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>B-SISA</label>
                                <p class="form-control ">
                                    {{ $vehiculo->b_sisa ? 'Hábil' : 'Inhábil' }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <label>Dueño</label>
                            <p class="border rounded p-2">
                                <a href="{{ route('clientes.show', $vehiculo->cliente) }}">
                                    <i class="fa fa-user-circle fa-fw pr-4" aria-hidden="true"></i>
                                    {{ $vehiculo->cliente->nombre . ' ' . $vehiculo->cliente->apellido }}
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <p class="my-auto"><small>Creado: {{ $vehiculo->created_at }}</small></p>
                        <p class="my-auto"><small>Ultima modificación: {{ ' ' . $vehiculo->updated_at . '  ' }}</small></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
