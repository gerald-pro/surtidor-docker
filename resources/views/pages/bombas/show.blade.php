@extends('adminlte::page')

@section('title', 'bombas')

@section('content')
    <section class="content">
        <div class="container-fluid p-4">
            <!-- SELECT2 EXAMPLE -->
            <div class="card">
                <div class="bg-dark p-4">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">
                            <strong>DATOS DE LA BOMBA</strong>
                        </h4>
                        <form action="{{ route('bombas.destroy', $bomba) }}" method="POST">
                            @csrf
                            @method('delete')
                            <div class="card-tools">
                                <button type="submit" class="btn btn-danger px-2" onclick="return confirm('¿Estas seguro?')">
                                    <i class="fas fa-trash-alt" aria-hidden="true">
                                    </i>
                                </button>
                                <a href="{{ route('bombas.edit', $bomba) }}" class="btn btn-info px-2">
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
                                <p class="form-control my-colorpicker1">{{ $bomba->codigo }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nombre</label>
                                <p class="form-control my-colorpicker1">{{ $bomba->nombre }}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Combustible</label>
                                <p class="form-control my-colorpicker1">{{ $bomba->tanque->combustible->nombre }}</p>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Estado</label>
                                <p class="form-control my-colorpicker1">
                                    {{ $bomba->codigo ? 'Activo' : 'Inactivo' }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Descripción</label>
                        <p class="border rounded p-2">{{ $bomba->descripcion }}</p>

                        <div class="py-1">
                            <hr />
                        </div>

                    </div>



                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between ">
                        <p><small>Creado: {{ $bomba->created_at }}</small></p>
                        <p><small>Ultima modificación: {{ ' ' . $bomba->updated_at . '  ' }}</small></p>
                    </div>
                </div>
            </div>

            <!-- /.container-fluid -->
    </section>
@stop
