<?php
require_once 'config.php';
require_once 'vistas/helpers/registro.php';


$tituloPagina = 'Registro';

$htmlFormRegistro = buildFormularioRegistro();

$contenidoPrincipal=<<<EOS
<h1>Registro en el sistema</h1>
$htmlFormRegistro
EOS;

require_once 'vistas/comun/layout.php';
