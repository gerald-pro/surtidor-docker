@extends('adminlte::page')

@section('title', 'combustibles')

@section('content')
    <section class="content">
        <div class="container-fluid p-4">
            <!-- SELECT2 EXAMPLE -->
            <div class="card">
                <div class="bg-dark p-4">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">
                            <strong>EDITAR COMBUSTIBLE</strong>
                        </h4>
                    </div>
                </div>
                <form action="{{ route('combustibles.update', $combustible) }}" method="post">
                    @method('put')
                    @csrf
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="codigo">Codigo</label>
                                    <input name="codigo" class="form-control my-colorpicker1"
                                        value="{{ old('codigo', $combustible->codigo) }}">

                                    @error('codigo')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input name="nombre" class="form-control my-colorpicker1"
                                        value="{{ old('nombre', $combustible->nombre) }}">

                                    @error('nombre')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <label for="precio_compra">Precio Compra</label>
                            <textarea name="precio_compra" class="form-control my-colorpicker1">{{ old('precio_compra', $combustible->precio_compra) }}</textarea>

                            @error('precio_compra')
                                <small class="text-danger">*{{ $message }}</small>
                            @enderror
                            <div class="py-3">
                                <hr />
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="precio_venta">Precio Venta (bs)</label>
                                        <input name="precio_venta" class="form-control my-colorpicker1"
                                            value="{{ old('precio_venta', $combustible->precio_venta) }}">
    
                                        @error('precio_venta')
                                            <small class="text-danger">*{{ $message }}</small>
                                        @enderror
                                    </div>
    
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="unidad_medida">Unidad de Medida</label>
                                        <input name="unidad_medida" class="form-control my-colorpicker1"
                                            value="{{ old('unidad_medida', $combustible->unidad_medida) }}">
    
                                        @error('combustible')
                                            <small class="text-danger">*{{ $message }}</small>
                                        @enderror
                                    </div>
    
                                </div>
                               
                            </div>
                        </div>
                        

                    </div>

                    <div class="card-footer">
                        <div class="card-tools">
                            <div class="d-flex justify-content-end">
                                <a type="button" class="btn btn-danger mr-2"
                                    href="{{ route('combustibles.show', $combustible) }}">Cancelar</a>

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
