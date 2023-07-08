@extends('layouts/master')


@section('title', 'Registrar Carga')

@section('content')
    <section class="content">
        <div class="container-fluid p-4">
            <div class="card">
                <div class="card-header my-auto p-0">
                    <div class="row justify-content-between my-auto  px-3 py-2">
                        <div class="col my-auto">
                            <h5 class="card-title"><strong>CARGA DE COMBUSTIBLE</strong></h5><br>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="combustible">Combustible </label>
                            <select class="form-control" id="combustible" name="combustible" onchange="onChangeSelect()">
                                <option value="0">-- Seleccionar --</option>
                                @foreach ($combustibles as $combustible)
                                    <option value="{{ $combustible->id }}">{{ $combustible->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-sm-2">
                            <label for="cantidad_total">Cantidad total</label>
                            <div class="input-group">
                                <input id="cantidad_total" name="cantidad_total" class="form-control bg-white"
                                    value="{{ old('cantidad_total') }}" readonly>
                                <div class="input-group-append">
                                    <span class="input-group-text">Lts</span>
                                </div>
                            </div>
                            @error('cantidad_total')
                                <small class="text-danger">*{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-sm-2">
                            <label for="precio_unitario">Precio de compra</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Bs</span>
                                </div>
                                <input type="number" name="precio_unitario" id="precio_unitario" step=".01"
                                    value="{{ $combustible->precio_compra }}" class="form-control total">
                            </div>
                        </div>

                        <div class="form-group col-sm-2">
                            <label for="precio_total">Monto Total</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Bs</span>
                                </div>
                                <input name="precio_total" id="precio_total" class="form-control bg-white" type="number"
                                    value="{{ old('precio_total') }}" step=".01" min="0" readonly>
                            </div>
                            @error('precio_total')
                                <small class="text-danger">*{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <hr class="my-2">

                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="tanque_codigo">Tanque:</label>
                            <select name="tanque_codigo" id="tanque_codigo" class="form-control">
                                {{--  <option value="0">-- Seleccionar --</option> --}}
                            </select>
                        </div>
                        <div class="form-group col-sm-2">
                            <label for="cantidad_tanque">Cantidad</label>
                            <div class="input-group">
                                <input id="cantidad_tanque" name="cantidad_tanque" class="form-control" type="number"
                                    step=".01" min="0" value="{{ old('cantidad_tanque') }}">

                                <div class="input-group-append">
                                    <span class="input-group-text">Lts</span>
                                </div>
                            </div>
                            @error('cantidad_tanque')
                                <small class="text-danger">*{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-sm my-auto">
                            <button type="button" class="btn btn-info mt-3" id="addRow">Cargar </button>
                        </div>
                    </div>

                    <table id="example" class="table table-sm table-hover table-bordered" id="example" width="100%">
                        <thead>
                            <tr>
                                <th>TANQUE</th>
                                <th>CANTIDAD</th>
                                <th>PRECIO</th>
                                <th>SUBTOTAL</th>
                                <th>ACCION</th>
                            </tr>
                        </thead>
                    </table>
                    <div class="row">
                        <div class="col-sm ">
                            <div class="d-flex justify-content-end">
                                <a href="{{ url('cargas/index') }}" class="btn btn-secondary mr-2">
                                    Atras
                                </a>
                                <button class="btn btn-success" id="guardar" name="guardar">Guardar</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
    </section>
@stop

@section('css')
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/r-2.3.0/datatables.min.css" />
@stop
@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/r-2.3.0/datatables.min.js">
    </script>

    <script>
        $(document).ready(function() {
            var tanqueList = [];
            var total = 0;
            var cantidad_total = 0.0;
            var t = $('#example').DataTable({
                responsive: true,
                dom: '<"pt-1 pb-4"rt>',
                columnDefs: [{
                    targets: -1,
                    data: null,
                    defaultContent: '<button type="button" class="btn btn-sm btn-outline-danger" id="delete"><i class="fas fa-times"></i></button>',
                }, ],
            });

            $('#addRow').on('click', function() {

                if ($('#cantidad_tanque').val() != 0 && $('#tanque_codigo').children('option').length !=
                    0) {
                    let tanque_codigo = $("#tanque_codigo option:selected").text();
                    let cantidad_tanque = document.getElementById("cantidad_tanque").value;
                    let precio = document.getElementById("precio_unitario").value;;

                    t.row.add([tanque_codigo, cantidad_tanque, precio, cantidad_tanque * precio]).draw(
                        false);
                    tanqueList.push({
                        "tanque_codigo": tanque_codigo,
                        "cantidad_tanque": cantidad_tanque,
                        "precio": precio
                    });
                    total = total + cantidad_tanque * precio;

                    $('#combustible').attr("disabled", true)
                    $('#cantidad_total').val("disabled", true)

                    updateCantidadTotal();
                }

            });

            function updateCantidadTotal() {
                cantidad_total = 0;

                tanqueList.forEach((element) => {
                    cantidad_total = cantidad_total + parseFloat(element.cantidad_tanque)
                });
                $('#cantidad_tanque').val("")
                $('#cantidad_total').val(cantidad_total)
                $('#precio_total').val($('#cantidad_total').val() * $('#precio_unitario').val())
            }

            function cleanInputs() {
                $('#cantidad_total').val("")
                $('#precio_total').val("")
            }


            $('#example tbody').on('click', 'button', function() {
                let data_fila = t.row($(this).parents('tr')).data();
                console.log(data_fila)
                total = total - data_fila[2] * data_fila[3];
                t.row(($(this).parents('tr'))).remove().draw();
                tanqueList = tanqueList.filter(data => data.tanque_codigo != data_fila[0]);

                if (tanqueList.length === 0) {
                    $('#combustible').attr("disabled", false)
                }
                updateCantidadTotal()
            });

            $("#guardar").click(function(e) {
                var token = '{{ csrf_token() }}';
                let combustible = document.getElementById("combustible").value;
                var data = {
                    combustible_id: combustible,
                    _token: token,
                    tanque_list: tanqueList,
                    total: total,
                };

                $.ajax({
                    type: "post",
                    url: "{{ route('cargas.store') }}",
                    data: data,
                    beforeSend: function() {
                        $('#guardar').html(
                            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
                        )
                    },

                    success: function(cargas_id) {
                        window.location.href =
                            `{{ url('/cargas/show/${cargas_id}/') }}`;
                    }
                });
            });

            $('#combustible').on('change', function() {
                var tanques = {!! json_encode($tanques->toArray(), JSON_HEX_TAG) !!};

                $("#tanque_codigo").empty();
                tanques.forEach((element) => {
                    if (element.combustible_id == $(this).val()) {
                        $('#tanque_codigo').append(new Option(element.codigo, element.id));
                    }
                });

            })

        });
    </script>

    <script>
        function onChangeSelect() {
            $('#combustibles').on('change', function() {
                var precio_compra = $("option:selected", this).data('precio_compra');
                $('#precio_compra').val(precio_compra);

            });

        };
    </script>
@stop
