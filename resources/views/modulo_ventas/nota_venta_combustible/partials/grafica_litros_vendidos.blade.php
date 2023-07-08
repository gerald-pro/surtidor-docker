<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            Cantidad de combustible vendido (lts)
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool m-n2" id="export_chart_litros_vendidos">
                <i class="fas fa-file-download fa-lg"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="row justify-content-between">
            <div class="col col-5 p-0">
                <div id="no_data_chart_litros_vendidos" class="text-danger">No hay datos para representar</div>
            </div>
            <div class="col col-5 p-0">
                <div class="row justify-content-end">
                    <div class="d-flex my-auto" id="loading_chart_litros_vendidos">
                    </div>

                    <div class="d-flex px-2">
                        <select class="form-control form-control-sm" id="mes_chart_litros_vendidos" name="mes">
                            @foreach ($meses as $mes)
                                <option value="{{ $mes['fecha'] }}"
                                    {{ $mes['fecha']->format('m') == today()->format('m') ? 'selected' : '' }}>
                                    {{ $mes['nombre'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <canvas id="chart_litros_vendidos"></canvas>
        </div>
    </div>
</div>
