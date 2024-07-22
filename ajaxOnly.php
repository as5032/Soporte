<?php



    $idtrab = $_POST['username'];
    $categoria = $_POST['categoria'];
    $descripcion = $_POST['descripcion'];


    $sql = "INSERT INTO tickets (id, subject, description, status, department_id, customer_id, staff_id, admin_id)
            VALUES (0, $categoria, '$descripcion', 0, 0, $idtrab, 0, 1)";



      //$last_id = mysqli_insert_id($conn);
      $last_id = "258";
		  $message = "<span class='text-dark'> Tú solicitud fue guardada correctamente, en breve se atenderá su solicitud número: $last_id </span>";
      /* código correo */



      /* fin código correo */


  echo $message;

?>
