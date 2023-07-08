@extends('adminlte::page')

@section('content_header')
<h1> Editar Proveedor : {{ $proveedor->nombre }} </h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <!--aqui empieza el codigo del formulario-->
        <form method="POST" action = "{{ url('/proveedor/' . $proveedor->id) }}">
            @csrf
            {{ method_field('PUT') }}
            <!--inicio campo nombre-->
            <div class="mb-3">
                <label for="nombre" class="form-label">nombre</label>
                <input name="nombre" type="text" class="form-control" id="nombre" 
                required value="{{ $proveedor->nombre }}">
            </div>
            <!--fin campo nombre-->
            <!--inicio campo telefono-->
            <div class="mb-3">
                <label for="telefono" class="form-label">telefono</label>
                <input name="telefono" type="number" class="form-control" id="telefono" 
                required value="{{ $proveedor->telefono }}">
            </div>
            <!--fin campo telefono-->
            <!--inicio campo correo-->
            <div class="mb-3">
                <label for="correo" class="form-label">correo</label>
                <input name="correo" type="email" class="form-control" id="correo" 
                required value="{{ $proveedor->correo }}">
            </div>
            <!--fin campo correo-->
            <!--inicio campo direccion-->
            <div class="mb-3">
                <label for="direccion" class="form-label">direccion</label>
                <input name="direccion" type="text" class="form-control" id="direccion" 
                required value="{{ $proveedor->direccion }}">
            </div>
            <!--fin campo direccion-->
            <!--inicio campo nit-->
            <div class="mb-3">
                <label for="nit" class="form-label">nit</label>
                <input name="nit" type="number" class="form-control" id="nit" 
                required value="{{ $proveedor->nit }}">
            </div>
            <!--fin campo nit-->
            <!--inicio campo descripcion-->
            <div class="mb-3">
                <label for="descripcion" class="form-label">descripcion</label>
                <input name="descripcion" type="text" class="form-control" id="descripcion" 
                required value="{{ $proveedor->descripcion }}">
            </div>
            <!--fin campo descripcion-->
            <!--inicio campo estado-->
            <div class="form-group">
                <label for="estado">estado</label>
                <select name="estado" class="form-control select2" style="width: 100%;">

                    <option value="1" selected="{{$proveedor->estado ? 'selected' : ''}}">Activo</option>
                    <option value="0" selected="{{$proveedor->estado ? '' : 'selected'}}">Inactivo</option>
                </select>
            </div>
            <!--fin campo estado-->
            <!--inicio campo botones-->
            <div class="row mb-0">
               
                    <div class="col-md-10 offset-md-2">
                        <input type="submit" value="Guardar Datos" class="btn btn-success">
                        <a href="{{ url('/proveedor') }}" class="btn btn-secondary">
                            Cancelar
                        </a>
                    </div> 

            </div>          
            <!--fin campo botones-->
        </form>
        <!--aqui termina el codigo del formulario-->
    </div>
</div>
@stop