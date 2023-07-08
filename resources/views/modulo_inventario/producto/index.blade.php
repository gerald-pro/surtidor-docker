@extends('adminlte::page')

@section('content_header')
    <h1>Almacen: Lista de Productos</h1>
@stop

@section('content')

    <div class="d-grid gap-2">
        <a class="btn btn-success" href="{{ route('producto.create') }}"> crear </a>
    </div>

    <div class="table-responsive">

        <table class="table caption-top" id="table_productos">
            <caption></caption>
            <thead>
                <tr>

                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Precio de compra</th>
                    <th scope="col">Precio de venta</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Imagen</th>
                    <th scope="col">Accion</th>

                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>

    </div>

@stop

@section('css')
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/r-2.3.0/datatables.min.css" />
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
            $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, {
                className: 'btn btn-sm'
            })

            var table = $('#table_productos').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "{{ route('producto.index') }}",
                dataType: 'json',
                type: "GET",
                language: {
                    searchPlaceholder: "nombre",
                    url: 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json'
                },
                dom: 'lBfrtip',
                buttons: [{
                        extend: 'collection',
                        text: 'Exportar',
                        className: 'bg-black',
                        buttons: [{
                                extend: 'excel',
                                className: 'btn-secondary',
                                exportOptions: {
                                    columns: ':visible'
                                }
                            },
                            {
                                extend: 'pdf',
                                className: 'btn btn-secondary',
                                exportOptions: {
                                    columns: ':visible'
                                }
                            },
                            {
                                extend: 'print',
                                exportOptions: {
                                    columns: ':visible'
                                }
                            },
                        ]

                    },
                    {
                        extend: 'colvis',
                        className: 'bg-red',
                        text: 'Visibilidad Columnas',
                        exportOptions: {
                            columns: ':visible'
                        },
                    },
                ],

                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'nombre',
                        name: 'nombre',
                    },
                    {
                        data: 'precio_compra',
                        name: 'precio_compra',
                    },
                    {
                        data: 'precio_venta',
                        name: 'precio_venta',
                    },
                    {
                        data: 'cantidad',
                        name: 'cantidad',
                    },
                    {
                        data: 'estado',
                        name: 'estado',
                        orderable: false,
                        render: function(estado, type, row) {
                            return (estado) ? '<span class="badge bg-success">DISPONIBLE</span>' :
                                ' <span class="badge bg-secondary">NO DISPONIBLE</span> ';
                        }

                    },

                    {
                        data: 'imagen',
                        name: 'imagen',
                        searchable: false,
                        orderable: false,
                        render: function(data, type, row) {
                            url = data;
                            if (data === null) {
                                url = "{{ asset('img/producto-default.jpg') }}"
                            }
                            return `<img src="${url}"  height="80px">`
                        }

                    },

                    {
                        data: null,
                        name: 'actions',
                        searchable: false,
                        orderable: false,
                        render: function(data, type, row) {
                            let actions =
                                '<div class="btn-group" role="group" aria-label="Basic example">' +
                                `<a style="text-align: right" href="{{ url('/producto/${row.id}/') }}" class="btn btn-success">` +
                                '<i class="fa fa-eye"></i>' +
                                '</a>' +
                                `<a style="text-align: right" href="{{ url('/producto/${row.id}/edit') }}"
                                   class="btn btn-warning">` +
                                '<i class="fa fa-pen"></i>' +
                                '</a>' +
                                `<form action="{{ url('/producto/${row.id}') }}"
                                       method="post">` +
                                ' @csrf' +
                                `{{ method_field('DELETE') }}` +
                                `<button type="submit" onclick="return confirm('¿Estas Seguro de Eliminarlo?')" class="btn btn-danger">` +
                                '<i class="fa fa-trash"></i>' +
                                '</button>' +
                                '</form>' +
                                '</div>';
                            return actions;
                        }
                    }
                ],

            })

            table.buttons().container()
                .appendTo($('.col-sm-6:eq(0)', table.table().container()));
        })
    </script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/r-2.3.0/datatables.min.js">
    </script>
@stop
