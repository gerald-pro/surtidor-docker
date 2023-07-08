<div>
    <div class="card-header justify-content-between">
        <div class="row g-2">
            <div class="col-sm-6 p-2">
                <h3 class="card-title">
                    <strong>LISTA DE CLIENTES</strong>
                </h3>
            </div>
            <div class="col-sm-3 text-right my-auto">
                <button data-toggle="modal" data-target="#formCreateModal" class="btn btn-primary"
                    type="button">Nuevo</button>
            </div>

            <div class="modal fade" id="formCreateModal" tabindex="-1" aria-labelledby="formCreateLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="fomrCreateLabel">Registrar nuevo cliente</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @include('partials.clientes.form_create')
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-3 my-auto">
                <div class="input-group">
                    <input name="buscar" id="buscar" type="text" class="form-control" placeholder="ci, nombre"
                        wire:model.debounce.800ms="search">
                    <div class="input-group-append">
                        <div class="btn btn-default">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        @if ($clientes->count())
            <table class="table table-sm table-hover table-head-fixed">
                <thead class="table-light">
                    <tr>
                        <th scope="col">
                            <div class="d-flex justify-content-between">
                                <div>
                                    CI
                                </div>
                                <a href="#" wire:click="order('ci')" class="badge badge-light my-auto">
                                    @if ($sort == 'ci')
                                        @if ($direction == 'asc')
                                            <i class="fa fa-sort-up"></i>
                                        @else
                                            <i class="fa fa-sort-down"></i>
                                        @endif
                                    @else
                                        <i class="fa fa-sort" aria-hidden="true"></i>
                                    @endif
                                </a>
                            </div>
                        </th>
                        <th scope="col">
                            <div class="d-flex justify-content-between">
                                <div>
                                    NOMBRE
                                </div>
                                <a href="#" wire:click="order('nombre')" class="badge badge-light my-auto">
                                    @if ($sort == 'nombre')
                                        @if ($direction == 'asc')
                                            <i class="fa fa-sort-up"></i>
                                        @else
                                            <i class="fa fa-sort-down"></i>
                                        @endif
                                    @else
                                        <i class="fa fa-sort" aria-hidden="true"></i>
                                    @endif
                                </a>
                            </div>
                        </th>
                        <th scope="col">
                            <div class="d-flex justify-content-between">
                                <div>
                                    PUNTOS
                                </div>
                                <a href="#" wire:click="order('puntos')" class="badge badge-light my-auto">
                                    @if ($sort == 'puntos')
                                        @if ($direction == 'asc')
                                            <i class="fa fa-sort-up"></i>
                                        @else
                                            <i class="fa fa-sort-down"></i>
                                        @endif
                                    @else
                                        <i class="fa fa-sort" aria-hidden="true"></i>
                                    @endif
                                </a>
                            </div>
                        </th>
                        <th scope="col">
                            <div class="d-flex justify-content-between">
                                <div>
                                    ESTADO
                                </div>
                                <a href="#" wire:click="order('estado')" class="badge badge-light my-auto">
                                    <i class="fa fa-sort" aria-hidden="true"></i>
                                </a>
                            </div>
                        </th>
                        {{-- <th style="width: 15%" class="text-center">OPCIONES</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientes as $cliente)
                        <tr>
                            <td>{{ $cliente->ci }}</td>
                            <td><a
                                    href="{{ route('clientes.show', $cliente) }}">{{ $cliente->nombre . ' ' . $cliente->apellido }}</a>
                            </td>
                            <td>
                                {{ $cliente->puntos }}
                            </td>
                            <td><span
                                    class="badge {{ $cliente->estado ? 'bg-success' : 'bg-secondary' }}">{{ $cliente->estado ? 'ACTIVO' : 'INACTIVO' }}</span>
                            </td>

                            {{-- <td class="text-center">
                        <a href="{{ route('clientes.show', $cliente) }}" class="mx-2">
                            <i class="fa fa-eye"></i>
                        </a>
                    </td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex px-3 pt-3 flex-row-reverse">
                {{ $clientes->links() }}
            </div>
        @else
            <p class="text-center py-2 my-auto">
                No se encontraron clientes
            </p>
        @endif
    </div>
</div>
