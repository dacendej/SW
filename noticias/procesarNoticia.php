<?php

require_once '../config.php';
require_once '../vistas/helpers/autorizacion.php';
require_once '../src/noticias/bd/Noticia.php';
require_once '../src/imagenes/bd/Imagen.php';

verificaLogado(Utils::buildUrl('/noticias.php'));

if (!($_SESSION['admin'] || $_SESSION['moderador'] || $_SESSION['experto'])) {
    // Si el usuario no tiene un rol permitido, redirige a noticias.php con un mensaje de error
    Utils::redirige(Utils::buildUrl('/noticias.php', ['error' => 'noAutorizado']));
    exit();
}

// Sanitizar y obtener valores de cada campo del formulario
$titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_SPECIAL_CHARS);
$fecha = filter_input(INPUT_POST, 'fecha', FILTER_SANITIZE_SPECIAL_CHARS);
$contenido = filter_input(INPUT_POST, 'contenido', FILTER_SANITIZE_SPECIAL_CHARS);

if ($titulo && idUsuarioLogado() && $fecha && $contenido) {
    $noticiaId = Noticia::crea($titulo, idUsuarioLogado(), $fecha, $contenido);
    $errorEnImagen = false;

    if ($noticiaId === false) {
        // Si la creación de la noticia falla, redirigir con error
        Utils::redirige(Utils::buildUrl('/noticias.php', ['error' => 'errorCrearNoticia']));
        exit();
    }

    // Verificar si se intentaron subir archivos
    if ($noticiaId && isset($_FILES['imagen']) && $_FILES['imagen']['name'][0] != '') {
        foreach ($_FILES['imagen']['name'] as $key => $value) {
            if ($_FILES['imagen']['error'][$key] == 0 && $_FILES['imagen']['size'][$key] > 0) {
                $file = [
                    'name' => $_FILES['imagen']['name'][$key],
                    'type' => $_FILES['imagen']['type'][$key],
                    'tmp_name' => $_FILES['imagen']['tmp_name'][$key],
                    'error' => $_FILES['imagen']['error'][$key],
                    'size' => $_FILES['imagen']['size'][$key]
                ];
                $descripcion = 'Descripción por defecto de la imagen';
                $imagenId = Imagen::crea($file, $descripcion, null, $noticiaId, null, null);

                if (!$imagenId) {
                    error_log("Error al subir la imagen para la noticia ID: " . $noticiaId);
                    $errorEnImagen = true;
                }
            } else {
                $errorEnImagen = true;
            }
        }
    }

    if ($errorEnImagen) {
        Noticia::borraNoticia($noticiaId);
        Utils::redirige(Utils::buildUrl('/noticias.php', ['error' => 'errorSubida']));
    } else {
        Utils::redirige(Utils::buildUrl('/noticias.php', ['exito' => '1']));
    }
} else {
    Utils::redirige(Utils::buildUrl('/noticias.php', ['error' => 'datosInvalidos']));
    exit();
}
