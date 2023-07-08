@extends('adminlte::page')

@section('title', 'Bombas')

@section('content')
    <section class="content">
        <div class="container-fluid p-4">
            <!-- SELECT2 EXAMPLE -->
            <div class="card">
             <div class="bg-black p-3">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="px-3 pt-3">
                            <strong>BOMBAS</strong>
                        </h3>
                        <p class="px-3 text-sm">
                            LISTA DE BOMBAS REGISTRADOS
                        </p>
                    </div>
                    <div class="p-3">
                        <span class="fa fa-battery-quarter fa-4x"></span>
                    </div>
                  
                </div>
            </div>
            <div class="card">
            <!-- SELECT2 EXAMPLE -->
            <div class="form-group">
                <div style="text-align: right">
                     <a type="button" class="btn btn-success mr-3"
                          href="{{ route('bombas.export') }}">Excel</a>
                    
                    <a type="button" class="btn btn-warning mr-2"
                          href="{{ route('bombas-html') }}">Html</a>
                     
                     <a type="button" class="btn btn-danger mr-2"
                          href="{{ route('download-pdf') }}">PDF</a>
                </div>
        </div> 
            @foreach ($bombas as $bomba)
                <div class="card my-4">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h3 class="card-title card-success pr-2">
                                    <strong>{{ 'Bomba: ' . $bomba->codigo . ' ' . ' ' }}</strong>
                                </h3>
                                    @switch($bomba->tanque->combustible->tipo)
                                        @case('gasolina')
                                            <span class="badge px-1 bg-orange">
                                            @break
    
                                            @case('etanol')
                                            <span class="badge px-1 bg-yellow">
                                            @break
    
                                            @case('diesel')
                                            <span class="badge px-1 bg-red">
                                            @break
    
                                            @default
                                        @endswitch
                                        {{ $bomba->tanque->combustible->nombre }}
                                    </span>
                                
                            </div>
                            <div class="card-tools">
                                <a class="btn btn-tool" href="{{ route('bombas.show', $bomba) }}">
                                    <i class="fa fa-eye"></i>
                                </a>

                                <a class="btn btn-tool" href="{{ route('bombas.edit', $bomba) }}">
                                    <i class="fa fa-pen"></i>
                                </a>

                                <a class="btn btn-tool" >
                                    <form action="{{route('bombas.liberar',[$bomba->id])}}" method="POST" >
                                        @csrf
                                        {{ method_field('PUT') }}
                                        <button type="submmit" class="btn btn-tool">
                                            
                                            @if ($bomba->libre)
                                                <i class="fas fa-solid fa-lock-open"></i>
                                            @else
                                                 <i class="fas fa-solid fa-lock"></i> 
                                            @endif

                                        </button>
                                    </form>
                                </a>

                                
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Estado</label>
                                    <p type="text" class="">{{ $bomba->estado ? 'Activo' : 'Inactivo' }}</p>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Asignacion</label>
                                    <p type="text" class="">{{ $bomba->libre ? 'libre' : 'ocupado' }}</p>
                                </div>
                            </div>



                        </div>
                   
                    </div>
                </div> 
            @endforeach
        </div>
        <!-- /.container-fluid -->
    </section>
<!-- /.Paginacion -->
{{ $bombas->links() }} 
@stop
