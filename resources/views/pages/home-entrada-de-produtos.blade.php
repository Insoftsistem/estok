
	<div class="card ">
		<?php 
			$chartdata = $comp_model->piechart_entradadeprodutos();
		?>
		<div class="p-3">
			<div class=" fw-bold h4">Entrada de Produtos</div>
			<small class="text-muted"></small>
		</div>
		<canvas id="piechart_entradadeprodutos" __tagattributes></canvas>
		<script>
			$(function (){
			var chartData = {
				labels: <?php echo json_encode($chartdata['labels']); ?>,
				datasets: <?php echo json_encode($chartdata['datasets']); ?>
			}
			var ctx = document.getElementById('piechart_entradadeprodutos');
			var chart = new Chart(ctx, {
				type:'pie',
				data: chartData,
				
				options: {
					responsive: true,
					scales: {
						yAxes: [{
							ticks:{display: false},
							gridLines:{display: false},
							scaleLabel: {
								display: true,
								labelString: ""
							}
						}],
						xAxes: [{
							ticks:{display: false},
							gridLines:{display: false},
							scaleLabel: {
								display: true,
								labelString: ""
							}
						}],
					},
				}
,
			})});
		</script>
	</div>
