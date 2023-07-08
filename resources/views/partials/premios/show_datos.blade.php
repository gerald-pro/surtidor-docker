<div class="row">
    <div class="col-md-3">
        <label>Nombre</label>
        <p class="form-control my-colorpicker1">{{ $premio->nombre }}</p>
    </div>
    <div class="col-md-3">
        <label>Puntos requeridos</label>
        <p class="form-control my-colorpicker1">{{ $premio->puntos_requeridos }}</p>
    </div>
    <div class="col-md-3">
        <label>Stock</label>
        <p class="form-control my-colorpicker1">{{ $premio->stock == 0 ? 'Agotado' : $premio->stock }}</p>
    </div>
    <div class="col-md-3">
        <label>Estado</label>
        <p class="form-control text-capitalize">{{ $premio->estado ? 'activo' : 'cerrado' }}</p>
    </div>

</div>
<div class="row">
    <div class="col-md-3">
        <label>Fecha de inicio</label>
        <p name="descripcion" class="border rounded p-2">
            {{ \Carbon\Carbon::parse($premio->fecha_inicio)->format('d-m-Y H:i') }}
        </p>
    </div>
    <div class="col-md-3">
        <label>Finalización</label>
        <p class="border rounded p-2">
            {{ is_null($premio->fecha_fin) ? 'Indefinido' : \Carbon\Carbon::parse($premio->fecha_fin)->format('d-m-Y H:i') }}
        </p>
    </div>

    <div class="col-md-6">
        <label>Producto</label>
        <div class="input-group">
            @if ($premio->producto_id)
                <a class="form-control" href="{{route('producto.show', $premio->producto_id)}}" style="width: 50%">
                     {{ $premio->producto->nombre }}
                </a>
            @else
            <p class="form-control" style="width: 50%">Sin producto</p>
            @endif

            <div class="input-group-prepend">
                <span class="input-group-text" id="">uds.</span>
            </div>
            <p class="form-control">{{ $premio->unidades_producto }}</p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <label>Descripción</label>
        <p name="descripcion" class="border rounded p-2">
            {{ $premio->descripcion }}
        </p>
    </div>
</div>
