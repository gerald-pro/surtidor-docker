<div class="row mb-2">
    <div class="col-sm-4">
        <div class="form-group">
            <label>Nombre</label>
            <p type="text" class="form-control my-colorpicker1">
                {{ $cliente->nombre }}
            </p>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label>Apellido</label>
            <p type="text" class="form-control my-colorpicker1">
                {{ $cliente->apellido }}
            </p>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label>Carnet de identidad</label>
            <p type="text" class="form-control my-colorpicker1">{{ $cliente->ci }}
            </p>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label>Telefono</label>
            <p type="text" class="form-control my-colorpicker1">
                {{ $cliente->telefono }}
            </p>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label>Puntos acumulados</label>
            <p type="text" class="form-control my-colorpicker1">
                {{ $cliente->puntos }}
            </p>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label>Estado</label>
            <p type="text" class="form-control my-colorpicker1">
                {{ $cliente->estado ? 'Activo' : 'Inactivo' }}</p>
        </div>
    </div>
</div>