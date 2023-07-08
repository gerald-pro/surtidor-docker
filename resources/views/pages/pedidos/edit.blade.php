@extends('adminlte::page')

@section('title', 'pedidos')

@section('content')
    <section class="content">
        <div class="container-fluid p-4">
            <!-- SELECT2 EXAMPLE -->
            <div class="card">
                <div class="bg-purple p-4">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">
                            <strong>EDITAR PEDIDOS</strong>
                        </h4>
                    </div>
                </div>
                <form action="{{ route('pedidos.update', $pedido) }}" method="post">
                    @method('put')
                    @csrf
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="codigo">Codigo</label>
                                    <input name="codigo" class="form-control my-colorpicker1"
                                        value="{{ old('codigo', $pedido->codigo) }}">

                                    @error('codigo')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fecha">Fecha</label>
                                    <input name="fecha" class="form-control my-colorpicker1"
                                        value="{{ old('fecha', $pedido->fecha) }}">

                                    @error('fecha')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="estado">Estado</label>
                                <select name="estado" class="form-control select2" style="width: 100%;">
                                    <option value="1" selected="{{ $pedido->estado ? 'selected' : '' }}">Activo
                                    </option>
                                    <option value="0" selected="{{ $pedido->estado ? '' : 'selected' }}">Inactivo
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="id_producto">Producto</label>
                            <textarea name="id_producto" class="form-control my-colorpicker1">{{ old('id_producto', $pedido->id_producto) }}</textarea>

                            @error('id_producto')
                                <small class="text-danger">*{{ $message }}</small>
                            @enderror
                            <div class="py-3">
                                <hr />
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="id_usuario">Usuario</label>
                                        <input name="id_usuario" class="form-control my-colorpicker1"
                                            value="{{ old('id_usuario', $pedido->id_usuario) }}">
    
                                        @error('id_usuario')
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
                                    href="{{ route('pedidos.show', $pedido) }}">Cancelar</a>

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
