@extends('adminlte::page')

@section('content_header')
<h1>Lista de Turnos</h1>
@stop

@section('content')


<div class="d-grid gap-2">
    <a class="btn btn-success" href="{{ route('turno.create') }}"> crear </a>
</div>

<div class="table-responsive">
    <table class="table">
        <table class="table caption-top">
            <caption></caption>
            <thead>
              <tr>
                <th scope="col">Id</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Hora Entrada</th>
                <th scope="col">Hora Salida</th>
                <th scope="col">Accion</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($lista_turnos as $turno)
                  <tr>
                    <th scope="row">{{$turno->id}}</th> 
                    <td >{{$turno->descripcion}}</td>
                    <td>{{$turno->hora_entrada}}</td>
                    <td>{{$turno->hora_salida}}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            
                          <a style="text-align: right" href="{{ url('/turno/' . $turno->id . '/') }}"
                            class="btn btn-success">
                            <i class="fa fa-eye"></i>
                          </a>

                          <a style="text-align: right" href="{{ url('/turno/' . $turno->id . '/edit') }}"
                            class="btn btn-warning">
                            <i class="fa fa-pen"></i>
                          </a>

                         <a style="text-align: right" href="{{ route('turno.addUser', $turno)}}"
                                 class="btn btn-info">
                                 <i class="fa fa-user-plus"></i>
                          </a> 

                          {{-- <a style="text-align: right" href="{{route('asistencia.create',$turno)}}"
                            class="btn btn-secondary">
                            <i class="fas fa-fw fa-stopwatch"></i>
                          </a> --}}

                         </div>
                    </td>
                  </tr>  
                @endforeach  
            </tbody>
          </table>
    </table>
  </div>

@stop

