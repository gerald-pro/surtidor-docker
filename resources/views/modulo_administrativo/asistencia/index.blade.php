@extends('adminlte::page')

@section('content_header')
    <h1>Lista de Asistencias </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            <ul class="list-group list-group-horizontal">
                <li class="list-group-item">
                    <!--aqui empieza el codigo del select-->
                    <div>
                        <label for="user_id" class="col-form-label ">Seleccione un turno</label>
                            <select class="form-control" id="turno_id" name="turno_id" onchange="onChangeSelectTurno()">
                                @foreach ($turnos_list as $turno)
                                    <option value="{{ $turno->id }}">{{ $turno->descripcion }}</option>
                                @endforeach
                            </select>
                    </div>
                    <!--aqui termina el codigo del select-->
                </li>
                <li class="list-group-item">
                    <!--aqui empieza el codigo del select-->
                    <div>
                        <label for="rango_fecha" class="col-form-label ">Seleccione una fecha</label>
                        <div>
                            <select class="form-control" id="rango_fecha" name="rango_fecha" onchange="onChangeSelect()">

                                <option value="hoy">hoy</option>
                                <option value="semana">esta semana</option>
                                <option value="mes">este mes</option>
                                <option value="personalizado">personalizado</option>

                            </select>
                        </div>
                    </div>
                    <!--aqui termina el codigo del select-->
                </li>
                <li class="list-group-item">
                    <!--aqui empieza el codigo del select-->
                    <div>
                        <label for="usuario" class="col-form-label ">Seleccione un empleado</label>
                        <div>
                            <select class="form-control" id="usuario" name="usuario">

                                <option value="0">todos</option>


                            </select>
                        </div>
                    </div>
                    <!--aqui termina el codigo del select-->
                </li>
                <li class="list-group-item">
                    <!--aqui empieza el codigo del fecha_inicio-->
                    <div class="mb-3" hidden id="select_fecha_inicio">
                        <label for="fecha_inicio" class="col-form-label">Fecha inicial</label>
                        <div>
                            <input name="fecha_inicio" type="date" class="form-control" id="fecha_inicio">
                        </div>
                    </div>
                    <!--aqui termina el codigo del fecha_inicio-->
                </li>
                <li class="list-group-item">
                    <!--aqui empieza el codigo del fecha_fin-->
                    <div class="mb-3" hidden id="select_fecha_fin">
                        <label for="fecha_fin" class="col-form-label">Fecha final</label>
                        <div>
                            <input name="fecha_fin" type="date" class="form-control" id="fecha_fin">
                        </div>
                    </div>
                    <!--aqui termina el codigo del fecha_fin-->
                </li>
                <li class="list-group-item">
                    <!--aqui empieza el codigo del boton guardar-->
                    <div class="mb-0">
                        <div>
                            <button type="button" class="btn btn-success" id="mostrar">
                                Mostrar
                            </button>
                        </div>
                    </div>
                    <!--aqui termina el codigo del boton guardar-->
                </li>
            </ul>

            <div class="table-responsive">
                <table class="table caption-top" id="table_asistencias">
                    <thead>
                        <tr>
                            <th scope="col">Empleado</th>
                            <th scope="col">Fecha Entrada</th>
                            <th scope="col">Fecha Salida</th>
                            <th scope="col">Retrasos</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop



@section('css')
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/r-2.3.0/datatables.min.css" />
@stop

