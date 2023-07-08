@extends('adminlte::page')

@section('title', 'vehiculos')

@section('plugins.Sweetalert2', true)

@section('content')
    <section class="content">
        <div class="container-fluid p-4">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title my-auto">
                            <strong>REGISTRAR VEHICULO</strong>
                        </h4>
                    </div>
                </div>
                <div class="card-body">
                    @include('partials.vehiculos.form_create')
                </div>
            </div>
        </div>
    </section>
@stop
