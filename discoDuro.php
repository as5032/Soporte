<?php
if(!isset($conn)){
	include 'db_connect.php';
}
	include('xcrud/xcrud.php');

	$query = "SELECT MAX(id) AS valorMaximoId, uso FROM disk_usage GROUP BY uso";
	$result = mysqli_query($conn, $query);

	while ($row = mysqli_fetch_assoc($result))
	{
		$valor = $row['uso'];
	}

	$valor = rtrim($valor, "G");
	$libre = 1006 - $valor;


	$xcrud = Xcrud::get_instance();
	$xcrud->table('disk_usage');
	$xcrud->columns('uso, Disponible, total, fecha');
	$xcrud->subselect('Disponible','{total}-'.$valor);
	$xcrud->unset_add();
	$xcrud->unset_edit();
	$xcrud->unset_view();
	$xcrud->unset_remove();
	$xcrud->column_pattern('total','{value}GB');
	$xcrud->column_pattern('Disponible','{value}GB');
	$xcrud->order_by('fecha','desc');
	$xcrud->unset_title();

?>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

	<div class="col-12 col-sm-6 col-md-3">
		<div class="info-box mb-3">
			<span class="info-box-icon bg-danger elevation-1"><i class="fas fa-tools"></i></span>
			<div class="info-box-content">
				<span class="info-box-text">Espacio en disco</span>
				 <span class="info-box-number">
					 <canvas class="pie-chart" id="diskChart">
					 </canvas>
				</span>
			</div>
		</div>
	</div>
	<br><br><br>
	<?php echo $xcrud->render(); ?>

	  <script type="text/javascript">

		var pie = document.getElementById('diskChart');
	var pieConfig = new Chart(pie, {
	  type: 'pie',
	  data: {
	    labels: ["Libre: <?php echo $libre." GB"; ?>", "Usado: <?php echo $valor." GB"; ?>"],
	    datasets: [{
	      label: 'Espacio',
	      data: [<?php echo $libre.",".$valor; ?>],
	      backgroundColor: ['#ffce56', '#4bc0c0', '#003399', '#e13240', '#409f40'],
	      borderWidth: 1
	    }]
	  },
	  options: {
	    responsive: true,
	    plugins: {
	      tooltip: {
	        callbacks: {
	          label: function(context) {
	            var value = context.dataset.data[context.dataIndex];
	            var total = context.dataset.data.reduce(function(a, b) {
	              return a + b;
	            }, 0);
	            var percentage = Math.round((value / total) * 100);
	            return value + ' GB (' + percentage + '%)';
	          }
	        }
	      }
	    }
	  }
	});

	  </script>