@section('js')
    <script>
        function onChangeSelect() {
            let rangoFecha = document.getElementById("rango_fecha").value;
            if (rangoFecha == "personalizado") {
                document.getElementById("select_fecha_inicio").hidden = false;
                document.getElementById("select_fecha_fin").hidden = false;
            } else {
                document.getElementById("select_fecha_inicio").hidden = true;
                document.getElementById("select_fecha_fin").hidden = true;
            }

        }



        function onChangeSelectTurno() {
            let turnoID = document.getElementById("turno_id").value;
            let selectobject = document.getElementById('usuario');
            var options = document.querySelectorAll('#usuario option');

            options.forEach(o => o.remove());

            $.get(`{{ url('asistencia/user_turno/${turnoID}') }}`, function(data, status) {
                let option = document.createElement("option");
                option.text = 'todos';
                option.value = '0';
                selectobject.add(option);
                data.forEach(usuario => {
                    option = document.createElement("option");
                    option.text = usuario.name;
                    option.value = usuario.id;
                    selectobject.add(option);
                });
            });
        }
    </script>
    <script>
        $(document).ready(function() {
            onChangeSelectTurno();
            $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, {
                className: 'btn btn-sm'
            })

            function padTo2Digits(num) {
                return num.toString().padStart(2, '0');
            }

            function formatDate(date = new Date()) {
                let fecha = [
                    date.getFullYear(),
                    padTo2Digits(date.getMonth() + 1),
                    padTo2Digits(date.getDate()),
                ].join('-');

                return fecha;
            }


            function getRangoFecha(opcionSeleccionada) {
                let rangoDeFecha;
                let date = new Date();
                let fechaInicial;
                let fechaFinal = formatDate();
                let hora = [date.getHours(), date.getMinutes(), date.getSeconds()].join(':');
                fechaFinal = fechaFinal + ' ' + hora;
                switch (opcionSeleccionada) {
                    case 'hoy':
                        fechaInicial = formatDate();
                        break;
                    case 'semana':
                        let diaDeSemana = date.getDay();
                        let diaDeMes = date.getDate();
                        let fechaInicioDeSemana = (diaDeMes - diaDeSemana) + 1;
                        fechaInicial = [
                            date.getFullYear(),
                            padTo2Digits(date.getMonth() + 1),
                            padTo2Digits(fechaInicioDeSemana),
                        ].join('-');
                        break;
                    case 'mes':
                        fechaInicial = [
                            date.getFullYear(),
                            padTo2Digits(date.getMonth() + 1),
                            '01'
                        ].join('-');
                        break;
                    case 'personalizado':
                        fechaInicial = document.getElementById("fecha_inicio").value;
                        fechaFinal = document.getElementById("fecha_fin").value + ' ' + hora;
                        break;
                    default:
                        break;
                }
                rangoDeFecha = {
                    fechaInicial,
                    fechaFinal
                };
                return rangoDeFecha;
            }

            document.getElementById("fecha_inicio").value = formatDate();
            document.getElementById("fecha_fin").value = formatDate();



            var token = '{{ csrf_token() }}';
            var turnoId = document.getElementById("turno_id").value;
            var usuario = document.getElementById("usuario").value;
            var fechaInicio = document.getElementById("fecha_inicio").value;
            var fechaFin = document.getElementById("fecha_fin").value;
            var rango_fecha = document.getElementById("rango_fecha").value;

            var table = $('#table_asistencias').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: "{{ url('asistencia') }}",

                    data: function(d) {

                        token = '{{ csrf_token() }}';
                        turnoId = document.getElementById("turno_id").value;
                        usuario = document.getElementById("usuario").value;
                        rango_fecha = document.getElementById("rango_fecha").value;
                        let rangoFecha = getRangoFecha(rango_fecha);

                        fechaInicio = rangoFecha.fechaInicial;
                        fechaFin = rangoFecha.fechaFinal;

                        if (usuario == "") {
                            usuario = "0"
                        }

                        d.turno_id = turnoId;
                        d.fecha_inicio = fechaInicio;
                        d.fecha_fin = fechaFin;
                        d._token = token;
                        d.usuario = usuario;
                        
                    },     
                },

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
                        data: 'nombre',
                        name: 'nombre',
                    },
                    {
                        data: 'fechaentrada',
                        name: 'fechaentrada',

                        render: function(fechaentrada, type, row) {
                            if (fechaentrada == '1970-01-01 00:00:00')
                                return '----';
                            else
                                return fechaentrada;
                        }
                    },
                    {
                        data: 'fechasalida',
                        name: 'fechasalida',
                        render: function(fechasalida, type, row) {
                            if (fechasalida == '1970-01-01 00:00:00' || fechasalida == null)
                                return '----';
                            else
                                return fechasalida;
                        }
                    },
                    {
                        data: 'tiempo_atraso',
                        name: 'tiempo_atraso',
                        render: function(tiempo_atraso, type, row) {
                            if (tiempo_atraso.includes("-"))
                                return '00:00:00'
                            else
                                return tiempo_atraso;
                        }
                    },
                ],

                /*  initComplete: function() {
                      this.api()
                          .columns([0])
                          .every(function() {
                              let column = this;
                              let select = $('<select><option value="todos"> todos </option></select>')
                                  .appendTo($(column.footer()).empty())
                                  .on('change', function() {
                                      let val = $.fn.dataTable.util.escapeRegex($(this).val());

                                      column.search(val ? '^' + val + '$' : '', true, false)
                                      .draw();
                                  });

                              column
                                  .data()
                                  .unique()
                                  .sort()
                                  .each(function(d, j) {
                                      select.append('<option value="' + d + '">' + d +
                                          '</option>');
                                  });
                          });
                  }, */


            })

            $("#mostrar").click(function(e) {
                table.ajax.reload();
            });

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
