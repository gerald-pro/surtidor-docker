<script>
    chartVentasPromediolDia();

    function chartVentasPromediolDia() {
        const ctx = document.getElementById('chart_ventas_promedio_dia');
        var values = [];
        var labels = [];

        var data = {
            labels: labels,
            datasets: [{
                label: 'Promedio de ventas',
                data: values,
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                ],
                tension: 0.2,
                borderWidth: 3,
                pointBorderWidth: 6
            }]
        };

        var config = {
            type: 'line',
            data: data,
        };

        chart_ventas_promedio_dia = new Chart(ctx, config);
        chart_ventas_promedio_dia.height = 200;

        function getDatos(request) {
            fetch('{{ route('fetch.ventas_combustibles.ventas_promedio.dia') }}', {
                    method: 'POST',
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    },
                    body: JSON.stringify(request),
                })
                .then(response => response.json())
                .then((json) => {
                    json.forEach(element => {
                        labels.push(element.dia);
                        values.push(parseFloat(element.promedio));
                    });
                    chart_ventas_promedio_dia.data.labels = labels;
                    chart_ventas_promedio_dia.data.datasets[0].data = values;
                    chart_ventas_promedio_dia.update();
                    $("#loading_chart_ventas_promedio").find(".spinner-border").remove();
                    var image = chart_ventas_promedio_dia.toBase64Image();
                })
                .catch(function(error) {
                    console.log(error);
                });
        }

        let request = {
            'rango': $('#rango_chart_ventas_promedio').val(),
        }
        getDatos(request);


        $('#rango_chart_ventas_promedio').on('change', function() {
            $("#loading_chart_ventas_promedio").prepend('<div class="spinner-border spinner-border-sm"></div>');
            values = [];
            labels = [];

            request = {
                'rango': $('#rango_chart_ventas_promedio').val(),
            }
            getDatos(request);
        })

        $('#export_chart_ventas_promedio').on('click', function(a) {
            var a = document.createElement('a');
            a.href = chart_ventas_promedio_dia.toBase64Image();
            a.download = 'Gráfico - Monto promedio por venta.png';
            a.click();
        })
    }
</script>
