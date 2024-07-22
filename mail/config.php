<?php

/*
*
* Endeos, Working for You
* blog.endeos.com
*
*/

require_once('PHPMailerAutoload.php');

$mail = new PHPMailer;
$mail->IsSMTP();
$mail->Host = 'mail.cjef.gob.mx';   /*Servidor SMTP*/
$mail->SMTPAutoTLS = false;
$mail->SMTPSecure = false;
//$mail->SMTPSecure = 'SSL/TLS';   /*Protocolo SSL o TLS*/
$mail->Port = 25;   /*Puerto de conexión al servidor SMTP*/
$mail->SMTPAuth = true;   /*Para habilitar o deshabilitar la autenticación*/
$mail->Username = 'soporte@cjef.gob.mx';   /*Usuario, normalmente el correo electrónico*/
$mail->Password = '48d71aZb0';   /*Tu contraseña*/
$mail->From = 'soporte@cjef.gob.mx';   /*Correo electrónico que estamos autenticando*/
$mail->FromName = 'Mesa de Ayuda DTIC';   /*Puedes poner tu nombre, el de tu empresa, nombre de tu web, etc.*/
$mail->CharSet = 'UTF-8';   /*Codificación del mensaje*/

?>
