@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')
    <section class="content">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-md-6">
                    @include('modulo_ventas.nota_venta_combustible.partials.grafica_monto_total')
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Usuarios activos</div>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-sm">
                                <tbody>
                                    @foreach ($users_activos as $user)
                                        <tr>
                                            <td class="align-middle mx-auto"><i
                                                    class="fas fa-circle text-sm text-green my-auto mx-auto"></i></td>
                                            <td>{{ $user->name }}<p class="text-secondary my-auto">
                                                    {{ $user->role_name() }}</p>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Niveles de combustible</div>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool m-n2" id="export_chart_nivel_combustibles">
                                    <i class="fas fa-file-download fa-lg"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-1">
                            <div class="container">
                                <canvas id="chart_nivel_combustibles"></canvas>
                            </div>

                        </div>
                    </div>
                    @include('modulo_ventas.nota_venta_producto.partials.grafica_monto_promedio')
                </div>
            </div>
        </div>
        {{-- <form action="{{ route('fetch.ventas_combustibles.ventas_promedio.dia') }}" method="post">
            @csrf
            <div class="form-group">
                <label for=""></label>
                <select class="form-control form-control-sm" id="rango" name="rango">
                     @foreach ($meses as $mes)
                        <option value="{{$mes['fecha']}}" {{$mes['fecha']->format('m') == today()->format('m') ? 'selected' : ''}}>{{$mes['nombre']}}</option>
                    @endforeach
                    <option value="3">3 meses</option>
                    <option value="6">6 meses</option>
                    <option value="12">12 meses</option>
                </select>
                <button type="submit">link</button>
            </div>
        </form> --}}
    </section>
@stop

@section('footer')
    <footer>
        <div class="container text-sm">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <!--Column1-->
                    <div class="footer-pad">
                        <h6 class="text-light font-weight-light">Acerca de nosotros</h6>
                        <ul class="list-unstyled">
                            <li><a href="#"></a></li>

                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <!--Column2-->
                    <div class="footer-pad">
                        <h6 class="text-light font-weight-light">Documentcaión</h6>
                        <ul class="list-unstyled">
                            <li><a href="#">Website Tutorial</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <!--Column3-->
                    <div class="footer-pad">
                        <h6 class="text-light font-weight-light">Heading 3</h6>
                        <ul class="list-unstyled">
                            <li><a href="#">Parks and Recreation</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <h6 class="text-light font-weight-light">Descarga la app</h6>
                    <a href="#" class="text-sm text-secondary"><i class="fab fa-fw fa-android"></i> Android</a>
                    <br>
                    <a href="#" class="text-sm text-secondary"><i class="fab fa-fw fa-apple"></i> IOS</a>
                </div>
            </div>
            <hr class="bg-gray-dark">
            <div class="row">
                <div class="col-md-12">
                    <p class="text-center my-auto">&copy; Copyright 2022 - SOFTIDOR. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>
@stop

@section('plugins.Chartjs', true)

@section('css')
    <style>
        .main-footer {
            background-color: rgb(31, 38, 43) !important
        }
    </style>
@stop


@section('js')
    @include('modulo_ventas.nota_venta_combustible.scripts.script_monto_total')
    @include('modulo_ventas.nota_venta_producto.scripts.script_monto_promedio')
    <script>
        var combustibles = [];
        var cantidades = [];
        var opacidad = 0.6;

        var data = {
            labels: combustibles,
            datasets: [{
                label: 'My First dataset',
                fill: false,
                backgroundColor: [
                    `rgb(255, 99, 132, ${opacidad})`,
                    `rgb(75, 192, 192, ${opacidad})`,
                    `rgb(255, 205, 86, ${opacidad})`,
                    `rgb(201, 203, 207, ${opacidad})`,
                    `rgb(54, 162, 235, ${opacidad})`,
                    `rgb(255, 99, 132, ${opacidad})`,
                ],
                data: cantidades,
            }]
        };

        var config = {
            type: 'polarArea',
            data: data,
            options: {
                maintainAspectRatio: false
            }
        };

        var chartNivelCombustibles = new Chart(
            document.getElementById('chart_nivel_combustibles'),
            config
        );

        getDatos();

        function getDatos() {
            fetch('{{ route('fetch.combustibles.niveles') }}', {
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json, text-plain, */*",
                    },
                })
                .then(response => response.json())
                .then((json) => {
                    json.forEach(element => {
                        combustibles.push(element.tipo);
                        cantidades.push(parseInt(element.cantidad_disponible));
                    });

                    chartNivelCombustibles.data.labels = combustibles;
                    chartNivelCombustibles.data.datasets[0].data = cantidades;
                    chartNivelCombustibles.height = 300;
                    chartNivelCombustibles.update();
                    var image = chartNivelCombustibles.toBase64Image();
                });
        }

        $('#export_chart_nivel_combustibles').on('click', function(a) {
            var a = document.createElement('a');
            a.href = chartNivelCombustibles.toBase64Image();
            a.download = 'Gráfico - Monto promedio por venta.png';
            a.click();
        })
    </script>

    <script></script>
@stop
