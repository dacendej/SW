<?php

require_once 'config.php';
require_once 'vistas/helpers/publicaciones.php';
require_once 'vistas/helpers/respuestas.php';

$mensaje = '';
$contenidoPrincipal = '';
$tituloPagina = 'Detalles de la publicación';

// Sanitizar el valor de 'accion'
$accion = filter_input(INPUT_POST, 'accion', FILTER_SANITIZE_SPECIAL_CHARS);

if (!$accion) {
    if (isset($_POST['id'])) {
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        if ($id) {
            $detallesPublicacion = mostrarDetallesPublicacion($id);
            if ($detallesPublicacion) {
                $contenidoPrincipal .= $detallesPublicacion;
                if (estaLogado()) {
                    $contenidoPrincipal .= mostrarBotonAgregarRespuesta($id);
                }
                $contenidoPrincipal .= "<div class='publicacion-respuestas'><h2>Respuestas:</h2></div>";
                $contenidoPrincipal .= listaRespuestas($id);
            } else {
                $mensaje = "La publicación solicitada no fue encontrada.";
            }

        } else {
            $mensaje = "Identificador de publicación inválido.";
        }
    } else {
        $mensaje = "No se proporcionó un identificador de publicación.";
    }
} elseif ($accion === 'agregarRespuesta' && isset($_POST['id'])) {
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $contenidoPrincipal .= buildFormularioRespuesta($id);
}

$contenidoPrincipal .= $mensaje;

require 'vistas/comun/layout.php';
