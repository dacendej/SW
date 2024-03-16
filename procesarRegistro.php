<?php

require_once 'config.php';
require_once 'vistas/helpers/usuarios.php';
require_once 'vistas/helpers/autorizacion.php';
require_once 'vistas/helpers/registro.php';

$tituloPagina = 'Registro';

// Obtener datos del formulario de registro
$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
$password = $_POST["password"] ?? null;
$nombreCompleto = filter_input(INPUT_POST, 'nombreCompleto', FILTER_SANITIZE_SPECIAL_CHARS);
$edad = filter_input(INPUT_POST, 'edad', FILTER_VALIDATE_INT);
$correo = filter_input(INPUT_POST, 'correo', FILTER_VALIDATE_EMAIL);

// Validar los datos del formulario
$esValido = $username && $password && $nombreCompleto && $edad && $correo;

if (!$esValido) {
    $htmlFormRegistro = buildFormularioRegistro($username, $password, $nombreCompleto, $edad, $correo);
    $contenidoPrincipal=<<<EOS
        <h1>Error</h1>
        <p>Por favor, completa todos los campos correctamente.</p>
        $htmlFormRegistro
    EOS;
    require 'vistas/comun/layout.php';
    exit();
}

// Intentar realizar el registro
$resultadoRegistro = Usuario::crea($username, $password, $nombreCompleto, $edad, $correo, 0, 0, 0);

if (!$resultadoRegistro) {
    $htmlFormRegistro = buildFormularioRegistro($username, $password, $nombreCompleto, $edad, $correo);
    $contenidoPrincipal=<<<EOS
        <h1>Error</h1>
        <p>No se pudo completar el registro. Por favor, inténtalo de nuevo.</p>
        $htmlFormRegistro
    EOS;
    require 'vistas/comun/layout.php';
    exit();
}
$usuario = Usuario::login($username, $password);
$_SESSION['usuario'] = $usuario->nombreUsuario;
$_SESSION['usuarioNombre'] = $usuario->nombreCompleto;
$_SESSION['edad'] = $usuario->edad;
$_SESSION['experto'] = $usuario->experto;
$_SESSION['correo'] = $usuario->correo;
$_SESSION['admin'] = $usuario->admin;
$_SESSION['moderador'] = $usuario->moderador;

//DEBUG {
$rolesUsuario = '';
if ($_SESSION['admin']) {
    $rolesUsuario .= 'Administrador, ';
}
if ($_SESSION['moderador']) {
    $rolesUsuario .= 'Moderador, ';
}
if (!$_SESSION['admin'] && !$_SESSION['moderador']) { // Suponiendo que todos son al menos 'Usuario' si no son admin o moderador
    $rolesUsuario .= 'Usuario, ';
}
$rolesUsuario = rtrim($rolesUsuario, ', ');

$datosUsuario = <<<HTML
<ul>
    <li>Nombre de usuario: {$_SESSION['usuario']}</li>
    <li>Nombre completo: {$_SESSION['usuarioNombre']}</li>
    <li>Edad: {$_SESSION['edad']}</li>
    <li>Experto: {$_SESSION['experto']}</li>
    <li>Correo electrónico: {$_SESSION['correo']}</li>
    <li>Rol: $rolesUsuario</li>
</ul>
HTML;	
//}
$contenidoPrincipal=<<<EOS
	<h1>Bienvenido {$_SESSION['usuario']}</h1>
	<p>Datos:</p>
	$datosUsuario
	<p>Usa el menú de la izquierda para navegar.</p>
EOS;

require 'vistas/comun/layout.php';
