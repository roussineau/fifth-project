<?php


if (!isset($_SESSION)) {
    session_start();
}

$auth = $_SESSION['login'] ?? false;

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes raíces</title>
    <link rel="stylesheet" href="/build/css/app.css">
</head>

<body>

    <header class="header <?php echo $inicio ? 'inicio' : '' ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <div class="mobile">
                    <a href="/index.php" class="logo">
                        <img src="/build/img/logo.svg" alt="Logotipo de Bienes Raices">
                    </a>
                    <div class="opciones">
                        <div class="dark-mode-boton">
                            <img src="/build/img/dark-mode.svg" alt="Icono dark mode">
                        </div>
                        <div class="mobile-menu">
                            <img src="/build/img/barras.svg" alt="Icono menu">
                        </div>
                    </div>
                </div>
                <div class="derecha">
                    <nav class="navegacion navegacion-mobile <?php echo $inicio ? 'mostrar' : '' ?>">
                        <a href="nosotros.php">Nosotros</a>
                        <a href="anuncios.php">Anuncios</a>
                        <a href="blog.php">Blog</a>
                        <a href="contacto.php">Contacto</a>
                        <?php if ($auth) { ?>
                            <a href="/admin">Admin</a>
                        <?php } else { ?>
                            <a href="/login.php">Admin</a>
                        <?php } ?>
                    </nav>
                </div>
            </div> <!-- .barra -->

            <?php if ($inicio) { ?>
                <h1>Venta de casas y departamentos de lujo</h1>
            <?php } ?>

        </div>
    </header>