<?php

include('./db_connect.php');
date_default_timezone_set('America/Mexico_City');

//////////////// contar registros concluidos //////////////7

$sqlPorStaff = "SELECT count(*) as conteo, a.staff_id, b.nombre as descripcion
                    FROM tickets a, cat_personal b
                    WHERE a.staff_id = b.idtrab 
                    AND b.status<>0
                    AND YEAR(date_created) = YEAR(CURDATE())
                    GROUP by a.staff_id;";

$resultPorStaff = $conn->query($sqlPorStaff);
while ($rowTotalStaff = $resultPorStaff->fetch_assoc()) {
  $etiqueta .= "'" . ($rowTotalStaff['descripcion']) . "',";
  $conteo .= $rowTotalStaff['conteo'] . ",";
  $combinadoStaff .= "'" . $rowTotalStaff['descripcion'] . "-" . $rowTotalStaff['conteo'] . "',";
}
$etiqueta = rtrim($etiqueta, ",");
$conteo = rtrim($conteo, ",");
$combinadoStaff = rtrim($combinadoStaff, ",");


////////////////////////////////////
$sqlPorStatus = "SELECT count(*) as conteo, a.status, b.descripcion_status as descripcion
                 FROM tickets a, cat_status b
                 WHERE a.status = b.id_status
                 AND YEAR(date_created) = YEAR(CURDATE())
                 GROUP by a.status;";

$resultPorStatus = $conn->query($sqlPorStatus);
while ($rowTotalStatus = $resultPorStatus->fetch_assoc()) {
  $etiquetaStatus .= "'" . ($rowTotalStatus['descripcion']) . "',";
  $conteoStatus .= $rowTotalStatus['conteo'] . ",";
  $combinadoStatus .= "'" . $rowTotalStatus['descripcion'] . "-" . $rowTotalStatus['conteo'] . "',";
}
$etiquetaStatus = rtrim($etiquetaStatus, ",");
$conteoStatus = rtrim($conteoStatus, ",");
$combinadoStatus = rtrim($combinadoStatus, ",");

////////////////////////////////////////////////////////

$sqlPorArea = "SELECT count(*) as conteo, c.abreviatura as descripcion
                 FROM tickets a, personal_cjef b, cat_areas c
                 WHERE b.areas = c.id
                 AND a.customer_id = b.idtrab
                 AND YEAR(date_created) = YEAR(CURDATE())
                 GROUP BY c.abreviatura;";

$resultPorArea = $conn->query($sqlPorArea);
while ($rowTotalArea = $resultPorArea->fetch_assoc()) {
  $etiquetaArea .= "'" . ($rowTotalArea['descripcion']) . "',";
  $conteoArea .= $rowTotalArea['conteo'] . ",";
  $combinadoArea .= "'" . $rowTotalArea['descripcion'] . "-" . $rowTotalArea['conteo'] . "',";
}
$etiquetaArea = rtrim($etiquetaArea, ",");
$conteoArea = rtrim($conteoArea, ",");
$combinadoArea = rtrim($combinadoArea, ",");

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
          <span class="info-box-number"><?php echo $conn->query("SELECT * FROM tickets where YEAR(date_created) = YEAR(CURDATE());")->num_rows; ?></span>
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
          <span class="info-box-number"><?php echo $conn->query("SELECT * FROM tickets where status <> 2 and staff_id = " . $_SESSION['login_id'])->num_rows; ?></span>
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
<div class="row">
  <div class="col-sm-5">
    <div class="info-box mb-3">
      <span class=" elevation-1"></span>
      <div class="info-box-content">
        <span class="info-box-text">Tickets por Equipo de Soporte</span>
        <span class="info-box-number">
          <canvas class="pie-chart" id="pieTotalStaff">
          </canvas>
        </span>
      </div>
    </div>
  </div>
</div>





