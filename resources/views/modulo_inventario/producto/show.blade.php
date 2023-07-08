@extends('adminlte::page')

@section('content')
    <section class="content">
        <div class="container-fluid py-4">
            <div class="card">
                <div class="card-body">

                    <form method="POST" action="{{ url('/producto/' . $producto->id) }}">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="row">
                            <div class="col-sm-2 my-auto mx-auto pb-2">
                                <div class="d-flex">
                                    @if ($producto->imagen)
                                        <img height="190px"
                                            src="{{ app('firebase.storage')->getBucket()->object($producto->imagen)->signedUrl(\Carbon\Carbon::now()->addSeconds(5)) }}">
                                    @else
                                        <img height="190px" src="{{ asset('img/producto-default.jpg') }}" class="img-fluid img-thumbnail">
                                    @endif
                                </div>
                            </div>

                            <div class="col-10">
                                <div class="row p-0">
                                    <div class="col-auto">
                                        <label for="nombre">Nombre</label>
                                        <p type="text" class="border rounded p-2">{{ $producto->nombre }}</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <label for="descripcion">Descripcion</label>
                                        <p class="border rounded p-2">{{ $producto->descripcion }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-sm-3">
                                <label for="precio_compra" class="form-label">Precio de compra</label>
                                <p type="text" class="form-control">{{ $producto->precio_compra }}</p>
                            </div>

                            <div class="col col-sm-3">
                                <label for="precio_venta" class="form-label">Precio de venta</label>
                                <p type="text" class="form-control">{{ $producto->precio_venta }}</p>
                            </div>

                            <div class="col col-sm-3">
                                <label for="cantidad" class="form-label">Stock</label>
                                <p type="text" class="form-control">{{ $producto->cantidad }}</p>
                            </div>
                            <div class="col col-sm-3">
                                <label for="estado">Estado</label>
                                <p type="text" class="form-control my-colorpicker1">
                                    {{ $producto->estado ? 'Disponible' : 'No Disponible' }}</p>
                            </div>

                        </div>
                        <div class="row justify-content-end">
                            <div class="col-auto ">
                                <a href="{{ url('/producto') }}" class="btn btn-secondary">
                                    Volver
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@stop
