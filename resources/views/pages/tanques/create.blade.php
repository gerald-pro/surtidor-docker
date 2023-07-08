@extends('adminlte::page')

@section('title', 'Registrar tanque')

@section('content')
    <section class="content">
        <div class="container-fluid p-4">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">
                            <strong>REGISTRAR TANQUE</strong>
                        </h4>
                    </div>
                </div>
                <form action="{{ route('tanques.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="codigo">Codigo</label>
                                    <input type="text" name="codigo" class="form-control my-colorpicker1"
                                        value="{{ old('codigo') }}">

                                    @error('codigo')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="combustible">Combustible</label>
                                    <select name="combustible_id" class="form-control select2" style="width: 100%;">
                                        @foreach ($combustibles as $combustible)
                                            <option value="{{ $combustible->id }}">
                                                {{ $combustible->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="estado">Estado</label>
                                    <select name="estado" class="form-control select2" style="width: 100%;">
                                        <option value="1" selected>Activo
                                        </option>
                                        <option value="0">
                                            Inactivo
                                        </option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea name="descripcion" class="form-control my-colorpicker1">{{ old('descripcion') }}</textarea>

                            @error('descripcion')
                                <small class="text-danger">*{{ $message }}</small>
                            @enderror
                            <div class="py-3">
                                <hr />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cantidad_disponible">Cantidad disponible (lts)</label>
                                    <input name="cantidad_disponible" class="form-control my-colorpicker1" type="number"
                                        value="{{ old('cantidad_disponible') }}" step=".01" min="0">

                                    @error('cantidad_disponible')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cantidad_min">Cantidad mínima (lts)</label>
                                    <input name="cantidad_min" class="form-control my-colorpicker1" type="number"
                                        value="{{ old('cantidad_min') }}" step=".01" min="0">

                                    @error('cantidad_min')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="capacidad">Capacidad (lts)</label>
                                    <input name="capacidad" class="form-control my-colorpicker1" type="number"
                                        value="{{ old('capacidad') }}" step=".01" min="0" required>

                                    @error('capacidad')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="card-tools">
                            <div class="d-flex justify-content-end">
                                <a type="button" class="btn btn-danger mr-2"
                                    href="{{ route('tanques.index') }}">Cancelar</a>

                                <button type="submit" class="btn btn-info">Guardar</a>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@stop