<script type="text/javascript">
  //pie chart
  var pie = document.getElementById('pieTotalStaff');
  var pieConfig = new Chart(pie, {
    type: 'bar',
    data: {
      labels: [<?php echo $combinadoStaff; ?>],
      datasets: [{
        label: 'año actual',
        data: [<?php echo $conteo; ?>],
        backgroundColor: ["#26547c", "#990033", "#ffd166", "#06d6a0", "#ff206e", "#33ccff", "#cc00cc", "#050505"],
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
        backgroundColor: ["#26547c", "#990033", "#ffd166", "#06d6a0", "#ff206e", "#33ccff", "#cc00cc", "#050505"],
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
        backgroundColor: ["#26547c", "#990033", "#ffd166", "#06d6a0", "#ff206e", "#33ccff", "#cc00cc", "#050505"],
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

<script>
  //bar chart
  var bar = document.getElementById('bar');
  bar.height = 400
  var barConfig = new Chart(bar, {
    type: 'horizontalBar',
    data: {
      labels: ['data-1', 'data-2', 'data-3', 'data-4', 'data-5', 'data-6', 'data-7'],
      datasets: [{
        label: '# of data',
        data: [30, 25, 20, 15, 11, 4, 2],
        backgroundColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(225, 50, 64, 1)', 'rgba(64, 159, 64, 1)'],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      },
      responsive: true, // Instruct chart js to respond nicely.
      maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height
    }
  })
  //bubble chart
  var bubble = document.getElementById('bubble');
  bubble.height = 200
  var myBubbleChart = new Chart(bubble, {
    type: 'bubble',
    data: {
      labels: ['data-1', 'data-2', 'data-3', 'data-4', 'data-5', 'data-6', 'data-7'],
      datasets: [{
        label: '# of data',
        data: [{
          x: 20,
          y: 10,
          r: 10
        }, {
          x: 15,
          y: 5,
          r: 13
        }, {
          x: 12,
          y: 4,
          r: 8
        }, {
          x: 17,
          y: 2,
          r: 10
        }, {
          x: 10,
          y: 9,
          r: 15
        }, {
          x: 8,
          y: 8,
          r: 12
        }, {
          x: 16,
          y: 9,
          r: 8
        }],
        backgroundColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(225, 50, 64, 1)', 'rgba(64, 159, 64, 1)', ]
      }]
    },
    options: {
      responsive: true, // Instruct chart js to respond nicely.
      maintainAspectRatio: false,
    }
  });
  //doughnut chart
  var doughnut = document.getElementById('doughnut');
  var doughnutConfig = new Chart(doughnut, {
    type: 'doughnut',
    data: {
      labels: ['data-1', 'data-2', 'data-3'],
      datasets: [{
        label: '# of data',
        data: [11, 30, 20],
        backgroundColor: ['rgba(0, 230, 118, 1)', 'rgba(255, 206, 86, 1)', 'rgba(255,99,132,1)'],
        borderWidth: 1
      }]
    },
    options: {
      responsive: true, // Instruct chart js to respond nicely.
      maintainAspectRatio: true, // Add to prevent default behaviour of full-width/height
    }
  });
  //line chart
  var line = document.getElementById('line');
  line.height = 200
  var lineConfig = new Chart(line, {
    type: 'line',
    data: {
      labels: ['data-1', 'data-2', 'data-3', 'data-4', 'data-5', 'data-6'],
      datasets: [{
        label: '# of data', // Name the series
        data: [10, 15, 20, 10, 25, 5, 10], // Specify the data values array
        fill: false,
        borderColor: '#2196f3', // Add custom color border (Line)
        backgroundColor: '#2196f3', // Add custom color background (Points and Fill)
        borderWidth: 1 // Specify bar border width
      }]
    },
    options: {
      responsive: true, // Instruct chart js to respond nicely.
      maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height
    }
  })
  //pie chart
  var pie = document.getElementById('pie');
  var pieConfig = new Chart(pie, {
    type: 'pie',
    data: {
      labels: ['data-1', 'data-2'],
      datasets: [{
        label: '# of data',
        data: [40, 80],
        backgroundColor: ['rgba(103, 216, 239, 1)', 'rgba(246, 26, 104,1)'],
        borderWidth: 1
      }]
    },
    options: {
      responsive: true, // Instruct chart js to respond nicely.
      maintainAspectRatio: true, // Add to prevent default behaviour of full-width/height
    }
  });
  //polar area chart
  var polar = document.getElementById('polar');
  var polarConfig = new Chart(polar, {
    type: 'polarArea',
    data: {
      labels: ['data-1', 'data-2', 'data-3'],
      datasets: [{
        label: '# of data',
        data: [10, 20, 30],
        backgroundColor: ['rgba(0, 230, 118, 1)', 'rgba(255, 206, 86, 1)', 'rgba(255,99,132,1)'],
        borderWidth: 1
      }]
    },
    options: {
      responsive: true, // Instruct chart js to respond nicely.
      maintainAspectRatio: true, // Add to prevent default behaviour of full-width/height
    }
  });
  //mixed chart
  var mixed = document.getElementById('mixed');
  var mixedConfig = new Chart(mixed, {
    type: 'bar',
    data: {
      labels: ['data-1', 'data-2', 'data-3', 'data-4', 'data-5', 'data-6', 'data-7'],
      datasets: [{
        label: '# of data',
        data: [18, 12, 9, 11, 8, 4, 2],
        backgroundColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(225, 50, 64, 1)', 'rgba(64, 159, 64, 1)'],
        borderWidth: 1
      }, {
        label: '# of data', // Name the series
        data: [20, 19, 18, 14, 12, 15, 10],
        type: 'line', // Specify the data values array
        fill: false,
        borderColor: '#2196f3', // Add custom color border (Line)
        backgroundColor: '#2196f3', // Add custom color background (Points and Fill)
        borderWidth: 1,
        order: 2
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      },
      responsive: true, // Instruct chart js to respond nicely.
      maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height
    }
  })
</script>