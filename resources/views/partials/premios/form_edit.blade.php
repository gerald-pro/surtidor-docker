<form action="{{ route('premios.update', $premio) }}" method="post">
    @method('put')
    @csrf
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" class="form-control my-colorpicker1"
                    value="{{ old('nombre', $premio->nombre) }}" required>

                @error('nombre')
                    <small class="text-danger">*{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="puntos_requeridos">Puntos requeridos</label>
                <input name="puntos_requeridos" class="form-control my-colorpicker1" type="number"
                    value="{{ old('puntos_requeridos', $premio->puntos_requeridos) }}" step=".01" min="0"
                    required>

                @error('puntos_requeridos')
                    <small class="text-danger">*{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="stock">Stock</label>
                <input name="stock" class="form-control my-colorpicker1" value="{{ old('stock', $premio->stock) }}"
                    type="number" min="0" required>

                @error('stock')
                    <small class="text-danger">*{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label for="estado">Estado</label>
                <select name="estado" class="form-control select2" style="width: 100%;">
                    <option value="1" {{ $premio->estado ? 'selected' : '' }}>
                        Activo
                    </option>
                    <option value="0" {{ $premio->estado ? '' : 'selected' }}>
                        Cerrado
                    </option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="fecha_inicio">Fecha de inicio</label>
                <input name="fecha_inicio" type="datetime-local" class="form-control my-colorpicker1"
                    value="{{ old('fecha_inicio', $premio->fecha_inicio) }}">

                @error('fecha_inicio')
                    <small class="text-danger">*{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="fecha_fin">Finalización</label>
                <input name="fecha_fin" type="datetime-local" class="form-control"
                    value="{{ old('fecha_fin', is_null($premio->fecha_fin) ? null : $premio->fecha_fin) }}">

            </div>
        </div>
        <div class="col-md-6">
            <label for="unidades_producto">Producto</label>
            <div class="input-group">
                <select name="producto_id" id="producto_id" class="form-control select2" style="width: 50%">
                    <option value="{{ null }}" {{ is_null($premio->producto_id) ? 'selected' : '' }}>Sin
                        producto
                    </option>

                    @foreach ($productos as $producto)
                        <option value="{{ $producto->id }}"
                            {{ $producto->id == $premio->producto_id ? 'selected' : '' }}>
                            {{ $producto->nombre }}
                        </option>
                    @endforeach
                </select>
                <div class="input-group-prepend">
                    <span class="input-group-text" id="">uds.</span>
                </div>
                <input name="unidades_producto" id="unidades_producto" class="form-control my-colorpicker1"
                    value="{{ old('unidades_producto', $premio->unidades_producto) }}" type="number" min="1">
            </div>
            @error('unidades_producto')
                <small class="text-danger">*{{ $message }}</small>
            @enderror
        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea name="descripcion" class="form-control my-colorpicker1">{{ old('descripcion', $premio->descripcion) }}</textarea>

                @error('descripcion')
                    <small class="text-danger">*{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-end">
        <div class="d-flex">
            <a type="button" class="btn btn-secondary mr-2" href="{{ route('premios.show', $premio) }}">
                Cancelar
            </a>
            <button type="submit" class="btn bg-purple">Guardar</a>
        </div>
    </div>
</form>
