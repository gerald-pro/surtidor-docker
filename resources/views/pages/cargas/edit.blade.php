@extends('adminlte::page')

@section('title', 'cargas')

@section('content')
    <section class="content">
        <div class="container-fluid p-4">
            <!-- SELECT2 EXAMPLE -->
            <div class="card">
                <div class="bg-purple p-4">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">
                            <strong>EDITAR CARGA</strong>
                        </h4>
                    </div>
                </div>
                <form action="{{ route('cargas.update', $carga) }}" method="post">
                    @method('put')
                    @csrf
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="codigo">Codigo</label>
                                    <input name="codigo" class="form-control my-colorpicker1"
                                        value="{{ old('codigo', $carga->codigo) }}">

                                    @error('codigo')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fecha">Fecha</label>
                                    <input name="fecha" class="form-control my-colorpicker1"
                                        value="{{ old('fecha', $carga->fecha) }}">

                                    @error('fecha')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cantidad">Cantidad</label>
                                    <input name="cantidad" class="form-control my-colorpicker1"
                                        value="{{ old('cantidad', $carga->cantidad) }}">

                                    @error('cantidad')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>

                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="precio_unitario">Precio Unitario</label>
                                    <input name="precio_unitario" class="form-control my-colorpicker1"
                                        value="{{ old('precio_unitario', $carga->precio_unitario) }}">

                                    @error('precio_unitario')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>

                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="precio_total">Precio Total</label>
                                    <input name="precio_total" class="form-control my-colorpicker1"
                                        value="{{ old('precio_total', $carga->precio_total) }}">

                                    @error('precio_total')
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
                                    href="{{ route('cargas.show', $carga) }}">Cancelar</a>

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
