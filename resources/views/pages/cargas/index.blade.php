@extends('adminlte::page')

@section('content_header')
<div class="bg-purple p-5">
  <div class="d-flex justify-content-between">
      <h4 class="card-title">
          <strong>REPORTE DE CARGAS DE COMBUSTIBLES</strong>
      </h4>
  </div>
</div>
{{-- <h1>Notas de Compras de Combustibles</h1> --}}
@stop

@section('content')
<div class="d-grid gap-2">
    <a class="btn btn-success" href="{{ route('cargas.create') }}"> crear </a>
</div>
<ul class="list-group list-group-horizontal">
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
{{-- <nav class="navbar navbar-light bg-light float-right">
  <div class="container-fluid">
    <form class="d-flex">
      <input name="buscarpor" class ="form-control me-2" type="search" placeholder="Buscar" aria-label="Search">
      <button class="btn btn-outline-primary" type="submit">Buscar</button>
    </form>
  </div>
</nav> --}}


<div class="table-responsive">
    <table class="table">
        <table class="table caption-top" id= "tabla">
            <caption></caption>
            <thead>
              <tr>
                
                <th scope="col">ID</th>
                <th scope="col">Combustible</th>
                <th scope="col">Fecha</th>
                <th scope="col">Total</th>
                <th scope="col">Accion</th>

              </tr>
            </thead>
            <tbody>
                @foreach ($lista_nota_carga as $nota_carga)
                  <tr>
                    <th scope="row">{{$nota_carga->id}}</th> 
                    <td >{{$nota_carga->nombre}}</td>
                    <td>{{$nota_carga->fecha}}</td>
                    <td>{{$nota_carga->total}}</td>
              

                    <td>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            
                          <a style="text-align: right" href="{{ url('cargas/show/'. $nota_carga->id) }}"
                            class="btn btn-warning">
                            <i class="fa fa-eye"></i>
                          </a>

                         </div>
                    </td>
                  </tr>  
                @endforeach  
            </tbody>
          </table>
    </table>

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

    </script>
    <script>
        $(document).ready(function() {
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
            var combustibleId = document.getElementById("combustible_id").value;
            var combustibleNombre = document.getElementById("combustible_nombre").value;
            var fechaInicio = document.getElementById("fecha_inicio").value;
            var fechaFin = document.getElementById("fecha_fin").value;
            var combustibleTipo = document.getElementById("combustible_tipo").value;
            var rango_fecha = document.getElementById("rango_fecha").value;

            var table = $('#tabla').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: "{{ url('cargas') }}",

                    data: function(d) {

                        token = '{{ csrf_token() }}';
                        combustibleId = document.getElementById("combustible_id").value;
                        combustibleNombre = document.getElementById("combustible_nombre").value;
                        combustibleTipo = document.getElementById("combustible_tipo").value;
                        rango_fecha = document.getElementById("rango_fecha").value;
                        let rangoFecha = getRangoFecha(rango_fecha);

                        fechaInicio = rangoFecha.fechaInicial;
                        fechaFin = rangoFecha.fechaFinal;

                        if (combustibleNombre == "") {
                          combustibleNombre = "0"
                        }

                        d.combustible_id = combustibleId;
                        d.combustible_nombre = combustibleNombre;
                        d.fecha_inicio = fechaInicio;
                        d.fecha_fin = fechaFin;
                        d._token = token;
                        d.combustible_tipo = combustibleTipo;
                        
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
                    
                ],



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

