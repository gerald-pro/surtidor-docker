@extends('adminlte::page')

@section('content_header')
<h1>Proveedor</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <!--aqui empieza el codigo del formulario-->
        <form method="POST" action = "{{ route('proveedor.store') }}">
            @csrf
            <!--inicio campo nombre-->
            <div class="mb-3">
                <label for="nombre" class="form-label">nombre</label>
                <input name="nombre" type="text" class="form-control" id="nombre" placeholder="introduzca su nombre" required>
            </div>
            <!--fin campo nombre-->
            <!--inicio campo telefono-->
            <div class="mb-3">
                <label for="telefono" class="form-label">telefono</label>
                <input name="telefono" type="number" class="form-control" id="telefono" placeholder="introduzca su telefono" required>
            </div>
            <!--fin campo telefono-->
            <!--inicio campo correo-->
            <div class="mb-3">
                <label for="correo" class="form-label">correo</label>
                <input name="correo" type="email" class="form-control" id="correo" placeholder="introduzca su correo" required>
            </div>
            <!--fin campo correo-->
            <!--inicio campo direccion-->
            <div class="mb-3">
                <label for="direccion" class="form-label">direccion</label>
                <input name="direccion" type="text" class="form-control" id="direccion" placeholder="introduzca su direccion" required>
            </div>
            <!--fin campo direccion-->
            <!--inicio campo nit-->
             <div class="mb-3">
                <label for="nit" class="form-label">nit</label>
                <input name="nit" type="number" class="form-control" id="nit" placeholder="introduzca el nit del proveedor" required>
            </div>
            <!--fin campo nit-->
            <!--inicio campo descripcion-->
            <div class="mb-3">
                <label for="descripcion" class="form-label">descripcion</label>
                <input name="descripcion" type="text" class="form-control" id="descripcion" placeholder="introduzca una descripcion" required>
            </div>
            <!--fin campo descripcion-->
            <!--inicio campo botones-->
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-success">guardar</button>
                <a href="{{ route('proveedor.index') }}" class="btn btn-secondary">
                    Cancelar
                </a>
            </div>
            <!--fin campo botones-->
        </form>
        <!--aqui termina el codigo del formulario-->
    </div>
</div>
@stop