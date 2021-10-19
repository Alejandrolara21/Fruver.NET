<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../build/css/app.css">
    <title>Fruver.NET</title>
</head>

<body>
    <header class="header">
        <?php if(!$login){ ?>
        <nav class="ingreso-registro contenedor">
            <a class="navegacion-enlace" href="/login">Log in</a>
            <div>|</div>
            <a class="navegacion-enlace" href="/registrar">Register</a>
        </nav>
        <?php } ?>
        <div class="navbar">
            <div class="logo ">
                <a href="/">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-seeding" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 10a6 6 0 0 0 -6 -6h-3v2a6 6 0 0 0 6 6h3" />
                        <path d="M12 14a6 6 0 0 1 6 -6h3v1a6 6 0 0 1 -6 6h-3" />
                        <line x1="12" y1="20" x2="12" y2="10" />
                    </svg>
                    Fruver.net
                </a>
            </div>
            <nav class="navegacion">
                <a class="navegacion-enlace" href="#">Inicio</a>
                <a class="navegacion-enlace" href="#">Productos</a>
                <a class="navegacion-enlace" href="#">Contactar</a>
            </nav>
        </div>
    </header>

    <?php
    echo $contenido;
    ?>

    <footer class="footer">
        <p>Todos los derechos reservados</p>
        <p>Proyecto de practica con PHP 8 y SASS</p>
    </footer>

</body>

</html>