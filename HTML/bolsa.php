<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Cargar la librería PHPMailer
require 'vendor/autoload.php';  // Asegúrate de que la ruta sea correcta

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar reCAPTCHA
    $recaptchaSecret = '6LffFs0qAAAAAIpAS3g9_eZhI82RQzuGEKjuZ-M7';  // Clave secreta reCAPTCHA
    $recaptchaResponse = $_POST['g-recaptcha-response'];

    // Verificar si se ha completado el reCAPTCHA
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$recaptchaSecret&response=$recaptchaResponse");
    $responseKeys = json_decode($response, true);

    if(intval($responseKeys["success"]) !== 1) {
        // Si la validación de reCAPTCHA falla
        echo "<script>alert('Por favor, complete el reCAPTCHA');</script>";
        exit;
    }

    // Obtener los valores del formulario
    $empresa = htmlspecialchars($_POST['empresa']);
    $contacto = htmlspecialchars($_POST['contacto']);
    $telefono = htmlspecialchars($_POST['telefono']);
    $email = htmlspecialchars($_POST['email']);
    $asunto = htmlspecialchars($_POST['asunto']);
    $consentimiento = isset($_POST['consentimiento']) ? 'Sí' : 'No';

    // Crear una nueva instancia de PHPMailer
    $mail = new PHPMailer(true);
    $telefono_url = urlencode(preg_replace('/\D/', '', $telefono));  // Limpiar el número de caracteres no numéricos

    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.ionos.com';  // Servidor SMTP de IONOS
        $mail->SMTPAuth   = true;
        $mail->Username   = 'ventasempresariales@fast-net.com.mx';  // Tu correo de IONOS
        $mail->Password   = 'F@stnet#5f$4E';  // Tu contraseña de correo
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        
        $mail->CharSet = 'UTF-8';

        // Remitente y destinatario
        $mail->setFrom('ventasempresariales@fast-net.com.mx', 'CONTRATACION EMPRESARIAL');  // Nombre estático de remitente
        $mail->addAddress('ventasempresariales@fast-net.com.mx', 'Contratacion FastNet');  // Correo destino

        // Agregar la imagen incrustada
        $mail->addEmbeddedImage('../RECURSOS/logo_oficial.png', 'logo_fastnet'); // Ruta del logo local

        // Asunto
        $mail->Subject = 'Nueva Solicitud de Contratación';

        // Cuerpo del mensaje (HTML)
        $mail->isHTML(true);  // Asegurarse de que el correo sea enviado en formato HTML
        $mail->Body = '
        <div style="text-align: center; margin-bottom: 20px;">
            <img src="cid:logo_fastnet" alt="Logo de FastNet" style="max-width: 150px;">
            <h2 style="color: #0056b3; margin: 10px 0;">Nueva Solicitud de Contratación</h2>
        </div>
        <table style="width: 100%; border-collapse: collapse; margin: 20px 0;">
            <tr>
                <th style="text-align: left; padding: 10px; border: 1px solid #ddd; background-color: #60269E; color: #fff;">INFORMACIÓN DE CONTRATACION</th>
                <th style="text-align: left; padding: 10px; border: 1px solid #ddd; background-color: #60269E; color: #fff;">DATOS DE CLIENTE</th>
            </tr>
            <tr>
                <td style="padding: 10px; border: 1px solid #ddd;">Nombre de la Empresa</td>
                <td style="padding: 10px; border: 1px solid #ddd;">' . $empresa . '</td>
            </tr>
            <tr>
                <td style="padding: 10px; border: 1px solid #ddd;">Nombre de Contacto</td>
                <td style="padding: 10px; border: 1px solid #ddd;">' . $contacto . '</td>
            </tr>
            <tr>
                 <td style="padding: 10px; border: 1px solid #ddd;">Número Telefónico</td>
                <td style="padding: 10px; border: 1px solid #ddd;">
                    <a href="https://wa.me/' . $telefono_url . '" target="_blank">' . $telefono . '</a>
                </td>
            </tr>
            <tr>
                <td style="padding: 10px; border: 1px solid #ddd;">Correo Electrónico</td>
                <td style="padding: 10px; border: 1px solid #ddd;">' . $email . '</td>
            </tr>
            <tr>
                <td style="padding: 10px; border: 1px solid #ddd;">Asunto</td>
                <td style="padding: 10px; border: 1px solid #ddd;">' . $asunto . '</td>
            </tr>
            <tr>
                <td style="padding: 10px; border: 1px solid #ddd;">Consentimiento</td>
                <td style="padding: 10px; border: 1px solid #ddd;">' . $consentimiento . '</td>
            </tr>
        </table>
        ';

        // Enviar el correo
        $mail->send();

        // Agregar SweetAlert para éxito
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: '¡Solicitud Enviada!',
                text: 'Gracias por tu solicitud. Nos pondremos en contacto contigo pronto.',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            }).then(function() {
                window.location.href = '../index.html'; // Redirigir a otra página después de la alerta
            });
        });
        </script>";

    } catch (Exception $e) {
        // Agregar SweetAlert para error
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
}
?>
