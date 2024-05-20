<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController
{
    public static function index(Router $router)
    {
        $inicio = true;
        $propiedades = Propiedad::get(3);

        $router->render('paginas/index', [
            'inicio' => $inicio,
            'propiedades' => $propiedades
        ]);
    }

    public static function nosotros(Router $router)
    {
        $router->render('paginas/nosotros');
    }

    public static function anuncios(Router $router)
    {
        $propiedades = Propiedad::all();
        $router->render('paginas/anuncios', [
            'propiedades' => $propiedades
        ]);
    }

    public static function anuncio(Router $router)
    {
        $id = validarORedireccionarHacia('/propiedades');
        $propiedad = Propiedad::find($id);

        $router->render('paginas/anuncio', [
            'propiedad' => $propiedad
        ]);
    }

    public static function blog(Router $router)
    {
        $router->render('paginas/blog');
    }

    public static function entrada(Router $router)
    {
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        $validos = [1, 2, 3, 4];
        $titulos = [
            '1' => 'Aprovechar el exterior como parte del hogar',
            '2' => 'Terraza en el techo de tu casa',
            '3' => 'Guía para la decoración de tu hogar',
            '4' => 'La clave para un blanco radiante'
        ];
        $fechas = [
            '1' => '24/02/2024',
            '2' => '22/03/2024',
            '3' => '17/04/2024',
            '4' => '05/05/2024',
        ];
        
        if (!in_array($id, $validos)) {
            header('Location: /blog');
        }

        $router->render('paginas/entrada', [
            'id' => $id,
            'titulos' => $titulos,
            'fechas' => $fechas
        ]);
    }

    public static function contacto(Router $router)
    {
        $mensaje = null;
        $alerta = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $respuestas = $_POST['contacto'];

            // Crear una instancia del objeto:
            $mail = new PHPMailer();

            // Configurar SMTP:
            $mail->isSMTP();
            $mail->Host = $_ENV['EMAIL_HOST'];
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['EMAIL_USER'];
            $mail->Password = $_ENV['EMAIL_PASS'];
            $mail->SMTPSecure = 'tls';
            $mail->Port = $_ENV['EMAIL_PORT'];

            // Configurar el contenido del email:
            $mail->setFrom('admin@bienesraices.com');
            $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com');
            $mail->Subject = 'Tienes un nuevo mensaje';

            // Habilitar HTML:
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            // Definir el contenido:
            $contenido = '<html>';
            $contenido .= '<p>Tienes un nuevo mensaje</p>';
            $contenido .= '<p>Nombre: ' . $respuestas['nombre'] . '</p>';
            $contenido .= '<p>Método de contacto: ' . $respuestas['contacto'] . '</p>';

            // Enviar de forma condicional:
            if ($respuestas['contacto'] === 'telefono') {
                $contenido .= '<p>Teléfono: ' . $respuestas['telefono'] . '</p>';
                $contenido .= '<p>Fecha y hora de contacto: ' . $respuestas['fecha'] . ' a las ' . $respuestas['hora'] . '</p>';
            } else {
                $contenido .= '<p>Email: ' . $respuestas['email'] . '</p>';
            }
            $contenido .= '<p>Mensaje: ' . $respuestas['mensaje'] . '</p>';
            $contenido .= '<p>Intención: ' . $respuestas['tipo'] . '</p>';
            $contenido .= '<p>Precio o presupuesto: $' . $respuestas['precio'] . '</p>';
            $contenido .= '</html>';

            $mail->Body = $contenido;
            $mail->AltBody = "Esto es texto alternativo sin HTML";

            // Enviar el email:
            if ($mail->send()) {
                $mensaje = "Mensaje enviado correctamente";
                $alerta = 'exito';
            } else {
                $mensaje = "El mensaje no se pudo enviar";
                $alerta = 'error';
            }
        }

        $router->render('paginas/contacto', [
            'mensaje' => $mensaje,
            'alerta' => $alerta
        ]);
    }
}
