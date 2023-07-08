@extends('adminlte::page')

@section('content_header')
<h1>Lista de Empleados del Turno {{$id_turno}}</h1>
@stop

@section('content')


<div class="d-grid gap-2">
    <a class="btn btn-success" href="{{ url('/user_turno/create/' . $id_turno) }}"> Añadir Empleados</a>
</div>

<div class="table-responsive">
    <table class="table">
        <table class="table caption-top">
            <caption></caption>
            <thead>
              <tr>
                <th scope="col">Id</th>
                <th scope="col">Empleado</th> 
                <th scope="col">Horas de Turno</th>  
              </tr>
            </thead>
            <tbody>
                @foreach ($listaEmpleados as $empleado)
                  <tr>
                    <th scope="row">{{$empleado->user_id}}</th> 
                    <td >{{$empleado->name}}</td>
                    <td>
                        <a style="text-align: right" href=" "
                            class="btn btn-info">
                            <i class="fas fa-fw fa-stopwatch"></i>
                        </a>
                    </td>  
                  </tr>  
                @endforeach  
            </tbody>
          </table>
    </table>
  </div>

@stop

