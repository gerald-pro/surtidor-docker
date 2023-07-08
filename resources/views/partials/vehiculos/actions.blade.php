<div class="d-flex">
    <a href="{{ route('vehiculos.show', $id) }}" class="my-auto"><i class="fa fa-eye fa-fw" aria-hidden="true"></i></a>
    <a href="{{ route('vehiculos.edit', $id) }}" class="my-auto mx-2"><i class="fas fa-pen fa-fw"></i></a>
    <a class="btn my-auto mx-n2" data-toggle="modal" data-target="#modal-delete-vehiculo"><i
            class="fas fa-trash fa-fw text-danger"></i></a>
</div>

<x-alert-confirmation titulo="¿Estás seguro?" id="modal-delete-vehiculo">
    <x-slot name="mensaje">
        Esta accion es irreversible<br>
        </p>
    </x-slot>

    <x-slot name="boton">
        <form action="{{ route('vehiculos.destroy', $id) }}" method="POST">
            @method('DELETE')
            @csrf
            <button type="submit" class="btn btn-danger">Eliminar</button>
        </form>
    </x-slot>
</x-alert-confirmation>
