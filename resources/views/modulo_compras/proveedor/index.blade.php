@extends('adminlte::page')

@section('content_header')
<h1>Lista de Proveedores</h1>
@stop

@section('content')

<div class="d-grid gap-2">
    <a class="btn btn-success" href="{{ route('proveedor.create') }}"> crear </a>
</div>

<div class="table-responsive">
    <table class="table">
        <table class="table caption-top">
            <caption></caption>
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Telefono</th>
                <th scope="col">Correo</th>
                <th scope="col">Direccion</th>
                <th scope="col">Nit</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Estado</th>
                <th scope="col">Accion</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($lista_proveedores as $proveedor)
                  <tr>
                    <th scope="row">{{$proveedor->id}}</th>
                    <td>{{$proveedor->nombre}}</td>
                    <td>{{$proveedor->telefono}}</td>
                    <td>{{$proveedor->correo}}</td>
                    <td>{{$proveedor->direccion}}</td>
                    <td>{{$proveedor->nit}}</td>
                    <td>{{$proveedor->descripcion}}</td>
                    <td>
                      @if ($proveedor->estado == '1')
                          <div class="btn-group" role="group" aria-label="Basic example">
                              <a href="{{ url('/proveedor/' . $proveedor->id . '/desactivar') }}"
                                  class="btn btn-success">Activo
                              </a>
                          </div>
                      @else
                          <div class="btn-group" role="group" aria-label="Basic example">
                              <a href="{{ url('/proveedor/' . $proveedor->id . '/activar') }}"
                                  class="btn btn-default">Inactivo
                              </a>
                          </div>
                      @endif
                  </td>
                   {{-- <td class="text-center" style="display: inline-block"><span class="badge {{$proveedor->estado ? 'bg-success' : 'bg-secondary'}}">{{$proveedor->estado ? 'ACTIVO' : 'INACTIVO'}}</span></td>--}}
                    <td> 
                        <div class="btn-group" role="group" aria-label="Basic example">

                          <a href="{{ url('/proveedor/' . $proveedor->id . '/') }}"
                            class="btn btn-success">
                            <i class="fa fa-eye"></i>
                          </a>

                            <a href="{{ url('/proveedor/' . $proveedor->id . '/edit') }}"
                                 class="btn btn-warning">
                                 <i class="fa fa-pen"></i>
                            </a>
              
                            <form action="{{ url('/proveedor/' . $proveedor->id) }}"
                                method="post">
                                @csrf
                            {{ method_field('DELETE') }}
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

@stop

