@extends('adminlte::page')

@section('content_header')
    <h1>Lista de Empleados </h1>
@stop

@section('content')

    <div class="d-grid gap-2">
        <a class="btn btn-success" href="{{ route('empleados.create') }}"> crear </a>
    </div>

    <!-- buscador-->
    <div class="card-header">
        <input wire:model="search" class="form-control" placeholder="Buscar">
    </div>
    <!-- fin buscador-->


    <div class="table-responsive">
        <table class="table">
            <table class="table caption-top">
                <thead>
                    <tr>
                        <th scope="col">Foto</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Rol</th>
                        <th scope="col">Última vez</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Accion</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $usuario)
                        <tr>
                            <th scope="row"> <img
                                    src="{{ $usuario->foto_perfil? app('firebase.storage')->getBucket()->object($usuario->foto_perfil)->signedUrl(Carbon\Carbon::now()->addSeconds(5)): asset('/img/user-default.jpeg') }}"
                                    alt="" height="80px"></th>
                            <td>{{ $usuario->name }}</td>
                            <td>{{ $usuario->telefono }}</td>
                            <td>{{ $usuario->role_name() }}</td>
                            <td>
                                @if (Cache::has('user-is-online-' . $usuario->id))
                                    <span class="text-success">Online</span>
                                @else
                                    <span class="text-secondary">Offline</span>
                                @endif
                            </td>

                            <td class="text-center" style="display: inline-block"><span
                                    class="badge {{ $usuario->estado ? 'bg-success' : 'bg-secondary' }}">{{ $usuario->estado ? 'ACTIVO' : 'INACTIVO' }}</span>
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">

                                    <a href="{{ url('/empleados/' . $usuario->id . '/') }}" class="btn btn-success">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <a href="{{ url('/empleados/' . $usuario->id . '/edit') }}" class="btn btn-warning">
                                        <i class="fas fa-pen"></i>
                                    </a>

                                    <form action="{{ url('/empleados/' . $usuario->id) }}" method="post">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button type="submit" onclick="return confirm('¿Estas Seguro de Eliminarlo?')"
                                             class="btn btn-danger"><i class="fas fa-trash"></i>
                                        </button>
                                    </form>

                                    <a href="{{ url('/empleados-bombas/' . $usuario->id ) }}" class="btn btn-info">
                                        <i class="fas fa-fw fa-gas-pump"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </table>
    </div>

@stop
