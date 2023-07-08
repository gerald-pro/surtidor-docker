@extends('layouts/master')

@section('content_header')
    
@stop

@section('content')
    <div class="card" style="background-color: antiquewhite">
        <h1 style="text-align: center">FACTURA</h1>
        <div class="card-body">
            <form action="{{route('factura_combustible.store',[$nota_venta_combustible->id])}}" method="POST">
                @csrf
                <!--inicio campo nombre-->
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input name="nombre" type="text" class="form-control" id="nombre" placeholder="introduzca nombre" required value="{{$cliente->nombre.' '.$cliente->apellido}}" style="border-inline: ">
                </div>
                <!--fin campo nombre-->
                <!--inicio campo nit-->
                <div class="mb-3">
                    <label for="nit" class="form-label">Nit</label>
                    <input name="nit" type="number" class="form-control" id="nit" placeholder="introduzca nit" required>
                </div>
                <!--fin campo nit-->
                <!--aqui empieza el codigo del boton guardar-->
                <div style="text-align: right">
                        <a href="{{ route('nota_venta_combustible.show',[$nota_venta_combustible->id]) }}" class="btn btn-warning">
                            Atras
                        </a>   
                        <button   type="submit" class="btn btn-success">
                            Generar Factura
                        </button>
                </div>
            </form>
            <!--aqui termina el codigo del boton guardar-->
        </div>
    </div>

@stop