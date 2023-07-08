@extends('adminlte::page')

@section('title', 'tanques')

@section('plugins.Sweetalert2', true)

@section('content')
    <section class="content">
        <div class="container-fluid p-4">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title my-auto">
                            <strong>TANQUE: {{ ' ' . $tanque->codigo }}</strong>
                        </h4>

                        <div class="card-tools">
                            <div class="d-flex">

                                <button type="button" class="btn btn-sm btn-danger px-2" data-toggle="modal"
                                    data-target="#modal-delete-tanque">
                                    <i class="fas fa-trash-alt" aria-hidden="true"></i>
                                </button>
                                <a href="{{ route('tanques.edit', $tanque) }}" class="btn btn-sm btn-info ml-1">
                                    <i class="fas fa-pen" aria-hidden="true"></i>
                                </a>

                                <x-alert-confirmation titulo="¿Estás seguro?" id="modal-delete-tanque">
                                    <x-slot name="mensaje">
                                        Esta accion es irreversible<br>
                                        Se eliminará el tanque '{{ $tanque->codigo }}' y toda la información relacionada al
                                        mismo
                                    </x-slot>
                                    <x-slot name="boton">
                                        <form action="{{ route('tanques.destroy', $tanque) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                        </form>
                                    </x-slot>
                                </x-alert-confirmation>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <label>Código</label>
                            <p class="form-control my-colorpicker1">{{ $tanque->codigo }}</p>
                        </div>
                        <div class="col-sm-4">
                            <label>Combustible</label>
                            <p class="form-control my-colorpicker1">{{ $tanque->combustible->nombre }}</p>

                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Estado</label>
                                <p class="form-control my-colorpicker1">
                                    {{ $tanque->estado ? 'Activo' : 'Inactivo' }}</p>
                            </div>
                        </div>
                    </div>

                    <label>Descripción</label>
                    <p class="border rounded p-2">{{ $tanque->descripcion }}</p>

                    <div class="py-1">
                        <hr />
                    </div>

                    <div class="row py-2">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Cantidad disponible (lts)</label>
                                <p class="form-control my-colorpicker1">{{ $tanque->cantidad_disponible }}</p>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Cantidad mínima (lts)</label>
                                <p class="form-control my-colorpicker1">{{ $tanque->cantidad_min }}</p>
                            </div>

                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Capacidad del tanque (lts)</label>
                                <p class="form-control my-colorpicker1">
                                    {{ $tanque->capacidad }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="progress my-1" style="height: 4px;">
                                <div class="progress-bar bg-cyan "
                                    style="width:{{ ($tanque->cantidad_min * 100) / $tanque->capacidad }}%;"></div>
                            </div>
                            <div class="progress" style="height: 40px;">
                                <div class="progress-bar text-left p-2 progress-bar-striped progress-bar-animated 
                                @if ($tanque->cantidad_disponible > $tanque->cantidad_min) bg-cyan
                                @else bg-red @endif"
                                    style="width: {{ ($tanque->cantidad_disponible / $tanque->capacidad) * 100 }}%">
                                </div>
                            </div>
                            @if ($tanque->cantidad_disponible > $tanque->cantidad_min)
                                <small>No se requiere recarga</small>
                            @else
                                <small class="text-danger">¡Es necesario recargar el tanque!</small>
                            @endif

                        </div>

                        <div class="col-md-4">
                            <div class="accordion" id="acordion_recarga">
                                <div class="card mt-n2">
                                    <div class="card-header text-center" id="headingTwo">
                                        <p class="card-title card-success pt-1">
                                            <i class="fas fa-battery-full pr-1"></i>
                                            <strong>Recarga</strong>
                                        </p>

                                        <div class="card-tools text-sm">

                                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                                data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                                <i class="fas fa-plus text-sm"></i>
                                            </button>

                                        </div>

                                    </div>
                                    <div id="collapseTwo"
                                        class="collapse {{ $errors->any() ? 'show' : '' }} mt-n1 mb-n1 mx-n2"
                                        aria-labelledby="headingTwo" data-parent="#acordion_recarga">
                                        <div class="card-body">
                                            <form action="{{ route('tanques.recargar', $tanque) }}" method="post">
                                                @method('put')
                                                @csrf

                                                <div class="input-group @error('cantidad_recarga') is-invalid @enderror">
                                                    <input type="number"
                                                        class="form-control @error('cantidad_recarga') is-invalid @enderror"
                                                        placeholder="cantidad" name="cantidad_recarga"
                                                        aria-describedby="validacionRecarga" step=".01" min=".01"
                                                        value="{{ old('cantidad_recarga') }}" required>

                                                    <button class="btn btn-primary btn-sm" type="submit"
                                                        id="button">Recargar
                                                    </button>

                                                </div>
                                                @error('cantidad_recarga')
                                                    <div id="validacionRecarga" class="invalid-feedback">
                                                        *{{ $message }}
                                                    </div>
                                                @enderror
                                            </form>

                                            <hr />

                                            <form action="{{ route('tanques.llenar', $tanque) }}" method="post">
                                                @method('put')
                                                @csrf

                                                <button class="btn btn-success btn-block" type="submit" id="button">
                                                    Llenar tanque
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="d-flex justify-content-between ">
                        <p class="my-auto"><small>Creado: {{ $tanque->created_at }}</small></p>
                        <p class="my-auto"><small>Ultima modificación: {{ ' ' . $tanque->updated_at . '  ' }}</small></p>
                    </div>
                </div>
            </div>
        </div>

    </section>
@stop

@section('js')
    @if (session('mensaje'))
        <script>
            $(document).ready(function() {
                // Read flag from the controller.
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });

                Toast.fire({
                    icon: 'success',
                    title: '{{ session('mensaje') }}'
                })

            });
        </script>
    @endif
@stop
