<?php
require_once 'config.php';
require_once 'vistas/helpers/login.php';


$tituloPagina = 'Login';

$htmlFormLogin = buildFormularioLogin();

$contenidoPrincipal=<<<EOS
<h1>Acceso al sistema</h1>
$htmlFormLogin
<legend>No tienes cuenta? <a href="registrarse.php">Regístrate</a></legend>
EOS;

require_once 'vistas/comun/layout.php';
