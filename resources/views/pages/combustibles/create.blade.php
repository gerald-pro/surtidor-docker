@extends('adminlte::page')

@section('title', 'Registrar Combustible')

@section('content')
    <section class="content">
        <div class="container-fluid pt-4">
            <div class="card">
                <div class="card-header bg-dark">
                    <h4>
                        <strong>REGISTRAR COMBUSTIBLE</strong>
                    </h4>
                </div>
                <form action="{{ route('combustibles.store') }}" method="post">
                    @csrf
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nombre">Nombre o variante</label>
                                    <input name="nombre" class="form-control my-colorpicker1" value="{{ old('nombre') }}">

                                    @error('nombre')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tipo">Tipo</label>
                                    <select name="tipo" id="" class="form-control">
                                        <option value="gasolina">Gasolina</option>
                                        <option value="diesel">Diesel</option>
                                        <option value="bio-diesel">Bio-Diesel</option>
                                        <option value="etanol">Etanol</option>
                                    </select>
                                    @error('codigo')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="unidad_medida">Unidad de Medida</label>
                                    <input name="unidad_medida" class="form-control my-colorpicker1"
                                        value="{{ old('unidad_medida') }}">

                                    @error('unidad_medida')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="precio_compra">Precio Compra (bs)</label>
                                    <input name="precio_compra" class="form-control my-colorpicker1" type="precio"
                                        value="{{ old('precio_compra') }}">

                                    @error('precio')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="precio_venta">Precio Venta (bs)</label>
                                    <input name="precio_venta" class="form-control my-colorpicker1"
                                        value="{{ old('precio_venta') }}">

                                    @error('tipo')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="card-footer">
                        <div class="card-tools">
                            <div class="d-flex justify-content-end">
                                <a type="button" class="btn btn-danger md-5"
                                    href="{{ route('combustibles.index') }}">Cancelar</a>

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
