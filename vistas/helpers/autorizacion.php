<?php

function estaLogado()
{
    return isset($_SESSION['usuario']);
}


function esMismoUsuario($idUsuario)
{
    return estaLogado() && $_SESSION['usuario'] == $idUsuario;
}

function idUsuarioLogado()
{
    return $_SESSION['usuario'] ?? false;
}

function esAdmin()
{
    return estaLogado() && $_SESSION['admin'];
}

function verificaLogado($urlNoLogado)
{
    if (! estaLogado()) {
        Utils::redirige($urlNoLogado);
    }
}
