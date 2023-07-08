<form action="{{ route('premios.store') }}" method="post">
    @csrf
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" class="form-control my-colorpicker1" value="{{ old('nombre') }}"
                    required>

                @error('nombre')
                    <small class="text-danger">*{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="puntos_requeridos">Puntos requeridos</label>
                <input name="puntos_requeridos" class="form-control my-colorpicker1" type="number"
                    value="{{ old('puntos_requeridos') }}" min="0" required>

                @error('puntos_requeridos')
                    <small class="text-danger">*{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="stock">Stock</label>
                <input name="stock" class="form-control my-colorpicker1" value="{{ old('stock') }}" type="number"
                    min="0" required>

                @error('stock')
                    <small class="text-danger">*{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="estado">Estado</label>
                <select name="estado" class="form-control select2" style="width: 100%;">
                    <option value="1" selected>Activo
                    </option>
                    <option value="0">
                        Inactivo
                    </option>
                </select>
                @error('estado')
                    <small class="text-danger">*{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="fecha_inicio">Fecha de inicio</label>
                <input name="fecha_inicio" type="datetime-local" class="form-control my-colorpicker1"
                    value="{{ old('fecha_inicio', \Carbon\Carbon::today()) }}">

                @error('fecha_inicio')
                    <small class="text-danger">*{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="fecha_fin">Finalización</label>
                <input name="fecha_fin" type="datetime-local" class="form-control" value="{{ old('fecha_fin') }}">
                @error('fecha_fin')
                    <small class="text-danger">*{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <label for="producto_id">Producto</label>
            <div class="input-group">
                <select name="producto_id" id="producto_id" class="form-control select2" style="width: 50%">
                    <option value={{ null }}>Sin producto</option>

                    @foreach ($productos as $producto)
                        <option value="{{ $producto->id }}">
                            {{ $producto->nombre }}
                        </option>
                    @endforeach
                </select>
                <div class="input-group-prepend">
                    <span class="input-group-text" id="">uds.</span>
                </div>
                <input name="unidades" id="unidades" class="form-control my-colorpicker1"
                    value="{{ old('unidades') }}" type="number" min="1">
            </div>
            @error('unidades')
                <small class="text-danger">*{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea name="descripcion" class="form-control my-colorpicker1" style="height: auto">{{ old('descripcion') }}</textarea>

                @error('descripcion')
                    <small class="text-danger">*{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
    <hr>
    <div class="d-flex justify-content-end">
        <a type="button" class="btn btn-danger mr-2" href="{{ route('premios.index') }}">Cancelar</a>
        <button type="submit" class="btn btn-info">Guardar</a>
    </div>

</form>
