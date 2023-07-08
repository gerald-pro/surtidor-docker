@extends('adminlte::page')

@section('title', 'Registrar bomba')

@section('content')
    <section class="content">
        <div class="container-fluid p-4">
            <!-- SELECT2 EXAMPLE -->
            <div class="card">
                
                <div class="bg-dark p-4">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">
                            <strong>REGISTRAR BOMBA</strong>
                        </h4>
                    </div>
                </div>
              
                <form action="{{ route('bombas.store') }}" method="post">
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
                                    <label for="nombre">Nombre</label>
                                    <input name="nombre" class="form-control my-colorpicker1"
                                        value="{{ old('nombre') }}">

                                    @error('nombre')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>
                               
                            </div>
                            <!-- <div class="col-md-4">
                                <div class="form-group">
                                    <label for="combustible">Combustible</label>
                                    <input name="combustible" class="form-control my-colorpicker1"
                                        value="{{ old('combustible') }}">

                                    @error('combustible')
                                        <small class="text-danger">*{{ $message }}</small>
                                    @enderror
                                </div> -->

                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="descripcion">Descripcion</label>
                                    <input name="descripcion" class="form-control my-colorpicker1"
                                        value="{{ old('descripcion') }}">

                                    @error('descripcion')
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
                                <label for="estado">Tanque</label>
                                <select name="tanque_id" class="form-control select2" style="width: 100%;">
                                    @foreach ($tanques as $tanque)

                                        <option value="{{$tanque->id}}" selected>{{$tanque->codigo . ' ' .'('. $tanque->combustible->nombre.')'}}</option>
                                        
                                    @endforeach
                                </select>
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
                                    href="{{ route('bombas.index') }}">Cancelar</a>

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
