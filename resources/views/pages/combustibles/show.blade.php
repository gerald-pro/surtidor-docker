@extends('adminlte::page')

@section('title', 'combustibles')

@section('content')
    <section class="content">
        <div class="container-fluid p-4">
            <!-- SELECT2 EXAMPLE -->
            <div class="card">
                <div class="bg-dark p-4">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">
                            <strong>DATOS DEL COMBUSTIBLE</strong>
                        </h4>
                        <form action="{{ route('combustibles.destroy', $combustible) }}" method="POST">
                            @csrf
                            @method('delete')
                            <div class="card-tools">
                                <button type="submit" class="btn btn-danger px-2"
                                    onclick="return confirm('¿Estas seguro?')">
                                    <i class="fas fa-trash-alt" aria-hidden="true">
                                    </i>
                                </button>
                                <a href="{{ route('combustibles.edit', $combustible) }}" class="btn btn-info px-2">
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
                                <label>Nombre</label>
                                <p class="form-control my-colorpicker1">{{ $combustible->nombre }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tipo</label>
                                <p class="form-control my-colorpicker1">{{ $combustible->tipo }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Unidad Medida</label>
                                <p class="form-control my-colorpicker1">{{ $combustible->unidad_medida }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Precio Compra</label>
                                <p class="form-control my-colorpicker1">{{ $combustible->precio_compra }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Precio Venta</label>
                                <p class="form-control my-colorpicker1">{{ $combustible->precio_venta }}</p>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between ">
                        <p><small>Creado: {{ $combustible->created_at }}</small></p>
                        <p><small>Ultima modificación: {{ ' ' . $combustible->updated_at . '  ' }}</small></p>
                    </div>
                </div>
            </div>

            <!-- /.container-fluid -->
    </section>
@stop
