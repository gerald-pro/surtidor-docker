@extends('adminlte::page')

@section('title', 'Bitacora')

{{-- @section('content_header')
    <h1>Clientes</h1>
@stop --}}

@section('content')
    <section class="content">
        <div class="container-fluid pt-4">
            <div class="card">
                <div class="card-header justify-content-between">
                    <div class="row g-2">
                        <div class="col-sm-6 p-2">
                            <h3 class="card-title">
                                <strong>LISTA DE TRANSACCIONES</strong>
                            </h3>
                        </div>


                    </div>

                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="height: 450;">

                        <table class="table table-hover table-head-fixed">
                            <thead class="table-light">
                                <tr>
                                    <th>Nro</th>
                                    <th>NOMBRE</th>
                                    <th style="width: 15%">Accion</th>
                                    <th >Tabla</th>
                                    <th >Fecha</th>
                                    <th >URL</th>
                                    <th >IP</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($audits as $audit)
                                    <tr >
                                        <td >{{ ++$i }}</td>

										<td>{{ $audit->name }}</td>
                                        <td >{{$audit->event }}</td>
                                        <td >{{$audit->auditable_type}}</td>
                                        <td>{{ $audit->created_at }}</td>
                                        <td>{{ $audit->url }}</td>
                                        <td>{{ $audit->ip_address }}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">

                                              <a href="{{ url('/bitacora/' . $audit->id . '/') }}"
                                                class="btn btn-success">
                                                  VER
                                              </a>
                                             </div>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>


                </div>
                <!-- /.card-body -->
            </div>
        </div><!-- /.container-fluid -->

    </section>
@stop
