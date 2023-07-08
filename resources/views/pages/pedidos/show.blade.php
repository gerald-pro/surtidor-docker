@extends('adminlte::page')

@section('title', 'pedidos')

@section('content')
    <section class="content">
        <div class="container-fluid p-4">
            <!-- SELECT2 EXAMPLE -->
            <div class="card">
                <div class="bg-purple p-4">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">
                            <strong>DATOS DEL PEDIDO</strong>
                        </h4>
                        <form action="{{ route('pedidos.destroy', $pedido) }}" method="POST">
                            @csrf
                            @method('delete')
                            <div class="card-tools">
                                <button type="submit" class="btn btn-danger px-2" onclick="return confirm('¿Estas seguro?')">
                                    <i class="fas fa-trash-alt" aria-hidden="true">
                                    </i>
                                </button>
                                <a href="{{ route('pedidos.edit', $pedido) }}" class="btn btn-info px-2">
                                    <i class="fas fa-pen" aria-hidden="true">
                                    </i>
                                </a>


                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Codigo</label>
                                <p class="form-control my-colorpicker1">{{ $pedido->codigo }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Fecha</label>
                                <p class="form-control my-colorpicker1">{{ $pedido->fecha }}</p>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Estado</label>
                                <p class="form-control my-colorpicker1">
                                    {{ $pedido->codigo ? 'Activo' : 'Inactivo' }}</p>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Producto</label>
                                <p class="form-control my-colorpicker1">{{ $pedido->id_producto }}</p>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Usuario</label>
                                <p class="form-control my-colorpicker1">{{ $pedido->id_usuario }}</p>
                            </div>

                        </div>
                       
                    </div>
                    
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between ">
                        <p><small>Creado: {{ $pedido->created_at }}</small></p>
                        <p><small>Ultima modificación: {{ ' ' . $pedido->updated_at . '  ' }}</small></p>
                    </div>
                </div>
            </div>

            <!-- /.container-fluid -->
    </section>
@stop
