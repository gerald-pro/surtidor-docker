@extends('adminlte::page')

@section('title', 'Roles')

{{-- @section('content_header')
    <h1>Roles</h1>
@stop --}}

@section('content')
@if(session('info'))
    <div class="alert alert-success">
        {{session('info')}}
    </div>

@endif
<div class="card">
    <div class="card-body">
        <div class="card-header">
            <a class="btn btn-secondary" href="{{route('admin.roles.create')}}">Agregar rol</a>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Role</th>
                    <th colspan="2"></th>
                </tr>
            </thead>

            <tbody>
                @foreach($roles as $role)
                <tr>
                    <td>{{$role->id}}</td>
                    <td>{{$role->name}}</td>
                    <td width="10px">
                        <a class="btn btn-primary btn-sm" href="{{route('admin.roles.edit', $role)}}">
                            <i class="fa fa-pen"></i>
                        </a>
                    </td>

                    <td width="10px">
                        <a class="btn btn-danger btn-sm" href="{{route('admin.roles.destroy', $role)}}">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@stop