<?php
// Cambia este correo por el tuyo real
$receiving_email_address = 'hgranados@flowresults.com';

// Solo acepta peticiones POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

  // Validación básica y captura de datos
  $name    = $_POST['name'] ?? '';
  $email   = $_POST['email'] ?? '';
  $subject = $_POST['subject'] ?? 'Mensaje desde formulario de contacto';
  $message = $_POST['message'] ?? '';

  // Verificación básica
  if (empty($name) || empty($email) || empty($message)) {
    http_response_code(400);
    echo 'Por favor completa todos los campos requeridos.';
    exit;
  }

  // Arma el cuerpo del mensaje
  $body = "Nombre: $name\nCorreo: $email\n\nMensaje:\n$message";

  $headers = "From: $email\r\n";
  $headers .= "Reply-To: $email\r\n";

  // Enviar el correo
  if (mail($receiving_email_address, $subject, $body, $headers)) {
    http_response_code(200);
    echo "Tu mensaje ha sido enviado correctamente.";
  } else {
    http_response_code(500);
    echo "Hubo un error al enviar el mensaje.";
  }

} else {
  http_response_code(403);
  echo "Método no permitido.";
}
?>
