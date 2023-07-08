@extends('adminlte::page')

@section('title', 'Lista de vehiculos')

@section('content')
    <section class="content">
        <div class="container-fluid p-4">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title my-auto">
                            <strong>EDITAR VEHICULO</strong>
                        </h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('vehiculos.update', $vehiculo) }}" method="post">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="col-sm-3">
                                <label>Placa</label>
                                <input name="placa" class="form-control my-colorpicker1"
                                    value="{{ old('placa', $vehiculo->placa) }}" style="text-transform:uppercase" required>

                                @error('placa')
                                    <small class="text-danger">*{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Tipo</label>
                                    <select name="tipo" class="form-control select2" style="width: 100%;" required>
                                        <option value="{{ null }}" {{ ($vehiculo->tipo == null) ? 'selected' : '' }}>--Seleccionar--</option>
                                        <option value="automovil" {{ ($vehiculo->tipo == 'automovil') ? 'selected' : '' }}>Automovil</option>
                                        <option value="camioneta" {{ ($vehiculo->tipo == 'camioneta') ? 'selected' : '' }}>Camioneta</option>
                                        <option value="minibus" {{ ($vehiculo->tipo == 'minibus') ? 'selected' : '' }}>Minibus</option>
                                        <option value="bus" {{ ($vehiculo->tipo == 'bus') ? 'selected' : '' }}>Bus</option>
                                        <option value="camion" {{ ($vehiculo->tipo == 'camion') ? 'selected' : '' }}>Camión</option>
                                    </select>
                                    @error('tipo')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Marca</label>
                                    <input name="marca" class="form-control my-colorpicker1" value="{{ old('marca',$vehiculo->marca) }}">

                                    @error('marca')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="b_sisa">B-SISA</label>
                                    <select name="b_sisa" class="form-control select2" style="width: 100%;">
                                        <option value="1" {{ $vehiculo->b_sisa ? 'selected' : '' }}>Hábil</option>
                                        <option value="0" {{ $vehiculo->b_sisa ? '' : 'selected' }}>Inhábil</option>
                                    </select>
                                    @error('b_sisa')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3 text-muted">
                                <label>Dueño</label>
                                <p class="border rounded p-2 ">
                                    <i class="fa fa-user-circle fa-fw pr-4" aria-hidden="true"></i>
                                    {{ $vehiculo->cliente->nombre . ' ' . $vehiculo->cliente->apellido }}
                                </p>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a type="button" class="btn btn-danger mr-2" href="{{ url()->previous() }}">Cancelar</a>
                            <button type="submit" class="btn btn-info">Guardar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@stop
