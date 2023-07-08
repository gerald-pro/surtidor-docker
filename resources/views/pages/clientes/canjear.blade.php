@extends('adminlte::page')

@section('title', 'Clientes')

@section('content')
    <section class="content">
        <div class="container-fluid p-4">
            <div class="card card-cyan card-outline">
                <div class="card-header">
                    <div class="row justify-content-between">
                        <div class="col-xs-4 my-auto">
                            <h4 class="my-auto ">
                                <strong>{{ $cliente->nombre . ' ' . $cliente->apellido }}</strong>
                            </h4>
                            <p class="my-auto text-muted">
                                Cliente
                            </p>
                        </div>
                        <div class="col-xs-2 text-right">
                            <span class="fa fa-address-card fa-4x"></span>
                        </div>
                    </div>
                </div>

                <div class="card-footer text-muted text-sm">
                    <div class="d-flex justify-content-between my-n2">
                        <p class="my-auto"><small>Registrado: {{ $cliente->created_at }}</small></p>
                        <p class="my-auto"><small>Ultima modificación: {{ ' ' . $cliente->updated_at . '  ' }}</small></p>
                    </div>
                </div>

            </div>

            <div class="card card-purple card-tabs">
                <div class="card-header p-0 pt-1">
                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill"
                                href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home"
                                aria-selected="true">Canjear puntos</a>
                        </li>
                    </ul>
                </div>

                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-one-tabContent">
                        <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel"
                            aria-labelledby="custom-tabs-one-home-tab">
                            <form action="{{ route('clientes.canjear', $cliente) }}" method="POST">
                                @method('PATCH')
                                @csrf
                                <div class="row mb-2 justify-content-center">
                                    <div class="col-md-4 ">
                                        <div class="form-group @error('premio_id') is-invalid @enderror" id="input_premio">
                                            <label for="premio_id">Premio</label>
                                            <select name="premio_id" id="premio_id"
                                                class="form-control select2 @error('premio_id') is-invalid @enderror"
                                                style="width: 100%;" required>
                                                <option value={{ null }}>-- seleccionar premio --</option>

                                                @foreach ($premios as $premio)
                                                    <option value="{{ $premio->id }}">
                                                        {{ $premio->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('premio_id')
                                            <div id="validacionPremio" class="invalid-feedback">*{{ $message }}
                                            </div>
                                        @enderror
                                        <div id="validacionPremio" class="invalid-feedback"></div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="stock">Stock</label>
                                            <p type="number" class="form-control my-colorpicker1" id="stock"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="cantidad">Cantidad</label>
                                            <input type="number" class="form-control my-colorpicker1" id="cantidad"
                                                name="cantidad" min="1" value="{{ old('cantidad', 1) }}">
                                        </div>
                                        @error('cantidad')
                                            <div class="invalid-feedback">*{{ $message }}
                                            </div>
                                        @enderror
                                        <div id="validacionCantidad" class="text-danger text-sm">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Puntos requeridos</label>
                                            <p class="form-control my-colorpicker1" id="puntos_requeridos">
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <label>Puntos del cliente</label>
                                            <p class="form-control my-colorpicker1" id="puntos_acumulados">
                                                {{ $cliente->puntos }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2 justify-content-center">
                                    <div class="col-sm-4">

                                    </div>
                                </div>


                                <div class="d-flex flex-row-reverse">
                                    <button type="submit" class="btn btn-info" id="canjear_button">Canjear</button>
                                    <a type="button" class="btn btn-danger mx-2"
                                        href="{{ route('clientes.show', $cliente) }}">Cancelar</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
    </section>
@stop


@section('js')
    <script>
        $(document).ready(function() {
            $('#premio_id').on('change', function() {
                actualizar();
            })

            $('#cantidad').on('change', function() {
                actualizar();
            })

            function actualizar() {
                var premio_id = parseInt($('#premio_id').val());

                if (premio_id) {
                    var premios = {!! json_encode($premios->toArray(), JSON_HEX_TAG) !!};
                    var premio = $.grep(premios, function(e) {
                        return e.id == premio_id;
                    });

                    var puntos_requeridos_total = parseInt(premio[0].puntos_requeridos) * parseInt($(
                        '#cantidad').val());
                    $('#puntos_requeridos').text(puntos_requeridos_total);
                    $('#stock').text(parseInt(premio[0].stock));

                    if (parseInt(premio[0].stock) < parseInt($('#cantidad').val())) {
                        $('#validacionCantidad').text('La cantidad a canjear supera el stock');
                        $("#cantidad").addClass("is-invalid");
                        $('#canjear_button').prop("disabled", true);
                    } else {
                        $('#validacionCantidad').text('');
                        $("#cantidad").removeClass("is-invalid");

                        if (puntos_requeridos_total > parseInt($('#puntos_acumulados').text())) {
                            $('#validacionPremio').text('Puntos del cliente insuficientes');
                            premioInvalid();
                        } else {
                            premioValid();
                        }
                    }

                } else {
                    $('#puntos_requeridos').text('');
                    $('#validacionPremio').text('');
                    $('#stock').text('')
                }

            }

            function premioInvalid() {
                $("#input_premio").addClass("is-invalid");
                $("#premio_id").addClass("is-invalid");
                $('#canjear_button').prop("disabled", true);
            }

            function premioValid() {
                $("#input_premio").removeClass("is-invalid");
                $("#premio_id").removeClass("is-invalid");
                $("#input_premio").addClass("is-valid");
                $("#premio_id").addClass("is-valid");
                $('#canjear_button').prop("disabled", false);
            }
        })
    </script>
@stop
