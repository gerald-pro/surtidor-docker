@extends('adminlte::page')

@section('title', 'Tanques')

@section('content')
    <section class="content">
        <div class="container-fluid p-4">

            <div class="card">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="px-3 pt-3">
                            <strong>TANQUES</strong>
                        </h3>
                        <p class="px-3 text-sm">
                            LISTA DE TANQUES REGISTRADOS
                        </p>
                    </div>
                    <div>
                        {{-- <span class="fa fa-battery-quarter fa-4x"></span> --}}
                        <a href="{{ route('tanques.create') }}" class="btn btn-primary my-4 mx-3">Nuevo</a>
                    </div>
                </div>
            </div>

            @foreach ($tanques as $tanque)
                <div class="card my-4">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h3 class="card-title card-success pr-2">
                                    <strong>{{ 'Tanque: ' . $tanque->codigo . ' ' . ' ' }}</strong>
                                </h3>
                                @switch($tanque->combustible->tipo)
                                    @case('gasolina')
                                        <span class="badge px-1 bg-orange">
                                        @break

                                        @case('etanol')
                                        <span class="badge px-1 bg-yellow">
                                        @break

                                        @case('diesel')
                                        <span class="badge px-1 bg-red">
                                        @break

                                        @default
                                    @endswitch
                                    {{ $tanque->combustible->nombre }}
                                </span>
                            </div>
                            <div class="card-tools">
                                <a class="btn btn-tool" href="{{ route('tanques.show', $tanque) }}">
                                    <i class="fa fa-eye"></i>
                                </a>
                               {{--  <a class="btn btn-tool" href="{{ route('tanques.edit', $tanque) }}">
                                    <i class="fa fa-pen"></i>
                                </a>
 --}}
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Capacidad: </label>
                                    <p>{{ $tanque->capacidad . ' litros' }}</p>
                                </div>

                            </div>
                            <div class="col-sm-3">
                                <div class="form-group text-left">
                                    <label>Ultima carga</label>
                                    <p>
                                        {{ is_null($tanque->fecha_carga) ? '- - -' : \Carbon\Carbon::parse($tanque->fecha_carga)->format('d/m/Y - h:i') }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group text-left">
                                    <label>Estado</label>
                                    <p>
                                        {{ $tanque->estado ? 'Activo' : 'Inactivo' }}
                                    </p>
                                </div>
                            </div>
                            <div class="col col-sm-3">
                                <div class="progress my-1" style="height: 4px;">
                                    <div class="progress-bar bg-cyan "
                                        style="width:{{ ($tanque->cantidad_min * 100) / $tanque->capacidad }}%;"></div>
                                </div>
                                <div class="progress" style="height: 35px;" aria-valuemax="100">
                                    <div class="progress-bar text-left p-2 progress-bar-animated  
                                    @if ($tanque->cantidad_disponible > $tanque->cantidad_min) bg-cyan
                                    @else bg-red @endif "
                                        style="width:{{ ($tanque->cantidad_disponible * 100) / $tanque->capacidad }}%">
                                        {{ round(($tanque->cantidad_disponible * 100) / $tanque->capacidad, 1) . '%' }}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </section>
@stop

@section('css')
@stop
