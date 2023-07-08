@extends('layouts/master')

@section('content_header')

@stop

@section('content')
<div class="card">
    <div class="card-body">
        <!--aqui empieza el codigo del formulario-->
        <form method="GET" action = "{{ url('/bitacora/' . $audit->id) }}">
            @csrf
            {{ method_field('POST') }}
            <!--inicio campo nombre-->
            <div class="mb-3">
                <label for="name" class="form-label">Tabla Modificada</label>

            </div>
            <div class="mb-3">

                <label for="name" class="form-label">{{$audit->auditable_type}}</label>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Eventp</label>

            </div>
            <div class="mb-3">

                <label for="name" class="form-label">{{$audit->event}}</label>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Fecha</label>

            </div>
            <div class="mb-3">

                <label for="name" class="form-label">{{$audit->created_at}}</label>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Valor Antiguo</label>

            </div>
            <div class="mb-3">

                <label for="name" class="form-label">{{$audit->old_values}}</label>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Valor Nuevo</label>

            </div>
            <div class="mb-3">

                <label for="name" class="form-label">{{$audit->new_values}}</label>
            </div>
            <!--fin campo cantidad-->
        </form>

        <a href="{{ url('/bitacora') }}"
            class="btn btn-success">
              VOLVER
          </a>
         </div>
        <!--aqui termina el codigo del formulario-->
    </div>
</div>
@stop
