<?php
include('./db_connect.php');

$tabla = mysqli_query($conn, "SELECT nombre, paterno, materno, t.description, t.date_created, descripcion_status, t.id, abreviatura, t.status 
    FROM tickets t 
    INNER JOIN cat_status ON t.status = id_status 
    LEFT JOIN personal_cjef ON t.customer_id = personal_cjef.idtrab
    LEFT JOIN cat_areas On t.department_id = cat_areas.id
    WHERE t.status <> 2 
    AND t.date_created >= DATE_SUB(CURDATE(), INTERVAL 1 DAY) 
    ORDER BY t.date_created DESC");

$no_registros = mysqli_num_rows($tabla);
if ($no_registros > 0) {
  $c = 0;
  while ($registro = mysqli_fetch_assoc($tabla)) {
    $c++;
    $color = ($c % 2 == 0) ? '#ebebeb' : '#ffffff';
    $fecha = $registro["date_created"];
    $TAno = substr($fecha, 0, 4);
    $TMes = substr($fecha, 5, 2);
    $TDia = substr($fecha, 8, 2);
    $THora = substr($fecha, 11, 2);
    $TMinuto = substr($fecha, 14, 2);
    $fecha = $TDia . "/" . $TMes . "/" . $TAno . "  " . $THora . ":" . $TMinuto;
    $texto = ucwords(strtolower($registro["description"]));
    $usuario = $registro['nombre'] . " " . $registro['paterno'] . " " . $registro['materno'];
    echo "<li class='control-label text-dark' style='background-color: $color;'>
                <strong>TICKET: " . $registro['id'] . "</strong>  ---->  <em>" . $texto . "</em><br>
                <strong>Usuario: </strong>" . $usuario . " <strong> " . $registro['abreviatura'] . "</strong> " . $fecha . "-----> 
                <strong>" . $registro["descripcion_status"] . "</strong>
              </li>";
  }
}
