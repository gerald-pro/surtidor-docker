@extends('adminlte::page')

@section('content_header')
<h1>Tomar asistencia de turno: {{$turno->descripcion}}</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
            <div class="table-responsive">
                
                    <table class="table caption-top">
                        <caption></caption>
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Empleado</th>
                                <th scope="col">Marcar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($turno->users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example"> 
                                        <form action="{{ route('asistencia.entrada',[$turno->id,$user->id])}}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="btn btn-success" style="margin: 10px">
                                                entrada
                                                <i class="fas fa-sign-in-alt" aria-hidden="true"></i>
                                             </button> 
                                        </form>
                                        <form action="{{ route('asistencia.salida',[$turno->id,$user->id])}}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit"
                                                class="btn btn-secondary"style="margin: 10px">
                                                salida
                                                <i class="fas fa-sign-out-alt" aria-hidden="true"></i>
                                             </button>    
                                        </form>
                                    </div>
                                </td>
                            </tr> 
                            @endforeach
                        </tbody>
                    </table>
                <a href="{{url('turno')}}" class="btn btn-secondary">Atras</a>
            </div> 
    </div>
</div>
@stop
