<?php

require_once 'config.php';
require_once 'vistas/helpers/juegos.php';
require_once 'src/juegos/bd/Juego.php';

$tituloPagina = 'Top Juegos';
$mensaje = ''; // Mensaje que se mostrará al usuario

$contenidoPrincipal = '';

//Verificar mensajesde éxito al añadir juegos
if (isset($_GET['exito'])) {
    $mensaje = '<div class="alerta exito">El juego ha sido añadido con éxito.</div>';
}

// Verificar mensajes de éxito de sugerencias
if (isset($_GET['exitoSugerencia'])) {
    $mensaje = '<div class="alerta exito">La sugerencia del juego ha sido enviada con éxito.</div>';
}

// Verificar si hay mensaje de error
if (isset($_GET['error'])) {
    switch ($_GET['error']) {
        case 'noAutorizado':
            $mensaje = '<div class="alerta error">No tienes autorización para realizar esta acción.</div>';
            break;
        case 'datosInvalidos':
            $mensaje = '<div class="alerta error">Los datos proporcionados son inválidos. Comprueba el formulario y los archivos subidos</div>';
            break;
        case 'errorSubida':
            $mensaje = '<div class="alerta error">Error al subir la(s) imagen(es). Intentalo de nuevo.</div>';
            break;
        case 'errorSugerencia':
            $mensaje = '<div class="alerta error">Hubo un error al enviar la sugerencia del juego. Es posible que el juego ya exista o que el juego ya haya sido sugerido anteriormente.</div>';
            break;
        case 'juegoDuplicado':
            $mensaje = '<div class="alerta error">Ya existe un juego con ese nombre. Por favor, elige otro nombre.</div>';
            break;
        default:
            break;
    }
}


// Verificar si no hay formulario activo ni mensaje de error
if (empty($mensaje) && !isset($_GET['accion'])) {
    $orden = isset($_GET['orden']) ? $_GET['orden'] : 'notaDesc';
    // Si no hay formulario activo ni mensaje de error, mostrar los juegos
    // Menú de ordenación
    $contenidoPrincipal .=
        '</div> <h1>MEJORES JUEGOS:</h1>
    <div class="menu-ordenacion">
    <div>Ordenar por:  <a href="?orden=notaAsc">Nota Ascendente</a> |
    <a href="?orden=notaDesc">Nota Descendente</a> |
    <a href="?orden=anioAsc">Año Ascendente</a> |
    <a href="?orden=anioDesc">Año Descendente</a>
    </div>';
    $contenidoPrincipal .= listaJuegos($orden); // Modificada para aceptar el parámetro de orden
}

//Formularios para agregar/sugerir juegos
if (isset($_GET['accion']) && $_GET['accion'] === 'agregarJuego') {
    $contenidoPrincipal .= buildFormularioAgregarJuego();
} elseif (isset($_GET['accion']) && $_GET['accion'] === 'sugerirJuego') {
    $contenidoPrincipal .= buildFormularioSugerirJuego();
}

// Agregar mensaje a contenido principal
$contenidoPrincipal .= $mensaje;

require 'vistas/comun/layout.php';
