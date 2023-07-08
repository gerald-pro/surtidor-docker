@extends('adminlte::page')

@section('content_header')
<h1>Lista de bombas asignadas al usuario </h1>
@stop

@section('content')

<div class="card">
    <div class= "card-body" >
        <form method="POST" enctype="multipart/form-data" action="{{ route('empleadobombas.create',$user) }}">
            @csrf
            {{-- <select name="bomba_id" id="">
                <option value="">
                    elija una opcion
                </option>
                @foreach ($bombas as $bomba)
                <option value="{{$bomba->id}}">
                    {{$bomba->nombre}}
                </option>
                @endforeach
            </select> --}}
    
            <div class="input-group">
                <select class="custom-select" id="inputGroupSelect04" aria-label="Example select with button addon" name="bomba_id">
                  <option>seleccione una bomba</option>
                  @foreach ($bombas as $bomba)
                  <option value="{{$bomba->id}}">
                      {{$bomba->nombre}}
                  </option>
                  @endforeach
                </select>
                <div class="input-group-append">
                  <button class="btn btn-success" type="submit">Asignar</button>
                </div>
            </div>
    
    
            @error('bomba_id')
            <small class="text-danger">
                campo requerido
            </small>
            @enderror
    
        </form>
    
    </div>
</div>
<div class="table-responsive">
    <table class="table">
        <table class="table caption-top">
            <caption></caption>
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">bomba</th>
                    <th scope="col">combustible</th>
                    <th scope="col">fecha y hora</th>
                    <th scope="col">Accion</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user_bombas as $user_bomba)

                  <tr class="{{$user_bomba->asignacion_vigente? 'table-success' : ''}}">
                    
                    <td>{{ $user_bomba->id }}</td>
                    <td>{{ $user_bomba->Bomba->nombre }}</td>
                    <td>{{ $user_bomba->Bomba->tanque->combustible->nombre }}</td>
                    <td>{{ $user_bomba->fecha_asignacion }}</td>

                    <td>
                        <div class="btn-group" role="group" aria-label="Basic example">

                            <form action="{{ route('empleadobombas.destroy',$user_bomba)}}" method="post">
                                @csrf
                                {{ method_field('DELETE') }}
                                <button type="submit" onclick="return confirm('¿Estas Seguro de Eliminarlo?')" class="btn btn-danger">
                                    <i class="fas fa-trash"></i>
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

@stop