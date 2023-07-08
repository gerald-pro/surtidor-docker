@extends('layouts.reportes')

@section('title', 'Reporte de ventas de productos')

@section('table-title', 'VENTAS DE PRODUCTOS')
{{-- <div class="d-grid gap-2">
    <a class="btn btn-success" href="{{ route('nota_venta_producto.create') }}"> crear </a>
</div> --}}

@section('filters')
    <div class="col-auto mb-n5">
        <div class="collapse" id="collapseFilters">
            <div class="card card-body">
                <div class="col mt-n2 mb-n4">
                    <div class="row mx-n3 ">
                        <div class="input-group input-group-sm">
                            <input name="buscar" id="buscar" type="text" class="form-control" placeholder="cliente">
                            <div class="input-group-append">
                                <div class="btn btn-default">
                                    <span class="fa fa-search"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mx-n3">
                        <div class="d-flex">
                            <label for="" class="col-form-label-sm">Desde
                                <input type="date" class="form-control form-control-sm" name="start_date"
                                    id="start_date">
                            </label>
                            <label for="" class="col-form-label-sm">Hasta
                                <input type="date" class="form-control form-control-sm" name="end_date" id="end_date">
                            </label>
                            <button type="button" class="btn btn-default btn-sm my-4" id="date_filter"><span
                                    class="fas fa-check"></span></button>
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
    <th scope="col">FECHA</th>
    <th scope="col">TOTAL (Bs)</th>
    <th scope="col">CLIENTE</th>
    <th scope="col">ACCION</th>
@endsection

@section('datatable-js')
    <script>
        $(document).ready(function() {
            var table = $('#table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: "{{ route('ventas_productos.reportes') }}",
                    data: function(d) {
                        d.buscar = $('#buscar').val();
                        d.start_date = $('#start_date').val();
                        d.end_date = $('#end_date').val();
                    },
                },
                dataType: 'json',
                type: "POST",
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json'
                },
                dom: '<"mt-n1 mb-n2"r<"d-flex justify-content-start pl-4"l><"d-flex px-3"t><"row justify-content-between my-auto pt-2 px-4 pb-4"ip>>',
                columns: [{
                        data: 'fecha',
                        name: 'fecha',
                        searchable: false,
                        orderable: true,
                    },
                    {
                        data: 'total',
                        name: 'total',
                        searchable: false,
                        orderable: true
                    },
                    {
                        data: 'cliente',
                        name: 'cliente',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        searchable: false,
                        orderable: false
                    },
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
                                        `{{ route('ventas_productos.export.html') }}`;
                                }
                            }
                        ]
                    },
                ],
            });

            table.buttons().containers().appendTo('#botones');

            $('#date_filter').click(function() {
                table.draw()
            })

            $('#buscar').on('change', function() {
                table.draw()
            })

            $('#start_date').on('change', function() {
                if ($('#end_date').val() === '') {
                    var start_date = $('#start_date').val()
                    $('#end_date').val(start_date)
                }
            })
        })
    </script>
@endsection
