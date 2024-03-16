<?php
require_once 'vistas/helpers/usuarios.php';
require_once 'vistas/helpers/juegos.php'
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $tituloPagina ?></title>
    <link rel="stylesheet" href="css/cabecera.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <h1>GameForum!</h1>
            </div>
            <div class="topJuegosBtn">
            <?php
            if (basename($_SERVER['PHP_SELF']) == 'topJuegos.php') {
                    echo mostrarBotonAgregarJuego(); 
                }
            ?>
            </div>
            <div class="login">
                <?= saludo() ?>
            </div>
        </div>
    </header>

    <nav>
        <div class="container">
            <ul>
                <li><a href="index.php">Foro</a></li>
                <li><a href="index.php">Noticias</a></li>
                <li><a href="topJuegos.php">Top Juegos</a></li>

                <li class="spacer"></li><!-- Este elemento crea un espacio entre "Top Juegos" y el cuadro de búsqueda -->
                <li class="search-box">
                    <input type="text" placeholder="Buscar">
                    <button type="submit">Buscar</button>
                </li>
            </ul>
        </div>
    </nav>

</body>
</html>
