<?php

  include('./db_connect.php');

//////////////// contar registros concluidos //////////////7
$etiquetasSub = "[";
$conteoSub = " [";

$sqlSubdireccion = "SELECT count(*) as conteo, a.staff_id, b.nombre as descripcion
                    FROM tickets a, cat_personal b
                    WHERE a.staff_id = b.idtrab
                    GROUP by a.staff_id";

                //    $qry = $conn->query("SELECT *,concat(lastname,', ',firstname,' ',middlename) as name FROM customers order by concat(lastname,', ',firstname,' ',middlename) asc");
                //    while($row= $qry->fetch_assoc()):

$resultSubdireccion = $conn->query($sqlSubdireccion);

while($rowTotalSub = $resultSubdireccion->fetch_assoc())
{
  $etiquetasSub.= "\"".($rowTotalSub['descripcion'])."\",";
  $datosVentas.= $rowTotalSub['conteo'].",";
}
$etiquetasSub = rtrim($etiquetasSub,",");
$conteoSub = rtrim($conteoSub,",");
$etiquetasSub.= "]";
$conteoSub.= "]";
/////////////////////// fin contar registros concluidos //////////////////////////////////////


// Valores con PHP. Estos podrían venir de una base de datos o de cualquier lugar del servidor
$etiquetas = ["Hugo", "Carlos Alberto", "Gabriel Abraham", "María Cristina"];
$datosVentas = [5, 15, 8, 5];


?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
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
                  <span class="info-box-number"><?php echo $conn->query("SELECT * FROM tickets")->num_rows; ?></span>
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
                  <span class="info-box-number"><?php echo $conn->query("SELECT * FROM tickets where status = 2")->num_rows; ?></span>
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
                  <span class="info-box-number"><?php echo $conn->query("SELECT * FROM tickets where status <> 2 and staff_id = ".$_SESSION['login_id'])->num_rows; ?></span>
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

<div class="row"> </div>





<script type="text/javascript">
    // Obtener una referencia al elemento canvas del DOM
    const $grafica = document.querySelector("#grafica");
    // Pasaamos las etiquetas desde PHP
    var etiquetas = <?php echo json_encode($etiquetas) ?>;
    // Podemos tener varios conjuntos de datos. Comencemos con uno
    const datosVentas2020 = {
        label: "Tickets del Staff",
        // Pasar los datos igualmente desde PHP
        data: <?php echo json_encode($datosVentas) ?>,
        backgroundColor: 'rgba(54, 162, 235, 0.2)', // Color de fondo
        borderColor: 'rgba(54, 162, 235, 1)', // Color del borde
        borderWidth: 1, // Ancho del borde
    };
    new Chart($grafica, {
        type: 'pie', // Tipo de gráfica
        data: {
            labels: etiquetas,
            datasets: [
                datosVentas2020,
                // Aquí más datos...
            ]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }],
            },
        }
    });
</script>
