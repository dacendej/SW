<?php
require_once 'config.php';
require_once 'vistas/helpers/usuarios.php';

$tituloPagina = 'Logout';

logout();

$contenidoPrincipal=<<<EOS
	<h1>Hasta pronto!</h1>
EOS;

require 'vistas/comun/layout.php';
