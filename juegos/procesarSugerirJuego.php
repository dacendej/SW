<?php
/**
 * Para añadir juegos a la tabla sugerenciasjuegos
 */

require_once '../config.php';
require_once '../vistas/helpers/autorizacion.php';
require_once '../src/juegos/bd/Juego.php';

verificaLogado(Utils::buildUrl('/topJuegos.php'));

$titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_SPECIAL_CHARS);
$anioDeSalida = filter_input(INPUT_POST, 'anioDeSalida', FILTER_SANITIZE_NUMBER_INT);
$desarrollador = filter_input(INPUT_POST, 'desarrollador', FILTER_SANITIZE_SPECIAL_CHARS);
$genero = filter_input(INPUT_POST, 'genero', FILTER_SANITIZE_SPECIAL_CHARS);
$descripcion = filter_input(INPUT_POST, 'descripcion', FILTER_SANITIZE_SPECIAL_CHARS);

if ($titulo && $anioDeSalida && $desarrollador && $genero && $descripcion) {
    // Suponiendo que existe un método sugiere() en la clase Juego que maneja la inserción en sugerenciasjuegos
    $exito = Juego::sugiere($titulo, $anioDeSalida, $desarrollador, $genero, $descripcion);
    
    if ($exito) {
        Utils::redirige(Utils::buildUrl('/topJuegos.php', ['exitoSugerencia' => '1']));
    } else {
        Utils::redirige(Utils::buildUrl('/topJuegos.php', ['error' => 'errorSugerencia']));
    }
} else {
    Utils::redirige(Utils::buildUrl('/topJuegos.php?accion=sugerirJuego', ['errorDatos' => 'datosInvalidos']));
}