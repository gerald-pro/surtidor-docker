@extends('adminlte::page')

@section('title', 'Registrar Pedido')

@section('content')
    <section class="content">
        <div class="container-fluid p-4">
            <!-- SELECT2 EXAMPLE -->
            <div class="card">
                <div class="bg-purple p-5">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">
                            <strong>REGISTRAR NUEVO PEDIDO</strong>
                        </h4>
                    </div>
                </div>
                
                <form action="{{ route('pedidos.store') }}" method="post">
                    @csrf
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="codigo">Codigo</label>
                                    <input name="codigo" class="form-control my-colorpicker1" value="{{ old('codigo') }}">

                                    @error('codigo')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fecha">Fecha</label>
                                    <input name="fecha" type="datetime-local" class="form-control my-colorpicker1"
                                        value="{{ old('fecha', \Carbon\Carbon::today()) }}">
                    
                                    @error('fecha')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
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

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="id_producto">Producto</label>
                                    <input name="id_producto" class="form-control my-colorpicker1"
                                        value="{{ old('id_producto') }}">

                                    @error('id_producto')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>

                            </div>   
                           
                    </div>
                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error )
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="card-footer">
                        <div class="card-tools">
                            <div class="d-flex justify-content-end">
                                <a type="button" class="btn btn-danger mr-2"
                                    href="{{ route('pedidos.index') }}">Cancelar</a>

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
