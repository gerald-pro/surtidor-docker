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