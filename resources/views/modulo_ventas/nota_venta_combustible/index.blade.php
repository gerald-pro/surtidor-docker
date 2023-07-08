@extends('layouts/master')

@section('content_header')
    <h1>Notas de Ventas de Combustible</h1>
@stop

@section('content')



<div class="d-grid gap-2">
    <a class="btn btn-success" href="{{ route('nota_venta_combustible.create') }}"> crear </a>
</div>

<div class="table-responsive">
    <table class="table">
        <table class="table caption-top">
            <caption></caption>
            <thead>
              <tr>
                
                <th scope="col">ID</th>
                <th scope="col">Cliente</th>
                <th scope="col">Placa</th>
                <th scope="col">Fecha</th>
                <th scope="col">Total</th>
                <th scope="col">Accion</th>

              </tr>
            </thead>
            <tbody>
                @foreach ($lista_nota_venta_combustible as $nota_venta_combustible)
                  <tr>
                    <th scope="row">{{$nota_venta_combustible->id}}</th> 
                    <td >{{$nota_venta_combustible->nombre}}</td>
                    <td >{{$nota_venta_combustible->placa}}</td>
                    <td>{{$nota_venta_combustible->fecha}}</td>
                    <td>{{$nota_venta_combustible->total}}</td>
              

                    <td>
                        <div class="btn-group" role="group" aria-label="Basic example"> 
                            <a style="text-align: right" href="{{ url('nota_venta_combustible/' . $nota_venta_combustible->id . '/show')}}"
                              class="btn btn-success">
                              <i class="fa fa-eye"></i>
                          </a>   
                         </div>
                    </td>
                    
                  </tr>  
                @endforeach  
            </tbody>
          </table>
    </table>
  </div>


@stop
