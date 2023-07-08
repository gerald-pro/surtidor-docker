@extends('adminlte::page')

@section('title', 'Registrar premio')

@section('content')
    <section class="content">
        <div class="container-fluid py-4">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">
                            <strong>REGISTRAR PREMIO</strong>
                        </h4>
                    </div>
                </div>
                    <div class="card-body">     
                        @include('partials.premios.form_create')
                    </div>
                </form>
            </div>
        </div>
    </section>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            desactivar_unidades();
            $('#producto_id').on('change', function() {
                desactivar_unidades();
            })

            function desactivar_unidades() {
                if (!$('#producto_id').val()) {
                    $('#unidades').prop("disabled", true);
                    $('#unidades').val('');
                }else{
                    $('#unidades').prop("disabled", false);
                    $('#unidades').prop("required", true);
                }
            }
        });
    </script>
@stop
