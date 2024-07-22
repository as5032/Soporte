<?php

  include('./db_connect.php');
  date_default_timezone_set('America/Mexico_City');

//////////////// contar registros concluidos //////////////7

$fechaInicioTickets = date('Y-m-01');
$fechaFinTickets = date('Y-m-t');
if (($fechaInicioTickets)&&($fechaFinTickets)){
$sqlPorStaff = "SELECT count(*) as conteo, a.staff_id, b.nombre as descripcion
                    FROM tickets a, cat_personal b
                    WHERE a.staff_id = b.idtrab
                    AND date_created BETWEEN '$fechaInicioTickets' AND '$fechaFinTickets'
                    GROUP by a.staff_id";
}else{
$sqlPorStaff = "SELECT count(*) as conteo, a.staff_id, b.nombre as descripcion
                    FROM tickets a, cat_personal b
                    WHERE a.staff_id = b.idtrab
                    AND MONTH(date_created) = MONTH(CURRENT_DATE())
                    AND YEAR(date_created) = YEAR(CURRENT_DATE())
                    -- AND date_created BETWEEN '$fechaInicioTickets' AND '$fechaFinTickets'
                    GROUP by a.staff_id";
}

$resultPorStaff = $conn->query($sqlPorStaff);
while($rowTotalStaff = $resultPorStaff->fetch_assoc())
{
  $etiqueta.= "'".($rowTotalStaff['descripcion'])."',";
  $conteo.= $rowTotalStaff['conteo'].",";
  $combinadoStaff.= "'".$rowTotalStaff['descripcion']."-".$rowTotalStaff['conteo']."',";
}
$etiqueta = rtrim($etiqueta,",");
$conteo = rtrim($conteo,",");
$combinadoStaff = rtrim($combinadoStaff,",");

////////////////////////////////////
$sqlPorStatus = "SELECT count(*) as conteo, a.status, b.descripcion_status as descripcion
                 FROM tickets a, cat_status b
                 WHERE a.status = b.id_status
                 AND date_created BETWEEN '$fechaInicioTickets' AND '$fechaFinTickets'
                 GROUP by a.status ";

$resultPorStatus = $conn->query($sqlPorStatus);
while($rowTotalStatus = $resultPorStatus->fetch_assoc())
{
  $etiquetaStatus.= "'".($rowTotalStatus['descripcion'])."',";
  $conteoStatus.= $rowTotalStatus['conteo'].",";
  $combinadoStatus.= "'".$rowTotalStatus['descripcion']."-".$rowTotalStatus['conteo']."',";

}
$etiquetaStatus = rtrim($etiquetaStatus,",");
$conteoStatus = rtrim($conteoStatus,",");
$combinadoStatus = rtrim($combinadoStatus,",");

////////////////////////////////////////////////////////

$sqlPorArea = "SELECT count(*) as conteo, c.abreviatura as descripcion
                 FROM tickets a, personal_cjef b, cat_areas c
                 WHERE b.areas = c.id
                 AND a.customer_id = b.idtrab
                 AND date_created BETWEEN '$fechaInicioTickets' AND '$fechaFinTickets'
                 GROUP BY c.abreviatura ";

$resultPorArea = $conn->query($sqlPorArea);
while($rowTotalArea = $resultPorArea->fetch_assoc())
{
  $etiquetaArea.= "'".($rowTotalArea['descripcion'])."',";
  $conteoArea.= $rowTotalArea['conteo'].",";
  $combinadoArea.= "'".$rowTotalArea['descripcion']."-".$rowTotalArea['conteo']."',";
}
$etiquetaArea = rtrim($etiquetaArea,",");
$conteoArea = rtrim($conteoArea,",");
$combinadoArea = rtrim($combinadoArea,",");
/////////////////////// fin contar registros concluidos //////////////////////////////////////


