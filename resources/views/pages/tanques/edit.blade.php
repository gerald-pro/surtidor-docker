@extends('adminlte::page')

@section('title', 'tanques')

@section('content')
    <section class="content">
        <div class="container-fluid p-4">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">
                            <strong>EDITAR TANQUE</strong>
                        </h4>
                    </div>
                </div>
                <form action="{{ route('tanques.update', $tanque) }}" method="POST">
                    @method('put')
                    @csrf
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="codigo">Codigo</label>
                                    <input name="codigo" class="form-control my-colorpicker1" type="text"
                                        value="{{ old('codigo', $tanque->codigo) }}" required>

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
                                            <option value="{{ $combustible->id }}"
                                                {{ $combustible->id == $tanque->combustible_id ? 'selected' : '' }}>
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
                                        <option value="1" {{ $tanque->estado ? 'selected' : '' }}>Activo
                                        </option>
                                        <option value="0" {{ $tanque->estado ? '' : 'selected' }}>Inactivo
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea name="descripcion" class="form-control my-colorpicker1">{{ old('descripcion', $tanque->descripcion) }}</textarea>

                            @error('descripcion')
                                <small class="text-danger">*{{ $message }}</small>
                            @enderror
                            <div class="py-3">
                                <hr />
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="cantidad_disponible">Cantidad disponible (lts)</label>
                                        <input name="cantidad_disponible" class="form-control my-colorpicker1"
                                            type="number" step=".01" min="0"
                                            value="{{ old('cantidad_disponible', $tanque->cantidad_disponible) }}"
                                            required>

                                        @error('cantidad_disponible')
                                            <small class="text-danger">*{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="cantidad_min">Cantidad mínima (lts)</label>
                                        <input name="cantidad_min" class="form-control my-colorpicker1" type="number"
                                            value="{{ old('cantidad_min', $tanque->cantidad_min) }}" step=".01"
                                            min="0">

                                        @error('cantidad_min')
                                            <small class="text-danger">*{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="capacidad">Capacidad (lts)</label>
                                        <input name="capacidad" class="form-control my-colorpicker1" type="number"
                                            value="{{ old('capacidad', $tanque->capacidad) }}" step=".01"
                                            min="1" required>

                                        @error('capacidad')
                                            <small class="text-danger">*{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="progress my-1" style="height: 4px;">
                                    <div class="progress-bar bg-cyan "
                                        style="width:{{ ($tanque->cantidad_min * 100) / $tanque->capacidad }}%;">
                                    </div>
                                </div>
                                <div class="progress" style="height: 35px;">
                                    <div class="progress-bar text-left p-2 progress-bar-striped progress-bar-animated 
                                @if ($tanque->cantidad_disponible > $tanque->cantidad_min) bg-cyan
                                @else bg-red @endif"
                                        style="width: {{ ($tanque->cantidad_disponible / $tanque->capacidad) * 100 }}%">
                                    </div>
                                </div>

                                @if ($tanque->cantidad_disponible > $tanque->cantidad_min)
                                    <small>No se requiere recarga</small>
                                @else
                                    <small class="text-danger">¡Es necesario recargar el tanque!</small>
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="card-tools">
                            <div class="d-flex justify-content-end">
                                <a type="button" class="btn btn-secondary mr-2" href="{{ url()->previous() }}">Cancelar</a>

                                <button type="submit" class="btn btn-info">Guardar</button>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@stop
