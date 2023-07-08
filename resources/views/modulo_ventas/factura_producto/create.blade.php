@extends('layouts/master')

@section('content_header')
    <h1>Factura</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('factura_producto.store',[$nota_venta_producto_id])}}" method="POST">
                @csrf
                <!--inicio campo nombre-->
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input name="nombre" type="text" class="form-control" id="nombre" placeholder="introduzca nombre" required value="{{$cliente->nombre.' '.$cliente->apellido}}">
                </div>
                <!--fin campo nombre-->
                <!--inicio campo nit-->
                <div class="mb-3">
                    <label for="nit" class="form-label">Nit</label>
                    <input name="nit" type="number" class="form-control" id="nit" placeholder="introduzca nit" required>
                </div>
                <!--fin campo nit-->
                <!--aqui empieza el codigo del boton guardar-->
                <div class="row mb-0">
                    <div class="col-md-10 offset-md-2">
                        <a href="{{ route('detalle_nota_venta_producto.show',[$nota_venta_producto_id]) }}" class="btn btn-secondary">
                            Atras
                        </a>
                    </div>
                </div>
                
                <div class="row mb-0" style="text-align:right">
                    <div class="col-md-10 offset-md-2">
                        <button   type="submit" class="btn btn-success">
                            Generar Factura
                        </button>
                    </div>
                </div>
            </form>

            <!--aqui termina el codigo del boton guardar-->
        </div>
    </div>

@stop