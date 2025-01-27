<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';  // Asegúrate de que la ruta sea correcta

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = htmlspecialchars($_POST['nombre']);
    $telefono = htmlspecialchars($_POST['telefono']);
    $telefono_url = urlencode(preg_replace('/\D/', '', $telefono));
    $correo = htmlspecialchars($_POST['correo']);
    $puesto = htmlspecialchars($_POST['puesto']);
    $radicas = htmlspecialchars($_POST['radicas']);
    $grado_estudios = htmlspecialchars($_POST['grado_estudios']);


    // Manejar el archivo PDF subido
    if (isset($_FILES['cv']) && $_FILES['cv']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['cv']['tmp_name'];
        $fileName = $_FILES['cv']['name'];
        $fileSize = $_FILES['cv']['size'];
        $fileType = $_FILES['cv']['type'];

        // Verificar que el archivo sea un PDF
        if ($fileType == 'application/pdf') {
            // Ruta de destino en el servidor
            $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/PAGINA/HTML/uploads/';

            $filePath = $uploadDir . basename($fileName);
            
            // Mover el archivo al servidor
            if (move_uploaded_file($fileTmpPath, $filePath)) {
                // Archivo subido correctamente
                $cvAttachment = $filePath;
            } else {
                // Error al mover el archivo
                echo "<script>alert('Hubo un problema al subir el archivo.');</script>";
                exit;
            }
        } else {
            // El archivo no es un PDF
            echo "<script>alert('Solo se permite subir archivos PDF.');</script>";
            exit;
        }
    } else {
        echo "<script>alert('Por favor, adjunta un archivo PDF.');</script>";
        exit;
    }

    // Crear una nueva instancia de PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.ionos.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'recursoshumanos@fast-net.com.mx';
        $mail->Password   = 'H5z73185@-Pws210984';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        $mail->CharSet = 'UTF-8';

        // Remitente y destinatario
        $mail->setFrom('recursoshumanos@fast-net.com.mx', 'Solicitud De Empleo');
        $mail->addAddress('recursoshumanos@fast-net.com.mx', 'Recursos Humanos');

        // Asunto
        $mail->Subject = 'Nueva Solicitud de Contratación';

        $mail->addEmbeddedImage('../RECURSOS/logo_oficial.png', 'logo_fastnet'); // Ruta del logo local

        // Cuerpo del mensaje (HTML)
        $mail->isHTML(true);
        $mail->Body = '
       <div style="text-align: center; margin-bottom: 20px;">
    <img src="cid:logo_fastnet" alt="Logo FastNet" width="200" />
    <h2 style="color: #0056b3; margin: 10px 0;">Nueva Solicitud de Contratación</h2>
</div>

        <table style="width: 100%; border-collapse: collapse; margin: 20px 0;">
            <tr>
                <td style="padding: 10px; border: 1px solid #ddd;">Nombre Completo</td>
                <td style="padding: 10px; border: 1px solid #ddd;">' . $nombre . '</td>
            </tr>
            <tr>
                <td style="padding: 10px; border: 1px solid #ddd;">Correo Electrónico</td>
                <td style="padding: 10px; border: 1px solid #ddd;">' . $correo . '</td>
            </tr>
            <tr>
                <td style="padding: 10px; border: 1px solid #ddd;">Número Telefónico</td>
                <td style="padding: 10px; border: 1px solid #ddd;">
                    <a href="https://wa.me/' . $telefono_url . '" target="_blank">' . $telefono . '</a>
                </td>
            </tr>
            <tr>
                <td style="padding: 10px; border: 1px solid #ddd;">Puesto Solicitado</td>
                <td style="padding: 10px; border: 1px solid #ddd;">' . $puesto . '</td>
            </tr>
            <tr>
                <td style="padding: 10px; border: 1px solid #ddd;">¿Dónde radicas?</td>
                <td style="padding: 10px; border: 1px solid #ddd;">' . $radicas . '</td>
            </tr>
            <tr>
            <td style="padding: 10px; border: 1px solid #ddd;">Grado de Estudios</td>
            <td style="padding: 10px; border: 1px solid #ddd;">' . $grado_estudios . '</td>
            </tr>
        </table>';

        // Adjuntar el archivo PDF
        $mail->addAttachment($cvAttachment, 'CV_' . basename($fileName));

        // Enviar el correo
        $mail->send();

        // Mensaje de éxito con SweetAlert
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
                window.location.href = 'index.html';
            });
        });
        </script>";
    } catch (Exception $e) {
        // Mensaje de error con SweetAlert
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