?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
<link rel="stylesheet" type="text/css" href="assets/dist/css/charts.css" media="screen" />
<!-- Info boxes -->
<div class="col-12">
       <div class="card">
         <div class="card-body">
           Bienvenido <?php echo $_SESSION['login_name'] ?>!
         </div>
       </div>
   </div>

        <div class="row">

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-ticket-alt"></i></span>
              <div class="info-box-content">
                <a href="./index.php?page=newTicketStaffList" class="nav-link">
                  <span class="info-box-text">Total Tickets</span>
                  <span class="info-box-number"><?php echo $conn->query("SELECT * FROM tickets where YEAR(date_created) = YEAR(CURDATE());")->num_rows; ?> </span>
                </a>
              </div>
            </div>
          </div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-ticket-alt"></i></span>
              <div class="info-box-content">
                <a href="./index.php?page=newTicketStaffList" class="nav-link">
                  <span class="info-box-text">Total Tickets Cerrados</span>
                  <span class="info-box-number"><?php echo $conn->query("SELECT * FROM tickets where status = 2 AND YEAR(date_created) = YEAR(CURDATE());")->num_rows; ?></span>
                </a>
              </div>
            </div>
          </div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-ticket-alt"></i></span>
              <div class="info-box-content">
                <a href="./index.php?page=newTicketStaffPersonal" class="nav-link">
                  <span class="info-box-text">Mis Tickets</span>
                  <span class="info-box-number"><?php echo $conn->query("SELECT * FROM tickets where status <> 2 and staff_id = ".$_SESSION['login_id']." AND date_created BETWEEN '$fechaInicioTickets' AND '$fechaFinTickets' ")->num_rows; ?></span>
                </a>
              </div>
            </div>
          </div>



          <!--
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Total Customers</span>
                <span class="info-box-number">
                  <?php echo $conn->query("SELECT * FROM customers")->num_rows; ?>
                </span>
              </div>
            </div>
          </div>
        -->
          <!-- /.col -->
          <!--
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-user"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Total Staff</span>
                 <span class="info-box-number">
                  <?php echo $conn->query("SELECT * FROM staff")->num_rows; ?>
                </span>
              </div>
            </div>
          </div>
        -->
          <!-- /.col -->

          <!-- fix for small devices only -->
          <!--
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-columns"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Departments</span>
                <span class="info-box-number"><?php echo $conn->query("SELECT * FROM departments")->num_rows; ?></span>
              </div>
            </div>
          </div>
        -->

          <!-- /.col -->
        </div>

<!--   gráficas   -->
  <!-- inicia Row gráficas -->
  <div class="row">

    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box mb-3">
        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-user"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Tickets por Staff de Soporte</span>
           <span class="info-box-number">
             <canvas class="pie-chart" id="pieTotalStaff">
             </canvas>
          </span>
        </div>
      </div>
    </div>

    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box mb-3">
        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-ticket-alt"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Tickets por Estatus</span>
           <span class="info-box-number">
             <canvas class="pie-chart" id="pieStatus">
             </canvas>
          </span>
        </div>
      </div>
    </div>

    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box mb-3">
        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-columns"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Tickets por Área</span>
           <span class="info-box-number">
             <canvas class="pie-chart" id="pieArea">
             </canvas>
          </span>
        </div>
      </div>
    </div>

  <!-- fin Row gráficas -->
  </div>





<script type="text/javascript">
//pie chart
var pie = document.getElementById('pieTotalStaff');
var pieConfig = new Chart(pie, {
  type: 'pie',
  data: {
      labels: [<?php echo $combinadoStaff; ?>],
      datasets: [{
          label: '# of data',
          data: [<?php echo $conteo; ?>],
          backgroundColor: ['#ff6384', '#36a2eb', '#ffce56', '#4bc0c0', '#003399', '#e13240', '#409f40'],
          borderWidth: 1
      }]
  },
  options: {
      responsive: true, // Instruct chart js to respond nicely.
      maintainAspectRatio: true, // Add to prevent default behaviour of full-width/height
  }
});

var pie = document.getElementById('pieStatus');
var pieConfig = new Chart(pie, {
  type: 'pie',
  data: {
      labels: [<?php echo $combinadoStatus; ?>],
      datasets: [{
          label: '# of data',
          data: [<?php echo $conteoStatus; ?>],
          backgroundColor: ['#00cc00', '#cc0000', '#ffd966'],
          borderWidth: 1
      }]
  },
  options: {
      responsive: true, // Instruct chart js to respond nicely.
      maintainAspectRatio: true, // Add to prevent default behaviour of full-width/height
  }
});

var pie = document.getElementById('pieArea');
var pieConfig = new Chart(pie, {
  type: 'pie',
  data: {
      labels: [<?php echo $combinadoArea; ?>],
      datasets: [{
          label: '# of data',
          data: [<?php echo $conteoArea; ?>],
          backgroundColor: ['#ff6384', '#36a2eb', '#ffce56', '#4bc0c0', '#003399', '#e13240', '#409f40'],
          borderWidth: 1
      }]
  },
  options: {
      responsive: true, // Instruct chart js to respond nicely.
      maintainAspectRatio: true, // Add to prevent default behaviour of full-width/height
  }
});
/*
new Chart(document.getElementById("pie-chart-status"), {
        type: 'pie',
        data: {
          <?php echo $etiquetasSub; ?>
          datasets: [{
            label: "Population (millions)",
            backgroundColor: ["#06d6a0", "#1b9aaa", "#ef476f"],
            <?php echo $conteoSub; ?>
          }]
        },
        options: {
          title: {
            display: true,
            text: '<?php echo ($_SESSION['nombreArea']); ?>'
          }
        }
      });
*/



</script>
