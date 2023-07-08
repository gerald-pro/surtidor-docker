@extends('adminlte::page')

@section('content_header')
<h1> Turno : {{ $turno->descripcion }} </h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <div class="card" style="background:cornsilk">
            <div class="card-body">
              <!--aqui empieza el codigo del formulario-->
        <form method="GET" action = "{{ url('/turno/' . $turno->id) }}">
            @csrf
            {{ method_field('POST') }}
            <!--inicio campo descripcion-->
            <div class="mb-3">
                <label for="descripcion" class="form-label">descripcion</label>
                <p type="text" class="form-control">{{ $turno->descripcion }}</p>
            </div>
            <!--fin campo descripcion-->
            <!--inicio campo hora_entrada-->
            <div class="mb-3">
                <label for="hora_entrada" class="form-label">hora de entrada</label>
                <p type="text" class="form-control">{{ $turno->hora_entrada }}</p>
            </div>
            <!--fin campo hora_entrada-->
            <!--inicio campo hora_salida-->
            <div class="mb-3">
                <label for="hora_salida" class="form-label">hora de salida</label>
                <p type="text" class="form-control">{{ $turno->hora_salida }}</p>
            </div>
            <!--fin campo hora_salida-->
        </form>
            </div>
          </div>
        <!--aqui termina el codigo del formulario-->
        <div class="card" style="background:cornsilk">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <table class="table caption-top">
                            <caption></caption>
                            <thead class="table-white">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Empleado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($turno->users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                </tr> 
                                @endforeach
                            </tbody>
                        </table>
                    </table>
                </div> 
            </div>
          </div>
        
        <!--inicio campo botones-->
        <div class="row mb-0" style="text-align:right">
            <div class="col-md-10 offset-md-2">
                <a href="{{ url('/turno') }}" class="btn btn-success">
                    Atras
                </a>
            </div> 
    </div>          
    <!--fin campo botones-->
    </div>
</div>
@stop