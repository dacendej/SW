<?php
require_once 'autorizacion.php';

function saludo()
{
    $html = '';

    if (estaLogado()) {
        $urlLogout = Utils::buildUrl('/logout.php');
        $html = <<<EOS
        Bienvenido, {$_SESSION['usuarioNombre']} <a href="{$urlLogout}">(salir)</a>
        EOS;
    } else {
        $urlLogin = Utils::buildUrl('/login.php');
        $html = <<<EOS
        Usuario desconocido. <a href="{$urlLogin}">Login</a>
        EOS;
    }

    return $html;
}

function logout()
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    //Doble seguridad: unset + destroy
    unset($_SESSION['usuario']);
    unset($_SESSION['usuarioNombre']);
    unset($_SESSION['edad']);
    unset($_SESSION['experto']);
    unset($_SESSION['correo']);
    unset($_SESSION['admin']);
    unset($_SESSION['moderador']);

    session_destroy();
    session_start();
}
