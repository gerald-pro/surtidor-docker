@extends('adminlte::page')

@section('title', 'Lista de clientes')

@section('content')
    <section class="content">
        <div class="container-fluid pt-4">
            <div class="card">
                <livewire:index-clientes />
            </div>
        </div>
    </section>
@stop

@section('css')

@stop

@section('js')
    <script>
        $(window).on('load', function() {
            let a = 'hola'
            if ('{{ $errors->any() }}') {
                $('#formCreateModal').modal('show');
            }
        });
    </script>
@stop
