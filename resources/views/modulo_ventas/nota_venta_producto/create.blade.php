@extends('adminlte::page')

@section('content')
    <section class="content">
        <div class="container-fluid pt-4">
            <div class="card">
                <div class="card-header my-auto p-0">
                    <div class="row justify-content-between my-auto  px-3 py-2">
                        <div class="col my-auto">
                            <h5 class="card-title"><strong>VENTA DE PRODUCTOS</strong></h5><br>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="cliente_id">Cliente </label>
                            <select class="form-control select2" id="cliente_id" name="cliente_id" style="width: 100%;">
                                <option value="{{ null }}" selected>Predeterminado</option>
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">
                                        {{ $cliente->nombre . ' ' . $cliente->apellido }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="cliente_id">Vendedor</label>
                            <p name="user" class="form-control text-secondary" id="user">{{Auth::user()->name. ' ' . Auth::user()->apellido}}</p>
                        </div>
                    </div>

                    <hr>

                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="producto_id">Producto</label>
                            <select class="form-control select2" id="producto_id" name="producto_id" style="width: 100%;">
                                <option value="{{ null }}">Seleccionar</option>
                                @foreach ($productos as $producto)
                                    <option value="{{ $producto->id }}">
                                        {{ $producto->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="">Unidades</label>
                            <input name="cantidad" type="number" class="form-control" id="cantidad" min="1"
                                required>
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="">Precio unitario</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Bs</span>
                                </div>
                                <p name="precio_unitario" class="form-control text-secondary" id="precio_unitario"></p>
                            </div>
                        </div>
                        <div class="form-group col-xs my-auto">
                            <button type="button" id="addRow" class="btn btn-info mt-3 "><i class="fa fa-plus"
                                    aria-hidden="true"></i></button>
                        </div>

                    </div>

                    <hr class="my-4">

                    <table class="table table-sm table-hover table-bordered" id="example" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>PRODUCTO</th>
                                <th>UNIDADES</th>
                                <th>PRECIO UNIT.</th>
                                <th>SUBTOTAL</th>
                                <th>ACCION</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="row justify-content-end">
                        <div class="d-flex">
                            <a href="{{ url('nota_venta_producto') }}" class="btn btn-secondary mx-2">
                                Atras
                            </a>
                            <button class="btn btn-success" id="guardar">Confirmar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop

@section('plugins.Select2', true)

@section('css')
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/r-2.3.0/datatables.min.css" />
@stop
@section('js')
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/r-2.3.0/datatables.min.js">
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        //-------------------------------------------------------------------------------------------------------------------------
        $(document).ready(function() {
            var productoList = [];
            var total = 0;
            var producto_id;
            var producto;

            $('#producto_id').select2({
                placeholder: 'Seleccionar',
                dropdownAutoWidth: true,
            });
            $('#cliente_id').select2({
                placeholder: 'Seleccionar',
                dropdownAutoWidth: true,
            });

            $('#producto_id').on('change', function() {
                producto_id = $(this).val()

                if (producto_id) {
                    var productos = {!! json_encode($productos->toArray(), JSON_HEX_TAG) !!};
                    producto = $.grep(productos, function(e) {
                        return e.id == producto_id;
                    });
                    $('#precio_unitario').text(producto[0].precio_venta);
                }
            })

            var t = $('#example').DataTable({
                responsive: true,
                dom: '<"pt-1 pb-4"r<"d-flex justify-content-start"l>t>',
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json'
                },
                columnDefs: [{
                    targets: -1,
                    data: null,
                    defaultContent: '<button type="button" class="btn btn-sm btn-outline-danger" id="delete"><i class="fas fa-times"></i></button>',
                }, ],
            });

            //----agrega---------------------------------------------------------------------------------------------------------------------

            $('#addRow').on('click', function() {
                let producto_value = $("#producto_id").val();
                let cantidad = document.getElementById("cantidad").value;
                let precio = producto[0].precio_venta;
                let cantidad_disponible = producto[0].cantidad;
                let nombre_producto = producto[0].nombre;
                if (parseInt(cantidad) <= parseInt(cantidad_disponible)) {
                    t.row.add([producto_id, nombre_producto, cantidad, precio, cantidad * precio]).draw(
                        false);
                    productoList.push({
                        "producto_id": producto_id,
                        "cantidad": cantidad,
                    });
                    total = total + cantidad * precio;
                } else {

                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...existencias insuficientes',
                        text: nombre_producto + ' :' + ' solo disponible ' + cantidad_disponible +
                            ' unidades',
                    })

                }

            });

            //----elimina---------------------------------------------------------------------------------------------------------------------

            $('#example tbody').on('click', 'button', function() {
                let data_fila = t.row($(this).parents('tr')).data();
                total = total - data_fila[2] * data_fila[3];
                t.row($(this).parents('tr')).remove().draw();
                productoList = productoList.filter(data => data.producto_id != data_fila[0]);
                console.log(productoList)
            });

            //-------------------------------------------------------------------------------------------------------------------------

            $("#guardar").click(function(e) {
                var token = '{{ csrf_token() }}';
                let clienteId = document.getElementById("cliente_id").value;
                var data = {
                    cliente_id: clienteId,
                    _token: token,
                    producto_list: productoList,
                    total: total
                };
                $.ajax({
                    type: "post",
                    url: "{{ route('nota_venta_producto.store') }}",
                    data: data,
                    success: function(nota_venta_producto_id) {
                        window.location.href =
                            `{{ url('/detalle_nota_venta_producto/${nota_venta_producto_id}/') }}`;
                    }
                });
            });
        });

        //-------------------------------------------------------------------------------------------------------------------------        
    </script>
@stop
