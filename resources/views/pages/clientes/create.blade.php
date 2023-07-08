@extends('adminlte::page')

@section('title', 'Clientes')

@section('content')
    <section class="content">
        <div class="container-fluid p-4">
            <div class="card">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="card-title px-3 py-3">
                            <strong>REGISTRAR NUEVO CLIENTE</strong>
                        </h3>
                    </div>
                </div>
            </div>

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title card-success">Datos</h3>
                </div>

                <div class="card-body">
                    @include('partials.clientes.form_create')
                </div>
            </div>
        </div>

    </section>
@stop
