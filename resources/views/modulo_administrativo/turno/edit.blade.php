@extends('adminlte::page')

@section('content_header')
<h1>Turno</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <!--aqui empieza el codigo del formulario-->
        <form method="POST" action = "{{ route('turno.update',[$turno->id]) }}">
            @csrf
            {{ method_field('PUT') }}
            <!--inicio campo descripcion-->
            <div class="mb-3">
                <label for="descripcion" class="form-label">descripcion</label>
                <input name="descripcion" type="text" class="form-control" id="descripcion" placeholder="introduzca una descripcion" required value = "{{$turno->descripcion}}">
            </div>
            <!--fin campo descripcion-->
            <!--inicio campo hora_entrada-->
            <div class="mb-3">
                <label for="hora_entrada" class="form-label">hora de entrada</label>
                <input name="hora_entrada" type="time" class="form-control" id="hora_entrada" required value = "{{$turno->hora_entrada}}">
            </div>
            <!--fin campo hora_entrada-->
            <!--inicio campo hora_salida-->
            <div class="mb-3">
                <label for="hora_salida" class="form-label">hora de salida</label>
                <input name="hora_salida" type="time" class="form-control" id="hora_salida" required value = "{{$turno->hora_salida}}">
            </div>
            <!--fin campo hora_salida-->
            <!--inicio campo botones-->
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-success">guardar</button>
                <a href="{{ url('/turno') }}" class="btn btn-secondary">
                    Cancelar
                </a>
            </div>
            <!--fin campo botones-->
        </form>
        <!--aqui termina el codigo del formulario-->
    </div>
</div>
@stop