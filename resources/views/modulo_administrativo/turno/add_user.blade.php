@extends('adminlte::page')

@section('content_header')
<h1>Añadir Empleados a Turno {{$turno->descripcion}}</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('turno.storeUser', $turno) }}" method="POST">
            <!--aqui empieza el codigo del select-->
            @csrf
            <div class="row mb-3">
                <label for="user_id" class="col-md-2 col-form-label ">Empleado a agregar </label>
                <div class="col-md-10">
                    <select class="form-control" id="user_id" name="user_id">
                        @foreach ($user_list as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!--aqui termina el codigo del select-->
            <!--aqui empieza el codigo del boton guardar-->
            <div class="row mb-0">
                <div class="col-md-10 offset-md-2">
                    <input type="submit" value="Agregar" class="btn btn-success" required>
                    <a href="{{ url('/turno/') }}" class="btn btn-secondary">
                        Atras
                    </a>
                </div>
                
            </div>
        </form>
            <!--aqui termina el codigo del boton guardar-->
            <div class="table-responsive">
                <table class="table">
                    <table class="table caption-top">
                        <caption></caption>
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Empleado</th>
                                <th scope="col">Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($turno->users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example"> 
                                        <form action="{{ route('turno.destroyUser',[$turno, $user->id])}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('¿Estas Seguro de Eliminarlo?')"
                                                class="btn btn-danger">
                                                <i class="fa fa-trash"></i>
                                             </button>
                                        </form>
                                    </div>
                                </td>
                            </tr> 
                            @endforeach
                        </tbody>
                    </table>
                </table>
            </div> 
    </div>
</div>
@stop
