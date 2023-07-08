@extends('adminlte::page')

@section('title', 'bombas')

@section('content')
    <section class="content">
        <div class="container-fluid p-4">
            <!-- SELECT2 EXAMPLE -->
            <div class="card">
                <div class="bg-dark p-4">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">
                            <strong>EDITAR BOMBA</strong>
                        </h4>
                    </div>
                </div>
                <form action="{{ route('bombas.update', $bomba) }}" method="post">
                    @method('put')
                    @csrf
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="codigo">Codigo</label>
                                    <input name="codigo" class="form-control my-colorpicker1"
                                        value="{{ old('codigo', $bomba->codigo) }}">

                                    @error('codigo')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input name="nombre" class="form-control my-colorpicker1"
                                        value="{{ old('nombre', $bomba->nombre) }}">

                                    @error('nombre')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="combustible">Combustible</label>
                                    <input name="combustible" class="form-control my-colorpicker1"
                                        value="{{ old('combustible', $bomba->combustible) }}">

                                    @error('combustible')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="estado">Estado</label>
                                    <select name="estado" class="form-control select2" style="width: 100%;">
                                        <option value="1" selected="{{ $bomba->estado ? 'selected' : '' }}">Activo
                                        </option>
                                        <option value="0" selected="{{ $bomba->estado ? '' : 'selected' }}">Inactivo
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea name="descripcion" class="form-control my-colorpicker1">{{ old('descripcion', $bomba->descripcion) }}</textarea>

                            @error('descripcion')
                                <small class="text-danger">*{{ $message }}</small>
                            @enderror
                            <div class="py-3">
                                <hr />
                            </div>  
                        </div>

                    </div>

                    

                    <div class="card-footer">
                        <div class="card-tools">
                            <div class="d-flex justify-content-end">
                                <a type="button" class="btn btn-danger mr-2"
                                    href="{{ route('bombas.show', $bomba) }}">Cancelar</a>

                                <button type="submit" class="btn btn-info">Guardar</a>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- /.container-fluid -->
    </section>
@stop
