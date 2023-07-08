@extends('adminlte::page')

@section('title', 'Combustible')

@section('content')
    <section class="content">
        <div class="container-fluid p-4">

            <!-- SELECT2 EXAMPLE -->
            <div class="bg-dark p-3">
                <div class=" card-header-primary">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h3 class="px-3 pt-3">
                                <strong>COMBUSTIBLE</strong>
                            </h3>
                            <p class="px-3 text-sm">
                                LISTA DE COMBUSTIBLES REGISTRADOS
                            </p>
                        </div>
                        <div class="p-3">
                            <span class="fa fa-battery-quarter fa-4x"></span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- SELECT2 EXAMPLE -->
            @foreach ($combustibles as $combustible)
                <div class="card my-4">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h3 class="card-title card-success pr-2">
                                    <strong>{{ $combustible->nombre }}</strong>
                                </h3>

                            </div>
                            <div class="card-tools">
                                <a class="btn btn-tool" href="{{ route('combustibles.show', $combustible) }}">
                                    <i class="fa fa-eye"></i>
                                </a>

                                <a class="btn btn-tool" href="{{ route('combustibles.edit', $combustible) }}">
                                    <i class="fa fa-pen"></i>
                                </a>

                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <label>Precio Compra: </label>
                                <p type="text" class="">{{ $combustible->precio_compra . ' Bs' }}</p>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Precio Venta</label>
                                    <p type="text" class="">{{ $combustible->precio_venta }}</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Unidad de Medida</label>
                                    <p type="text" class="">{{ $combustible->unidad_medida }}</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
        <!-- /.container-fluid -->
    </section>
@stop
