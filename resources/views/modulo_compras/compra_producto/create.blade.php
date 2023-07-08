@extends('adminlte::page')

@section('content_header')
    <h1>Registrar Compra </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <!--aqui empieza el codigo del select proveedor-->
            <div class="row mb-3">
                <label for="proveedor_id" class="col-md-2 col-form-label ">Seleccione un proveedor </label>
                <div class="col-md-10">
                    <select class="form-control" id="proveedor_id" name="proveedor_id">
                        @foreach ($lista_proveedores as $proveedor)
                            <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!--aqui termina el codigo del select proveedor-->
            <!--aqui empieza el codigo del select producto-->
            <div class="row mb-3">
                <label for="producto_id" class="col-md-2 col-form-label ">Seleccione un producto </label>
                <div class="col-md-10">
                    <select class="form-control" id="producto_id" name="producto_id">
                        @foreach ($lista_productos as $producto)
                            <option value="{{ '' . $producto->id . '`' . $producto->nombre }}">{{ $producto->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!--aqui termina el codigo del select producto-->
            <!--inicio campo cantidad-->
            <div class="mb-3">
                <label for="cantidad" class="form-label">cantidad</label>
                <input name="cantidad" type="number" class="form-control" id="cantidad" placeholder="introduzca cantidad"
                    required>
            </div>
            <!--fin campo cantidad-->
            <!--inicio campo precio_compra-->
            <div class="mb-3">
                <label for="precio_compra" class="form-label">precio de compra</label>
                <input name="precio_compra" type="number" class="form-control" id="precio_compra"
                    placeholder="introduzca el precio de compra" required>
            </div>
            <!--fin campo precio_compra-->
            <!------------------inicio tabla dinamica-------------------->
            <button type="button" id="addRow">Agregar producto</button>
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>nombre</th>
                        <th>cantidad</th>
                        <th>precio de compra</th>
                        <th>subtotal</th>
                        <th>accion</th>
                    </tr>
                </thead>
            </table>
            <!-------------------fin tabla dinamica----------------------->
            <!--aqui empieza el codigo del boton guardar-->
            <div class="row mb-0">
                <div class="col-md-10 offset-md-2">
                    <button class="btn btn-success" id="guardar">Agregar</button>
                    <a href="{{ url('nota_producto') }}" class="btn btn-secondary">
                        Atras
                    </a>
                </div>

            </div>
            <!--aqui termina el codigo del boton guardar-->
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/r-2.3.0/datatables.min.css" />
@stop
@section('js')
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/r-2.3.0/datatables.min.js">
    </script>
    <script>
        //-------------------------------------------------------------------------------------------------------------------------
        $(document).ready(function() {
            var productoList = [];
            var total = 0;
            var t = $('#example').DataTable({
                columnDefs: [{
                    targets: -1,
                    data: null,
                    defaultContent: '<button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>',
                }, ],
            });

            //-------------------------------------------------------------------------------------------------------------------------

            $('#addRow').on('click', function() {
            let producto_value = document.getElementById("producto_id").value.split('`');
            let cantidad = document.getElementById("cantidad").value;
            let producto_id = producto_value[0];
            let producto = producto_value[1];
            let precio = document.getElementById("precio_compra").value;;
            t.row.add([producto_id, producto, cantidad, precio, cantidad * precio]).draw(false);
            productoList.push({
                "producto_id": producto_id,
                "cantidad": cantidad,
                "precio": precio
            });
            total = total + cantidad * precio;
        });

        //-------------------------------------------------------------------------------------------------------------------------

        $('#example tbody').on('click', 'button', function() {
            let data_fila = t.row($(this).parents('tr')).data();
            total = total - data_fila[2] * data_fila[3];
            t.row($(this).parents('tr')).remove().draw();
            productoList = productoList.filter(data => data.producto_id != data_fila[0]);
        });

        //-------------------------------------------------------------------------------------------------------------------------

        $("#guardar").click(function(e) {
            var token = '{{ csrf_token() }}';
            let proveedorId = document.getElementById("proveedor_id").value;
            var data = {
                proveedor_id: proveedorId,
                _token: token,
                producto_list: productoList,
                total: total
            };
        
            $.ajax({
                type: "post",
                url: "{{ route('nota_producto.store') }}",
                data: data,
                success: function(nota_producto_id) {
                    window.location.href =
                        `{{ url('/detalle_producto/${nota_producto_id}/') }}`;
                    }
                });
            });
        });

        //-------------------------------------------------------------------------------------------------------------------------        
    </script>
@stop
