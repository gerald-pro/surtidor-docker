<form action="{{ route('clientes.store') }}" method="post">
    @csrf
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input name="nombre" type="text"
                    class="form-control my-colorpicker1" value="{{ old('nombre') }}"
                    required>

                @error('nombre')
                    <small class="text-danger">*{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="apellido">Apellido</label>
                <input name="apellido" type="text"
                    class="form-control my-colorpicker1"
                    value="{{ old('apellido') }}" required>

                @error('apellido')
                    <small class="text-danger">*{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="ci">Carnet de identidad</label>
                <input name="ci" type="text"
                    class="form-control my-colorpicker1" value="{{ old('ci') }}"
                    required>

                @error('ci')
                    <small class="text-danger">*{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="telefono">Telefono</label>
                <input name="telefono" type="number"
                    class="form-control my-colorpicker1"
                    value="{{ old('telefono', null) }}">

                @error('telefono')
                    <small class="text-danger">*{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="puntos">Puntos acumulados</label>
                <input name="puntos" type="number" min="0"
                    class="form-control my-colorpicker1"
                    value="{{ old('puntos', 0) }}">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="estado">Estado</label>
                <select name="estado" class="form-control select2"
                    style="width: 100%;">
                    <option value="1" selected="selected">Activo
                    </option>
                    <option value="0">Inactivo
                    </option>
                </select>
            </div>
        </div>
    </div>
    <hr>
    <div class="d-flex flex-row-reverse">
        <button type="submit" class="btn btn-info">Guardar</button>
        <a type="button" class="btn btn-danger mx-2"
            href="{{ route('clientes.index') }}">Cancelar</a>
    </div>
</form>