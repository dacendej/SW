<?php
/* */
/* Parámetros de configuración de la aplicación */
/* 
CREATE USER 'gameforum'@'%' IDENTIFIED BY 'gameforum'; GRANT USAGE ON *.* TO 'gameforum'@'%' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0; CREATE DATABASE IF NOT EXISTS `gameforum` COLLATE utf8mb4_general_ci; GRANT ALL PRIVILEGES ON `gameforum`.* TO 'gameforum'@'%';
*/

// Parámetros de configuración generales
define('RUTA_APP', '/SW');
define('RUTA_IMGS', RUTA_APP . '/img');
define('RUTA_CSS', RUTA_APP . '/css');
define('RUTA_JS', RUTA_APP . '/js');
define('INSTALADA', true);

// Parámetros de configuración de la BD
define('BD_HOST', 'localhost');
define('BD_NAME', 'gameforum');
define('BD_USER', 'gameforum');
define('BD_PASS', 'gameforum');

/* */
/* Utilidades básicas de la aplicación */
/* */

require_once 'src/Utils.php';

/* */
/* Inicialización de la aplicación */
/* */

if (!INSTALADA) {
	Utils::paginaError(502, 'Error', 'Oops', 'La aplicación no está configurada. Tienes que modificar el fichero config.php');
}

/* */
/* Configuración de Codificación y timezone */
/* */

ini_set('default_charset', 'UTF-8');
setLocale(LC_ALL, 'es_ES.UTF.8');
date_default_timezone_set('Europe/Madrid');

/* */
/* Clases y Traits de la aplicación */
/* */
require_once 'src/Arrays.php';
require_once 'src/traits/MagicProperties.php';

/*
 * Configuramos e inicializamos la sesión para todas las peticiones
 */
session_start([
	'cookie_path' => RUTA_APP, // Para evitar problemas si tenemos varias aplicaciones en htdocs
]);


/* */
/* Clases que usan una BD para almacenar el estado */
/* */
require_once 'src/BD.php';
require_once 'src/usuarios/bd/Usuario.php';
