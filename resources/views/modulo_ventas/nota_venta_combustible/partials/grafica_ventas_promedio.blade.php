<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            Número de ventas promedio por dia
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool m-n2" id="export_chart_ventas_promedio">
                <i class="fas fa-file-download fa-lg"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="row justify-content-end">
            <div class="d-flex my-auto" id="loading_chart_ventas_promedio">
            </div>
            <div class="d-flex px-2">
                <select class="form-control form-control-sm" id="rango_chart_ventas_promedio" name="rango">
                    <option value="3">3 meses</option>
                    <option value="6">6 meses</option>
                    <option value="12">12 meses</option>
                </select>
            </div>
        </div>
        <canvas id="chart_ventas_promedio_dia"></canvas>
    </div>
</div>
