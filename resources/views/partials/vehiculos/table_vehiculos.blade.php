<table class="table table-sm table-hover table-head-fixed" id="table_vehiculos" width="100%">
    <thead class="table-light">
        <tr>
            <th>PLACA</th>
            <th>CLIENTE</th>
            <th>TIPO</th>
            <th>B-SISA</th>
            <th>ACCIONES</th>
        </tr>
    </thead>
    <tbody>
        @isset($vehiculos)
            @foreach ($vehiculos as $vehiculo)
                <tr>
                    <td>
                        <a href="{{ route('vehiculos.show', $vehiculo) }}">{{ $vehiculo->placa }}</a>
                    </td>
                    <td>
                        {{ $vehiculo->tipo }}
                    </td>
                    <td>
                        {{ $vehiculo->marca }}
                    </td>
                    <td><span
                            class="badge {{ $vehiculo->b_sisa ? 'bg-success' : 'bg-secondary' }}">{{ $vehiculo->b_sisa ? 'HÁBIL' : 'INHÁBIL' }}</span>
                    </td>
                    <td>
                        <div class="d-flex">
                            <a href="{{ route('vehiculos.show', $vehiculo) }}" class="my-auto mx-1"><i class="fa fa-eye "
                                    aria-hidden="true"></i></a>
                            <a href="{{ route('vehiculos.edit', $vehiculo) }}" class="my-auto ml-2"><i
                                    class="fas fa-pen"></i></a>
                            <a class="btn my-auto mx-1" data-toggle="modal" data-target="#modal-delete-vehiculo"><i
                                    class="fas fa-trash text-danger"></i></a>
                        </div>
                        <x-alert-confirmation titulo="¿Estás seguro?" id="modal-delete-vehiculo">
                            <x-slot name="mensaje">
                                Esta accion es irreversible<br>
                                </p>
                            </x-slot>

                            <x-slot name="boton">
                                <form action="{{ route('vehiculos.destroy', $vehiculo) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </x-slot>
                        </x-alert-confirmation>
                    </td>
                </tr>
            @endforeach
        @endisset
    </tbody>
</table>
