<script>
    chartMontoTotalMes();

    function chartMontoTotalMes() {
        const ctx = document.getElementById('chart_monto_total_mes');
        var values = [];
        var labels = [];

        var data = {
            labels: labels,
            datasets: [{
                label: 'Monto de dinero (bs)',
                data: values,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        };

        var config = {
            type: 'bar',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
            }
        };

        chart_monto_total_mes = new Chart(ctx, config);
        chart_monto_total_mes.height = 200;

        function getDatos(request) {
            fetch('{{ route('fetch.ventas_combustibles.mes') }}', {
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
                    console.log(json)
                    json.forEach(element => {
                        labels.push(element.mes);
                        values.push(parseFloat(element.total));
                    });

                    chart_monto_total_mes.data.labels = labels;
                    chart_monto_total_mes.data.datasets[0].data = values;
                    chart_monto_total_mes.update();
                    $("#loading_chart_monto_total").find(".spinner-border").remove();
                })
                .catch(function(error) {
                    console.log(error);
                });
        }

        let request = {
            'rango': $('#rango_chart_monto_total').val(),
        }
        getDatos(request);


        $('#rango_chart_monto_total').on('change', function() {
            $("#loading_chart_monto_total").prepend('<div class="spinner-border spinner-border-sm"></div>');
            values = [];
            labels = [];

            request = {
                'rango': $('#rango_chart_monto_total').val(),
            }
            getDatos(request);
        })

        $('#export_chart_monto_total').on('click', function(a) {
            var a = document.createElement('a');
            a.href = chart_monto_total_mes.toBase64Image();
            a.download = 'Gráfico - Monto total de ventas por mes.png';
            a.click();
        })
    }
</script>
