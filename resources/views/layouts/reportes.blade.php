@extends('adminlte::page')


@section('content')

    <section class="content">
        <div class="container-fluid pt-4">
            <div class="card">
                <div class="card-header my-auto p-0">
                    <div class="row justify-content-between py-2">
                        <div class="col-sm-5 my-auto px-4">
                            <h3 class="card-title">
                                <strong>@yield('table-title')</strong>
                            </h3>
                        </div>
                        <div class="d-flex px-4" id="botones"></div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="d-flex justify-content-end p-3 mb-n2" id="topRowTable">
                        @yield('filters')
                    </div>
                    <table class="table table-sm table-hover table-head-fixed" id="table" width="100%">
                        <thead class="table-light">
                            <tr>
                                @yield('table-tr')
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
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
            width: 130px;
        }

        div.dt-button-collection .dt-button {
            min-width: 90px;
        }
    </style>

    @yield('datatable-css')
@stop

@section('js')
    @yield('datatable-js')

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/r-2.3.0/datatables.min.js">
    </script>
@stop
