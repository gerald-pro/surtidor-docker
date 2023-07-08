<script>
    chartlitrosVendidosMes();

    function chartlitrosVendidosMes() {
        var no_data = document.getElementById('no_data_chart_litros_vendidos');
        no_data.style.display = "none"
        var ctx = document.getElementById('chart_litros_vendidos');

        var valores = [];
        var labels = [];
        var opacidad = 0.7;

        var data = {
            labels: labels,
            datasets: [{
                label: 'Litros vendidos',
                data: valores,
                backgroundColor: [
                    `rgb(255, 99, 132, ${opacidad})`,
                    `rgb(75, 192, 192, ${opacidad})`,
                    `rgb(255, 205, 86, ${opacidad})`,
                    `rgb(201, 203, 207, ${opacidad})`,
                    `rgb(54, 162, 235, ${opacidad})`,
                    `rgb(255, 99, 132, ${opacidad})`,
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 0.5,
                hoverOffset: 10
            }]
        };

        var config = {
            type: 'doughnut',
            data: data,
            responsive: true,
            maintainAspectRatio: false,
            options: {
                animation: {
                    onComplete: function(animation) {
                        var firstSet = animation.chart.config.data.datasets[0].data;

                        if (typeof firstSet !== "object") {
                            
                        }
                    }
                }
            }
        };

        chart_litros_vendidos_mes = new Chart(ctx, config);

        function getDatos(request) {
            fetch('{{ route('fetch.ventas_combustibles.litros_vendidos') }}', {
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
                    if (json.length !== 0) {
                        json.forEach(element => {
                            labels.push(element.combustible);
                            valores.push(parseFloat(element.litros));

                        });
                        chart_litros_vendidos_mes.data.labels = labels;
                        chart_litros_vendidos_mes.data.datasets[0].data = valores;
                        no_data.style.display = "none";
                        chart_litros_vendidos_mes.update();
                    } else {
                        chart_litros_vendidos_mes.data.labels = [];
                        chart_litros_vendidos_mes.data.datasets[0].data = [];
                        no_data.style.display = "block";
                        chart_litros_vendidos_mes.update();
                    }

                    $("#loading_chart_litros_vendidos").find(".spinner-border").remove();
                })
                .catch(function(error) {
                    console.log(error);
                });
        }

        let request = {
            'mes': $('#mes_chart_litros_vendidos').val(),
        }
        getDatos(request);


        $('#mes_chart_litros_vendidos').on('change', function() {
            $("#loading_chart_litros_vendidos").prepend('<div class="spinner-border spinner-border-sm"></div>');
            valores = [];
            labels = [];

            request = {
                'mes': $('#mes_chart_litros_vendidos').val(),
            }
            getDatos(request);
        })

        $('#export_chart_litros_vendidos').on('click', function(a) {
            var a = document.createElement('a');
            a.href = chart_litros_vendidos_mes.toBase64Image();
            a.download = 'Gráfico - Monto total de ventas por mes.png';
            a.click();
        })
    }
</script>
