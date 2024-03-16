<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/juegos.css">
</head>
<body>

    <?php
    /**
     * Este archivo contiene funciones auxiliares relacionadas con la gestión y presentación de juegos.
     * Incluye funcionalidades para mostrar botones de interacción según el rol del usuario.
     */
    require_once 'autorizacion.php';

    /**
     * Muestra un botón para añadir o sugerir juegos basado en el rol del usuario.
     *
     * Determina si el usuario logueado tiene un rol que le permite añadir juegos directamente
     * (como administrador, moderador o experto) o si simplemente puede sugerir juegos (como un usuario regular).
     * Dependiendo del rol del usuario, devuelve el HTML correspondiente para mostrar el botón adecuado.
     *
     * @return string El HTML del botón para añadir o sugerir juegos. Si el usuario no está logueado,
     *                retorna una cadena vacía, no mostrando ningún botón.
     */
    function mostrarBotonAgregarJuego() {
        if (estaLogado()) {
            if ($_SESSION['admin'] || $_SESSION['moderador'] || $_SESSION['experto']) {
                // acción como parámetro GET para agregar juego
                return '<a href="topJuegos.php?accion=agregarJuego" class="button">Añadir Juego</a>';
            } else {
                return '<a href="topJuegos.php?accion=sugerirJuego" class="button">Sugerir Juego</a>';
            }
        }
        return '';
    }

     function buildFormularioAgregarJuego() {
        return <<<HTML
        <form class="formulario" action="juegos/nuevoJuego.php" method="post">
            <label for="titulo">Título del juego:</label>
            <input type="text" id="titulo" name="titulo" required>
            
            <label for="anioDeSalida">Año de Salida:</label>
            <input type="number" id="anioDeSalida" name="anioDeSalida" required>
            
            <label for="desarrollador">Desarrollador:</label>
            <input type="text" id="desarrollador" name="desarrollador" required>
            
            <label for="genero">Género:</label>
            <input type="text" id="genero" name="genero" required>
            
            <label for="nota">Nota:</label>
            <input type="number" step="0.1" id="nota" name="nota" required>
            
            <label for="descripcion">Descripción del juego:</label>
            <textarea id="descripcion" name="descripcion" required></textarea>
            
            <input type="submit" value="Añadir videojuego">
        </form>
        HTML;
    }

    function buildFormularioSugerirJuego() {
        return <<<HTML
        <form action="juegos/procesarSugerirJuego.php" method="post">
            <label for="titulo">Título del juego:</label>
            <input type="text" id="titulo" name="titulo" required>
            
            <label for="anioDeSalida">Año de Salida:</label>
            <input type="number" id="anioDeSalida" name="anioDeSalida" required>
            
            <label for="desarrollador">Desarrollador:</label>
            <input type="text" id="desarrollador" name="desarrollador" required>
            
            <label for="genero">Género:</label>
            <input type="text" id="genero" name="genero" required>
            
            <label for="descripcion">Descripción del juego:</label>
            <textarea id="descripcion" name="descripcion" required></textarea>
            
            <input type="submit" value="Sugerir videojuego">
        </form>
        HTML;
    }

    function listaJuegos($orden = 'notaDesc') {
        switch ($orden) {
            case 'notaAsc':
                $juegos = Juego::obtenerJuegosPorNotaAscendente();
                break;
            case 'anioAsc':
                $juegos = Juego::obtenerJuegosPorAnioAscendente();
                break;
            case 'anioDesc':
                $juegos = Juego::obtenerJuegosPorAnioDescendente();
                break;
            default: // 'notaDesc'
                $juegos = Juego::obtenerTopJuegos();
                break;
        }

        $listaHtml = '<div class="lista-juegos">';
        $posicion = 1;
        foreach ($juegos as $juego) {
            $nombreYAnio = htmlspecialchars($juego->getNombreJuego()) . ' (' . htmlspecialchars($juego->getAnioDeSalida()) . ')';
            $listaHtml .= "<div class=\"juego\">
            <div class=\"posicion-juego\">Top $posicion</div>
            <div class=\"nombre-juego\">$nombreYAnio</div>
            <div class=\"nota-juego\">{$juego->getNota()}</div>
        </div>";
            $posicion++;
        }
        $listaHtml .= '</div>';
        return $listaHtml;
    }
    ?>

</body>
</html>
