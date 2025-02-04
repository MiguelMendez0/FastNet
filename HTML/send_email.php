<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica si el usuario resolvió reCAPTCHA
    $recaptchaSecret = "6LeHBs0qAAAAALnIEzdv9q2E-bhaFg5rLX0b8ytU"; // Cambia por tu clave secreta
    $recaptchaResponse = $_POST['g-recaptcha-response'];

    if (!$recaptchaResponse) {
        echo "<script>
            alert('Por favor, verifica el reCAPTCHA antes de enviar el formulario.');
            window.history.back();
        </script>";
        exit;
    }

    // Verificación de reCAPTCHA con Google
    $verifyURL = "https://www.google.com/recaptcha/api/siteverify";
    $data = [
        'secret' => $recaptchaSecret,
        'response' => $recaptchaResponse
    ];

    $options = [
        'http' => [
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data)
        ]
    ];

    $context  = stream_context_create($options);
    $verify = file_get_contents($verifyURL, false, $context);
    $captchaSuccess = json_decode($verify);

    if (!$captchaSuccess->success) {
        echo "<script>
            alert('Verificación de reCAPTCHA fallida. Inténtalo de nuevo.');
            window.history.back();
        </script>";
        exit;
    }

    // Capturar datos del formulario
    $telefono = htmlspecialchars($_POST['numero']);
    $telefono_url = urlencode(preg_replace('/\D/', '', $telefono));

    // Configurar PHPMailer
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.ionos.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'contrataciones@fast-net.com.mx';
        $mail->Password   = 'Dws@210984';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        $mail->CharSet    = 'UTF-8';

        $mail->setFrom('contrataciones@fast-net.com.mx', 'CONTRATACION');
        $mail->addAddress('contrataciones@fast-net.com.mx', 'Contratacion FastNet');
        $mail->addEmbeddedImage('../RECURSOS/logo_oficial.png', 'logo_fastnet');

        $mail->Subject = 'Nueva Solicitud de Contratación';
        $mail->isHTML(true);
        $mail->Body = '
        <div style="text-align: center;">
            <img src="cid:logo_fastnet" alt="Logo de FastNet" style="max-width: 150px;">
            <h2 style="color: #0056b3;">Nueva Solicitud de Contratación</h2>
        </div>
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <th style="background-color: #60269E; color: white;">INFORMACIÓN</th>
                <th style="background-color: #60269E; color: white;">DATOS</th>
            </tr>
            <tr><td>Nombre</td><td>' . htmlspecialchars($_POST['fullname']) . '</td></tr>
            <tr><td>Correo</td><td>' . htmlspecialchars($_POST['email']) . '</td></tr>
            <tr><td>Teléfono</td><td><a href="https://wa.me/' . $telefono_url . '">' . $telefono . '</a></td></tr>
            <tr><td>Paquete</td><td>' . htmlspecialchars($_POST['paquete']) . '</td></tr>
            <tr><td>Estado</td><td>' . htmlspecialchars($_POST['estado']) . '</td></tr>
            <tr><td>Municipio</td><td>' . htmlspecialchars($_POST['municipio']) . '</td></tr>
            <tr><td>Mensaje</td><td>' . htmlspecialchars($_POST['message']) . '</td></tr>
        </table>';

        $mail->send();
        echo "<script>
            alert('Solicitud enviada correctamente.');
            window.location.href = '../index.html';
        </script>";

    } catch (Exception $e) {
        echo "<script>
            alert('Error al enviar: {$mail->ErrorInfo}');
            window.history.back();
        </script>";
    }
}
?>
