@extends('adminlte::page')

@section('title', 'Pedidos')

@section('content')
    <section class="content">
        <div class="container-fluid p-4">
            <body>
            <!-- SELECT2 EXAMPLE -->
            <div class="bg-purple p-3">
                <div class=" card-header-primary">
                    <div class="d-flex justify-content-between">
                         <div>
                                <h3 class="px-3 pt-3">
                                     <strong>PEDIDOS</strong>
                                </h3>
                                    <p class="px-3 text-sm">
                                          LISTA DE PEDIDOS REGISTRADOS
                                    </p>
                        </div>
                    <div class="p-3">
                        <span class="fa fa-shopping-bag fa-4x"></span>
                      
                    </div>
                </div>
            </div>
            </div>
        </body>
            <!-- SELECT2 EXAMPLE -->
            @foreach ($pedidos as $pedido)
                <div class="card my-4">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h3 class="card-title card-success pr-2">
                                    <strong>{{ 'Codigo: ' . $pedido->codigo . ' ' . ' ' }}</strong>
                                </h3>
                               
                            </div>
                            <div class="card-tools">
                                <a class="btn btn-tool" href="{{ route('pedidos.show', $pedido) }}">
                                    <i class="fa fa-eye"></i>
                                </a>

                                <a class="btn btn-tool" href="{{ route('pedidos.edit', $pedido) }}">
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
                                <div class="form-group">
                                    <label>Estado</label>
                                    <p type="text" class="">{{ $pedido->estado ? 'Activo' : 'Inactivo' }}</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Producto: </label>
                                <p type="text" class="">{{ $pedido->id_producto }}</p>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Usuario</label>
                                    <p type="text" class="">{{ $pedido->id_usuario}}</p>
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
