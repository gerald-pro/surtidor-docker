<form action="{{ route('clientes.vehiculos.store', $cliente) }}" method="post">
    @csrf
    <div class="row">
        <div class="col-sm-3">
            <label>Placa</label>
            <input name="placa" class="form-control my-colorpicker1" value="{{ old('placa') }}" style="text-transform:uppercase" required>

            @error('placa')
                <small class="text-danger">*{{ $message }}</small>
            @enderror
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label>Tipo</label>
                <select name="tipo" class="form-control select2" style="width: 100%;" required>
                    <option value="{{ null }}" selected>--Seleccionar--</option>
                    <option value="automovil">Automovil</option>
                    <option value="camioneta">Camioneta</option>
                    <option value="minibus">Minibus</option>
                    <option value="bus">Bus</option>
                    <option value="camion">Camión</option>
                </select>
                @error('tipo')
                    <small class="text-danger">*{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label>Marca</label>
                <input name="marca" class="form-control my-colorpicker1" value="{{ old('marca') }}">

                @error('marca')
                    <small class="text-danger">*{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label for="b_sisa">B-SISA</label>
                <select name="b_sisa" class="form-control select2" style="width: 100%;">
                    <option value="1" selected>Hábil</option>
                    <option value="0">Inhábil</option>
                </select>
                @error('b_sisa')
                    <small class="text-danger">*{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end">
        <a type="button" class="btn btn-danger mr-2" href="{{ route('premios.index') }}">Cancelar</a>
        <button type="submit" class="btn btn-info">Guardar</a>
    </div>
</form>
