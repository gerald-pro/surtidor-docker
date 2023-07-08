@extends('adminlte::page')

@section('content_header')
<h1> Proveedor : {{ $proveedor->nombre }} </h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <!--aqui empieza el codigo del formulario-->
        <form method="GET" action = "{{ url('/proveedor/' . $proveedor->id) }}">
            @csrf
            {{ method_field('POST') }}
            <!--inicio campo nombre-->
            <div class="mb-3">
                <label for="nombre" class="form-label">nombre</label>
                <p type="text" class="form-control">{{ $proveedor->nombre }}</p>
            </div>
            <!--fin campo nombre-->
            <!--inicio campo telefono-->
            <div class="mb-3">
                <label for="telefono" class="form-label">telefono</label>
                <p type="text" class="form-control">{{ $proveedor->telefono }}</p>
            </div>
            <!--fin campo telefono-->
            <!--inicio campo correo-->
            <div class="mb-3">
                <label for="correo" class="form-label">correo</label>
                <p type="email" class="form-control">{{ $proveedor->correo }}</p>
            </div>
            <!--fin campo correo-->
            <!--inicio campo direccion-->
            <div class="mb-3">
                <label for="direccion" class="form-label">direccion</label>
                <p type="text" class="form-control">{{ $proveedor->direccion }}</p>
            </div>
            <!--fin campo direccion-->
            <!--inicio campo nit-->
            <div class="mb-3">
                <label for="nit" class="form-label">nit</label>
                <p type="number" class="form-control">{{ $proveedor->nit }}</p>
            </div>
            <!--fin campo nit-->
            <!--inicio campo descripcion-->
            <div class="mb-3">
                <label for="descripcion" class="form-label">descripcion</label>
                <p type="text" class="form-control">{{ $proveedor->descripcion }}</p>
            </div>
            <!--fin campo descripcion-->
            <!--inicio campo estado-->
            <div class="form-group">
                <label for="estado">estado</label>
                <p type="text" class="form-control my-colorpicker1">{{ $proveedor->estado ? 'Activo' : 'Inactivo' }}</p>
            </div>
            <!--fin campo estado-->
            <!--inicio campo botones-->
            <div class="row mb-0" style="text-align:right">
                    <div class="col-md-10 offset-md-2">
                        <a href="{{ url('/proveedor') }}" class="btn btn-success">
                            Atras
                        </a>
                    </div> 
            </div>          
            <!--fin campo botones-->
        </form>
        <!--aqui termina el codigo del formulario-->
    </div>
</div>
@stop