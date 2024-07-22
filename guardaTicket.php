<?php

    include('./db_connect.php');

    $idtrab = $_POST['username'];
    $categoria = $_POST['categoria'];
    $descripcion = $_POST['descripcion'];


    $sqlUsuario = "SELECT concat(a.nombre,' ',a.paterno,' ',a.materno) as nombre_completo, a.areas, a.email , b.abreviatura
                   FROM personal_cjef a, cat_areas b
                   WHERE a.idtrab = $idtrab
                   AND a.areas = b.id ";
    $resultPorStaff = $conn->query($sqlUsuario);
    while($rowTotalStaff = $resultPorStaff->fetch_assoc())
    {
      $nombreUsuaurio = $rowTotalStaff['nombre_completo'];
      $nombreArea = $rowTotalStaff['abreviatura'];
      $area = $rowTotalStaff['areas'];
    }

    $sql = "INSERT INTO tickets (id, subject, description, status, department_id, customer_id, staff_id, admin_id)
            VALUES (0, $categoria, '$descripcion', 0, $area, $idtrab, 0, 1)";



    if(mysqli_query($conn, $sql))
		{
      //$last_id = mysqli_insert_id($conn);
      $last_id = $conn->insert_id;
		  $message = "<span class='control-label text-dark'> Tú solicitud fue guardada correctamente, en breve se atenderá su solicitud número: $last_id <span>";
      /* código correo */
      require_once('mail/config.php');
      $mail->ClearAllRecipients( );
      $mail->AddAddress("soporte@cjef.gob.mx");
      $mail->AddCC("soporte@cjef.gob.mx");
      $mail->AddCC("dticcjef22@gmail.com");
      $mail->AddCC("dtic@cjef.gob.mx");
      $mail->IsHTML(true);  //podemos activar o desactivar HTML en mensaje
      $mail->Subject = 'Nuevo Ticket Generado';

      $msg = "<h2>Ticket #: $last_id </h2>
      Nombre del Solicitante: $nombreUsuaurio <br>
      Área: $nombreArea <br>
      <p>Descripción:  $descripcion</p> ";

      $mail->Body    = $msg;
      $mail->Send();
      /* fin código correo */
		}
		else
		{
			$message = "Error al guardar, intenta más tarde.";
		}

  echo $message;

?>
