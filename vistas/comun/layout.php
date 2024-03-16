<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $tituloPagina ?></title>
    <link rel="stylesheet" href="css/estiloIndex.css">
    <link rel="stylesheet" href="css/estiloNavegacion.css">
</head>
<body>
    <?php
        require_once 'config.php';
        require 'vistas/comun/cabecera.php';

    ?>

<main>
	<article>
		<?= $contenidoPrincipal ?>
	</article>
</main>
</body>
</html>
