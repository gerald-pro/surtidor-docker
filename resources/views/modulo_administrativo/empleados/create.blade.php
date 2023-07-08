@extends('adminlte::page')

@section('content_header')
    <h1>Empleado</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <!--aqui empieza el codigo del formulario-->
            <form method="POST" enctype="multipart/form-data" action="{{ route('empleados.store') }}">
                @csrf
                <!--inicio campo nombre-->
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input name="name" type="text" class="form-control" id="name" placeholder="introduzca su nombre"
                        required>
                </div>
                <!--fin campo nombre-->
                <!--inicio campo correo-->
                <div class="mb-3">
                    <label for="email" class="form-label">Correo</label>
                    <input name="email" type="email" class="form-control" id="email"
                        placeholder="introduzca su correo" required>
                </div>
                <!--fin campo correo-->
                <!--inicio campo direccion-->
                <div class="mb-3">
                    <label for="direccion" class="form-label">Direccion</label>
                    <input name="direccion" type="text" class="form-control" id="direccion"
                        placeholder="introduzca su direccion" required>
                </div>
                <!--fin campo direccion-->
                <!--inicio campo telefono-->
                <div class="mb-3">
                    <label for="telefono" class="form-label">Telefono</label>
                    <input name="telefono" type="number" class="form-control" id="telefono"
                        placeholder="introduzca su telefono" required>
                </div>
                <!--fin campo telefono-->
                <!--inicio campo contraseña-->
                <div class="mb-3">
                    <label for="password" class="form-label">Constraseña</label>
                    <input name="password" type="password" class="form-control" id="direccion"
                        placeholder="introduzca su constraseña" required>
                </div>
                <!--fin campo contraseña-->

                <div class="custom-file mb-3">
                    <label for="foto_perfil" class="form-label">Foto de perfil</label>
                    <input name="foto_perfil" type="file" accept="image/*" id="foto_perfil" required>
                </div>

                <!--inicio campo cantidad-->
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-success">guardar</button>
                    <a href="{{ url('/empleado') }}" class="btn btn-secondary">
                        Cancelar
                    </a>
                </div>
                <!--fin campo cantidad-->
            </form>
            <!--aqui termina el codigo del formulario-->
        </div>
    </div>
@stop
