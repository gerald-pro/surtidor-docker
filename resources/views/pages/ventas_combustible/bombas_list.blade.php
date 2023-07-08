@extends('adminlte::page')

@section('content_header')

@stop

@section('content')

    @foreach ($bombas as $bomba)
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $bomba->nombre }}</h5>
                            <p class="card-text">{{ $bomba->combustible }}</p>
                            <a href="{{ route('venta.combustible.create', $bomba) }}" class="btn btn-primary">Ir a
                                {{ $bomba->nombre }}</a>
                        </div>
                    </div>
                </div>
            </div>
    @endforeach


@stop
