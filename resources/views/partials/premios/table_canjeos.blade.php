
        @if ($premio->clientes->count())

            <table class="table table-hover table-head-fixed">
                <thead class="table-light">
                    <tr>
                        <th>CLIENTE</th>
                        <th>CANTIDAD</th>
                        <th>PUNTOS</th>
                        <th>FECHA DE CANJEO</th>
                        <th>OPCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($premio->clientes as $cliente)
                        <tr>
                            <td>{{ $cliente->nombre . ' ' . $cliente->apellido }}</td>
                            <td>{{ $cliente->pivot->cantidad }}</td>
                            <td>{{ $cliente->pivot->puntos_canjeados }}</td>
                            <td>{{ \Carbon\Carbon::parse($cliente->pivot->created_at)->format('d/m/Y - H:i') }}
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                    data-target="#modal-delete-canjeo"><i class="fas fa-trash"></i></button>

                                <x-alert-confirmation titulo="Eliminar canjeo" id="modal-delete-canjeo">
                                    <x-slot name="mensaje">
                                        <p>¿Estás seguro?<br>
                                            Esta acción eliminará el canjeo registrado
                                        </p>
                                    </x-slot>

                                    <x-slot name="boton">
                                        <form
                                            action="{{ route('clientes.destroyPremio', [$cliente, $cliente->pivot->id]) }}"
                                            method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                        </form>
                                    </x-slot>
                                </x-alert-confirmation>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-center my-auto py-2">
                No se encontraron premios
            </p>
        @endif

