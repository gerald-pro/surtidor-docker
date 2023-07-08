@extends('adminlte::page')

@section('title', 'Backups')

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
                                <strong>LISTA DE BACKUPS</strong>
                            </h3>

                        </div>


                    </div>
                    <h3>
                        <a href="{{ url('/backups/create') }}"
                        class="btn btn-success">
                          CREAR BACKUP
                        </a>

                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="height: 450;">

                        <table class="table table-hover table-head-fixed">
                            <thead class="table-light">
                                <tr>
                                    <th>Nro</th>
                                    <th>NOMBRE</th>
                                    <th >Fecha</th>
                                    <th>Tamaño</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($archivos as $archivo)
                                    <tr >
                                        <td >{{ ++$i }}</td>
										<td >{{$archivo['name'] }}</td>
                                        <td >{{$archivo['fecha'] }}</td>
                                        <td >{{$archivo['size']}}</td>
                                      

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
