@extends('layouts.reportes')

@section('title', 'Vehiculos registrados')

@section('table-title', 'VEHICULOS REGISTRADOS')

@section('filters')
    <div class="col-auto mb-n4">
        <div class="collapse" id="collapseFilters">
            <div class="card card-body">
                <div class="col mt-n2 mb-n4">
                    <div class="row mx-n3 ">
                        <div class="input-group input-group-sm">
                            <input name="buscar" id="buscar" type="text" class="form-control"
                                placeholder="Placa o cliente">
                            <div class="input-group-append">
                                <div class="btn btn-default">
                                    <span class="fa fa-search"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mx-n3 pt-2">
                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupFileAddon01">Tipo</span>
                            </div>
                            <select class="form-control" name="tipo" id="tipo">
                                <option value="">- - - - </option>
                                @foreach ($tipos as $tipo)
                                    <option value="{{ $tipo }}">{{ $tipo }}</option>
                                @endforeach
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-default" type="button" id="tipo_filter">
                                    <span class="fas fa-check"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-auto ml-n2 mr-n2">
        <div id="filters" class="btn btn-info btn-sm" data-toggle="collapse" data-target="#collapseFilters"
            aria-controls="collapseFilters" aria-expanded="false"><span class="fas fa-filter my-auto"></span>
        </div>
    </div>
@endsection

@section('table-tr')
    <th>PLACA</th>
    <th>CLIENTE</th>
    <th>TIPO</th>
    <th>B-SISA</th>
    <th>ACCIONES</th>
@endsection


@section('datatable-js')
    <script>
        $(document).ready(function() {
            var table = $('#table').DataTable({
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
                dom: '<"mt-n1 mb-n2"r<"d-flex justify-content-start pl-4"l><"d-flex px-3"t><"row justify-content-between my-auto pt-2 px-4 pb-4"ip>>',
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

            $('#tipo_filter').click(function() {
                table.draw()
            })

            $('#buscar').on('change', function() {
                table.draw()
            })
        })
    </script>
@endsection
