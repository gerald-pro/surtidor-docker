@extends('adminlte::page')

@section('title', 'Lista de vehiculos')

@section('content')

    <section class="content">
        <div class="container-fluid pt-4">
            <div class="card">
                <div class="card-header my-auto">
                    <div class="row justify-content-between my-n1">
                        <div class="col-sm-4 my-auto">
                            <h3 class="card-title">
                                <strong>LISTA DE VEHICULOS</strong>
                            </h3>
                        </div>
                        <div class="d-flex justify-content-end" id="botones"></div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-end pb-1" id="topRowTable">
                        <div class="col-auto">
                            <div class="input-group input-group-sm">
                                <select class="form-control" name="tipo" id="tipo">
                                    <option value="">Tipo</option>
                                    @foreach ($tipos as $tipo)
                                        <option value="{{ $tipo }}">{{ $tipo }}</option>
                                    @endforeach
                                </select>
                                <div class="input-group-append">
                                    <div id="filtrar" class="btn btn-default"><span class="fas fa-filter my-auto"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="input-group input-group-sm">
                                <input name="buscar" id="buscar" type="text" class="form-control"
                                    placeholder="placa o dueño">
                                <div class="input-group-append">
                                    <div class="btn btn-default">
                                        <span class="fa fa-search"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('partials.vehiculos.table_vehiculos')
                </div>
            </div>
        </div>
    </section>
@stop

@section('css')
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/r-2.3.0/datatables.min.css" />
    <style>
        div.dt-button-collection {
            width: 129px;
        }

        div.dt-button-collection .dt-button {
            min-width: 80px;
        }
    </style>
@stop

@section('js')
    <script>
        $(window).on('load', function() {
            let a = 'hola'
            if ('{{ $errors->any() }}') {
                $('#formCreateModal').modal('show');
            }
        });
    </script>


    <script>
        $(document).ready(function() {
            var table = $('#table_vehiculos').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: "{{ route('vehiculos.index') }}",
                    data: function(d) {
                        d.tipo = $('#tipo').val();
                        d.buscar = $('#buscar').val();
                    },
                },
                dataType: 'json',
                type: "POST",
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json'
                },
                dom: '<"mt-n1 mb-n2"r<"row justify-content-start pl-2"l>t<"row justify-content-between my-auto pt-2 px-3"ip>>',
                columns: [{
                        data: 'placa',
                        name: 'placa',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'cliente',
                        name: 'cliente',
                        searchable: false,
                        orderable: true
                    },
                    {
                        data: 'tipo',
                        name: 'tipo',
                        searchable: false,
                        orderable: true
                    },
                    {
                        data: 'b_sisa',
                        name: 'b_sisa',
                        searchable: false,
                        orderable: true,
                        render: function(data, type, row) {
                            return (data == true) ? '<span class="badge bg-success">HÁBIL</span>' :
                                ' <span class="badge bg-secondary">INHÁBIL</span> ';
                        }

                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        searchable: false,
                        orderable: false
                    }
                ],

            });
            new $.fn.dataTable.Buttons(table, {
                buttons: [{
                        extend: 'collection',
                        text: '<i class="fas fa-cog"></i>',
                        className: 'bg-navy btn-sm my-1',
                        align: 'button-right',
                        fade: 150,
                        buttons: [{
                            extend: 'colvis',
                            className: 'btn-secondary btn-sm',
                            text: 'Ver columnas',
                            align: 'button-right',
                            fade: 150,
                            exportOptions: {
                                columns: ':visible'
                            },
                        }, ]
                    },
                    {
                        extend: 'collection',
                        text: '<i class="fas fa-download"></i>',
                        className: 'bg-maroon btn-sm my-1',
                        fade: 150,
                        align: 'button-right',
                        buttons: [{
                                text: 'Copiar',
                                extend: 'copy',
                                className: 'btn-secondary btn-sm',
                            },
                            {
                                text: 'Imprimir',
                                extend: 'print',
                                className: 'btn-secondary btn-sm',
                                exportOptions: {
                                    columns: ':visible'
                                }
                            },
                            {
                                extend: 'excel',
                                className: 'btn-secondary btn-sm',
                                exportOptions: {
                                    columns: ':visible'
                                }
                            },
                            {
                                extend: 'pdf',
                                className: 'btn btn-secondary btn-sm',
                                exportOptions: {
                                    columns: ':visible'
                                }
                            },
                            {
                                extend: 'csv',
                                className: 'btn btn-secondary btn-sm',
                                exportOptions: {
                                    columns: ':visible'
                                }
                            },
                            {
                                text: 'HTML (Todo)',
                                className: 'btn btn-secondary btn-sm',
                                action: function(e, dt, node, config) {
                                    window.location.href =
                                        `{{ route('vehiculos.export.html') }}`;
                                }
                            }
                        ]
                    },
                ],
            });

            table.buttons().containers().appendTo('#botones');

            $('#filtrar').click(function() {
                table.draw()
            })

            $('#buscar').on('change', function() {
                table.draw()
            })
        })
    </script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/r-2.3.0/datatables.min.js">
    </script>
@stop
