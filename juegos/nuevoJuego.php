<?php
/**
 * Para crear y añadir nuevos juegos en la BD
 */

require_once '../config.php';
require_once '../vistas/helpers/autorizacion.php';
require_once '../src/juegos/bd/Juego.php';

verificaLogado(Utils::buildUrl('/topJuegos.php'));

if (!($_SESSION['admin'] || $_SESSION['moderador'] || $_SESSION['experto'])) {
    // Si el usuario no tiene un rol permitido, redirige a topJuegos.php con un mensaje de error
    Utils::redirige(Utils::buildUrl('/topJuegos.php', ['error' => 'noAutorizado']));
    exit();
}

//Validar datos recibidos:
$titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_SPECIAL_CHARS);
$anioDeSalida = filter_input(INPUT_POST, 'anioDeSalida', FILTER_SANITIZE_NUMBER_INT);
$desarrollador = filter_input(INPUT_POST, 'desarrollador', FILTER_SANITIZE_SPECIAL_CHARS);
$genero = filter_input(INPUT_POST, 'genero', FILTER_SANITIZE_SPECIAL_CHARS);
$nota = filter_input(INPUT_POST, 'nota', FILTER_VALIDATE_FLOAT);
$descripcion = filter_input(INPUT_POST, 'descripcion', FILTER_SANITIZE_SPECIAL_CHARS);

// Crear y guardar el juego si todos los datos son válidos
if ($titulo && $anioDeSalida && $desarrollador && $genero && $nota !== false && $descripcion) {
    $juego = Juego::crea($titulo, $anioDeSalida, $desarrollador, $genero, $nota, $descripcion);
    
    if ($juego) {
        // Redirigir a topJuegos con un mensaje de éxito
        Utils::redirige(Utils::buildUrl('/topJuegos.php', ['exito' => '1']));
    } else {
        // Redirigir a topJuegos con un mensaje de error
        Utils::redirige(Utils::buildUrl('/topJuegos.php', ['error' => '1']));
    }
} else {
    // Redirigir de nuevo al formulario con un mensaje de error
    Utils::redirige(Utils::buildUrl('/topJuegos.php?accion=agregarJuego', ['error' => 'datosInvalidos']));
}