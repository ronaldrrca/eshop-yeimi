<?php
$nombre = trim(htmlspecialchars($_GET['nombre']));
$email = trim(htmlspecialchars($_GET['email']));
$telefono = trim(htmlspecialchars($_POST['telefono'])) ?? ""; 
$textMessage = trim(htmlspecialchars($_GET['textMessage'])) ?? "";

$message = "";
$to = "ronaldrrca@gmail.com";
$header = "From: contacto@codews.co" . "\r\n";//El email remitente debe ser una cuenta del dominio.
$subject = "Contacto Web";

$message .= "Enviado por: " . $nombre . "\r\n";
$message .= "Teléfono: " . $telefono . " \r\n";
$message .= "E-mail: " . $email . " \r\n";
date_default_timezone_set("America/Bogota");
$message .= "Enviado el: " . date('d/m/Y', time()) . ", a las " . date("h:i:sa") . " \r\n";
$message .= "Mensaje: " . $textMessage . " \r\n";

mail($to, $subject, $message, $header);

?>