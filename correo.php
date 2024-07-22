<?php


require_once('mail/config.php');
$mail->ClearAllRecipients( );

$mail->AddAddress("soporte@cjef.gob.mx");
$mail->AddCC("soporte@cjef.gob.mx");
$mail->AddCC("dticcjef22@gmail.com");
$mail->AddCC("gsimon@cjef.gob.mx");
$mail->IsHTML(true);  //podemos activar o desactivar HTML en mensaje
$mail->Subject = 'Nuevo Ticket Generado';

$msg = "<h2>Contenido mensaje HTML:</h2>
<p>Contenido</p>
<p>Más Contenido...</p>
";

$mail->Body    = $msg;
$mail->Send();



?>
