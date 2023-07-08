@extends('adminlte::page')

@section('content_header')

@stop

@section('content')

<div class="card text-center">
    <div class="card-header">
        <h1 style="font-weight: bolder"> NOTA DE COMPRA</h1>
    <label for="Nro" class="d-flex justify-content-end" style="font-size: x-large">Nro: {{$nota_producto_id->id}}</label> 
    <label for="fecha" class="d-flex justify-content-end" style="font-size: x-large">fecha: {{ $nota_producto->fecha }}</label>  
    </div>

    <div class="card-body">
        <div class="card">
            <div class="card-header" style="background-color: green">
                <h5 style="color: white"><strong>PROVEEDOR</strong></h5>
            </div>
            <!--inicio campo nombre del cliente-->
        <ul class="list-group" style="text-align:left">
            <li class="list-group-item" style="font-size: medium"> <strong>Nombre: </strong>{{ $nota_producto->nombre }}</li>
            <li class="list-group-item" style="font-size: medium"><strong>Direccion: </strong>{{ $nota_producto->direccion }}</li>
            <li class="list-group-item" style="font-size: medium"> <strong>Telefono: </strong>{{ $nota_producto->telefono}}</li>
            <li class="list-group-item" style="font-size: medium"> <strong>Nit: </strong>{{ $nota_producto->nit}}</li>
            <li class="list-group-item" style="font-size: medium"> <strong>Descripcion: </strong>{{ $nota_producto->descripcion}}</li>
        </ul>
        <!--fin campo nombre del cliente-->
        </div>
    </div>

    <!-- incio seccion de detalle de la nota de venta -->
    <div class="card-footer text-muted">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <table class="table caption-top">
                            <caption></caption>
                            <thead class="table-white bg-orange">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Producto</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Precio(Bs)</th>
                                    <th scope="col">Subtotal(Bs)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lista_productos as $producto)
                                <tr>
                                    <td>{{$producto->producto_id}}</td>
                                    <td>{{$producto->nombre}}</td>
                                    <td>{{$producto->cantidad}}</td>
                                    <td>{{$producto->precio_compra}}</td>
                                    <td>{{$producto->cantidad*$producto->precio_compra}}</td>
                                </tr> 
                                @endforeach 
                            </tbody>
                        </table>
                    </table>
                </div> 
            </div>
        </div>
        <div style="text-align: right">
            <!--inicio campo total-->
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1"><strong>total</strong></span>
                </div>
                <p type="number" class="form-control" style="text-align: right">{{ $nota_producto->total }}</p>
            </div>
            <!--fin campo total-->
            <!--inicio campo botones-->
                <a href="{{ url('/nota_producto') }}" class="btn btn-success">
                  Atras
                </a> 
            <!--fin campo botones-->
        </div>
    </div>
</div>
@stop