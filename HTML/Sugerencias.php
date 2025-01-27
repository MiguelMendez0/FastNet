<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Cargar la librería PHPMailer
require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar y sanitizar los datos del formulario
    $nombre = htmlspecialchars($_POST['nombre'] ?? '');
    $mensaje = htmlspecialchars($_POST['mensaje'] ?? '');
    $consentimiento = isset($_POST['consentimiento']) ? 'Aceptado' : 'No aceptado';

    // Crear una nueva instancia de PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.ionos.com'; // Servidor SMTP
        $mail->SMTPAuth   = true;
        $mail->Username   = 'contrataciones@fast-net.com.mx'; // Correo de IONOS
        $mail->Password   = 'Dws@210984'; // Contraseña del correo
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        $mail->CharSet    = 'UTF-8';

        // Remitente y destinatario
        $mail->setFrom('contrataciones@fast-net.com.mx', 'FastNet Contrataciones');
        $mail->addAddress('contrataciones@fast-net.com.mx', 'Soporte FastNet');

        // Asunto
        $mail->Subject = 'QUEJAS Y SUGERENCIAS';

        $mail->addEmbeddedImage('../RECURSOS/logo_oficial.png', 'logo_fastnet'); // Ruta del logo local

        // Cuerpo del correo
        $mail->isHTML(true);
        $mail->Body = "
        <div style='font-family: Arial, sans-serif;'>
         <img src='../RECURSOS/logo_fastnet.png' alt='logo FastNet' width='200' />       
            <h2 style='color: #0056b3;'>Nueva Queja o Sugerencia</h2>
            <p><strong>Nombre:</strong> {$nombre}</p>
            <p><strong>Mensaje:</strong></p>
            <p>{$mensaje}</p>
            <p><strong>Consentimiento:</strong> {$consentimiento}</p>
        </div>";
        $mail->AltBody = "Nueva Queja o Sugerencia\n\nNombre: {$nombre}\nMensaje: {$mensaje}\nConsentimiento: {$consentimiento}";

        // Enviar el correo
        if ($mail->send()) {
            echo "
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: '¡Formulario Enviado!',
                    text: 'Gracias por tu mensaje. Lo revisaremos pronto.',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                }).then(function() {
                    window.location.href = 'index.html';
                });
            });
            </script>";
        } else {
            throw new Exception('No se pudo enviar el correo.');
        }
    } catch (Exception $e) {
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Error al Enviar',
                text: 'Hubo un problema al enviar el correo. Error: {$mail->ErrorInfo}',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            });
        });
        </script>";
    }
} else {
    echo "No se recibieron datos del formulario.";
}
?>
