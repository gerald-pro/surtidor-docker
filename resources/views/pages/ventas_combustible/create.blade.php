@extends('adminlte::page')

@section('content')
<div class="card">
    <form action="{{ route('venta.combustible.bomba_v', $bomba) }}" method="post">
        @csrf
        <div class="card-body">
            <!--aqui empieza el codigo del select bomba-->
            <div class="row mb-3">
                <div class="col-md-10">

                    <div class="mb-3">
                        <label for="name" class="form-label">bomba</label>
                        <input name="bomba" type="text" class="form-control" id="bomba" required value="{{ $bomba->nombre }}">
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Combustible</label>
                        <input name="combustible" type="text" class="form-control" id="combustible" required value="{{ $bomba->tanque->combustible->nombre}}">
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Usuario</label>
                        <input name="name" type="text" class="form-control" id="name" required value="{{ auth()->user()->name }}">
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nombre">precio</label>
                            <input name="nombre" class="form-control my-colorpicker1" value="{{$bomba->tanque->combustible->precio_venta}}">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nombre">cantidad</label>
                            <input name="nombre" class="form-control my-colorpicker1" value="{{''}}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Fecha</label>
                        <input name="name" type="text" class="form-control" id="name" required value="{{ Carbon\Carbon::now()->format('d/m/Y') }}">

                    </div>
                    <div class="d-flex justify-content-end">
                        <a type="button" class="btn btn-danger mr-2" href="{{ route('tanques.index') }}">Cancelar</a>

                        <button type="submit" class="btn btn-info">Guardar</a>

                    </div>
                </div>

    </form>
</div>



@stop