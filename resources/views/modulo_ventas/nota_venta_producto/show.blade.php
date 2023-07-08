@extends('adminlte::page')

@section('content_header')

@stop

@section('content')

<div class="card text-center">
    <div class="card-header">
        <h1 style="font-weight: bolder"> NOTA DE VENTA</h1>
    <label for="Nro" class="d-flex justify-content-end" style="font-size: x-large">Nro: {{$nota_venta_producto->id}}</label> 
    <label for="fecha" class="d-flex justify-content-end" style="font-size: x-large">fecha/hora: {{ $nota_venta_producto->fecha }}</label>  
    </div>
    <div class="card-body">
    <!--inicio campo nombre del cliente-->
    <ul class="list-group" style="text-align:left">
        <li class="list-group-item" style="font-size: medium"> <strong>Nombre del cliente:</strong> {{ $nota_venta_producto->nombre }} {{ $nota_venta_producto->apellido }}</li>
        <li class="list-group-item" style="font-size: medium"><strong>CI del cliente:</strong> {{ $nota_venta_producto->ci }}</li>
        <li class="list-group-item" style="font-size: medium"> <strong>Telefono del cliente:</strong> {{ $nota_venta_producto->telefono }}</li>
      </ul>
    <!--fin campo nombre del cliente-->
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
                                    <th scope="col">Precio</th>
                                    <th scope="col">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($detalles as $detalle)
                                <tr>
                                    <td>{{$detalle->producto_id}}</td>
                                    <td>{{$detalle->nombre}}</td>
                                    <td>{{$detalle->cantidad}}</td>
                                    <td>{{$detalle->precio_venta}}</td>
                                    <td>{{$detalle->cantidad*$detalle->precio_venta}}</td>
                                </tr> 
                                @endforeach 
                            </tbody>
                        </table>
                    </table>
                </div>
                 
                 <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1"><strong>total</strong></span>
                    </div>
                    <p type="number" class="form-control" style="text-align: right">{{ $nota_venta_producto->total }}</p>
                 </div>

            </div>
          </div>
         
        <div class="d-flex justify-content-end">
            <a type="button" class="btn btn-warning" href="{{ route('ventas_productos.reportes') }}" style="margin:5px">
                Atras 
            </a>
                <div>                   
                    @if($existeFactura)
                                    <a type="button" class="btn btn-primary" href="{{ route('factura_producto.generateInvoice',[$nota_venta_producto->id]) }}" style="margin:5px">
                                        Ver Factura
                                    </a>                
                    @else
                                    <a type="button" class="btn btn-success" href="{{ route('factura_producto.create',[$nota_venta_producto->id]) }}" style="margin:5px">
                                        siguiente
                                    </a>  
                    @endif        
                </div>
        </div>
    </div>
</div>

@stop