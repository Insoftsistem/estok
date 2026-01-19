
	<div class="card ">
		<?php 
			$chartdata = $comp_model->linechart_sadaprodutos();
		?>
		<div class="p-3">
			<div class=" fw-bold h4">Saída Produtos</div>
			<small class="text-muted"></small>
		</div>
		<canvas id="linechart_sadaprodutos" __tagattributes></canvas>
		<script>
			$(function (){
			var chartData = {
				labels: <?php echo json_encode($chartdata['labels']); ?>,
				datasets: <?php echo json_encode($chartdata['datasets']); ?>
			}
			var ctx = document.getElementById('linechart_sadaprodutos');
			var chart = new Chart(ctx, {
				type:'line',
				data: chartData,
				
				options: {
					scaleStartValue: 0,
					responsive: true,
					scales: {
						xAxes: [{
							ticks:{display: true},
							gridLines:{display: true},
							scaleLabel: {
								display: true,
								labelString: ""
							}
						}],
						yAxes: [{
							ticks: {
								beginAtZero: true,
								display: true
							},
							scaleLabel: {
								display: true,
								labelString: ""
							}
						}]
					},
				}
,
			})});
		</script>
	</div>
