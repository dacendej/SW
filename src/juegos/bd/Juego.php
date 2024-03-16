<?php

class Juego 
{
    use MagicProperties;

    /** @var int El ID único del juego. */
    private $id;
    /** @var string El nombre del juego. */
    private $nombreJuego;
    /** @var int El año de salida/publicacion del juego. */
    private $anioDeSalida;
    /** @var string El nombre del desarrollador del juego. */
    private $desarrollador;
    /** @var string El género del juego. */
    private $genero;
    /** @var int La nota o calificación del juego. */
    private $nota;
    /** @var string Una breve descripción del juego. */
    private $descripcion;

    /**
     * Constructor de la clase Juego.
     *
     * Inicializa una nueva instancia de la clase Juego con los datos proporcionados.
     *
     * @param int $id El ID del juego.
     * @param string $nombreJuego El nombre del juego.
     * @param int $anioDeSalida El año de salida del juego.
     * @param string $desarrollador El desarrollador del juego.
     * @param string $genero El género del juego.
     * @param int $nota La nota o calificación del juego.
     * @param string $descripcion Una breve descripción del juego.
     */
    private function __construct($nombreJuego, $anioDeSalida, $desarrollador, $genero, $nota, $descripcion) {
        $this->id = null;
        $this->nombreJuego = $nombreJuego;
        $this->anioDeSalida = $anioDeSalida;
        $this->desarrollador = $desarrollador;
        $this->genero = $genero;
        $this->nota = $nota;
        $this->descripcion = $descripcion;
    }

    public function getId() { return $this->id; }
    public function getNombreJuego() { return $this->nombreJuego; }
    public function getAnioDeSalida() { return $this->anioDeSalida; }
    public function getDesarrollador() { return $this->desarrollador; }
    public function getGenero() { return $this->genero; }
    public function getNota() { return $this->nota; }
    public function getDescripcion() { return $this->descripcion; }

    /**
     * Crea una nueva instancia de Juego y la guarda en la base de datos.
     * Si el juego es nuevo (id es null), lo inserta en las tablas de sugerencias (si no existe previamente)
     * y videojuegos. Si el juego ya existe (id no es null), lo actualiza en la tabla de videojuegos.
     * 
     * @param string $nombreJuego El nombre del juego.
     * @param int $anioDeSalida El año de salida del juego.
     * @param string $desarrollador El desarrollador del juego.
     * @param string $genero El género del juego.
     * @param int $nota La nota o calificación del juego.
     * @param string $descripcion Una breve descripción del juego.
     * @return bool True si el juego se guardó con éxito, false en caso contrario.
     */
    public static function crea($nombreJuego, $anioDeSalida, $desarrollador, $genero, $nota, $descripcion)
    {
        $juego = new Juego($nombreJuego, $anioDeSalida, $desarrollador, $genero, $nota, $descripcion);
        return $juego->guarda();
    }

    //Funciones de gestion de la BD

    /**
     * Guarda el juego en la base de datos. Determina si debe insertar un nuevo juego o actualizar uno existente.
     * 
     * @return bool True si el juego se guardó con éxito, false en caso contrario.
     */
    public function guarda() 
    {
        if ($this->id !== null) {
            return self::actualiza($this);
        }
        return self::inserta($this);
    }

    public function borrate()
    {
        if ($this->id !== null) {
            return self::borraDeVideojuegos($this->id);
        }
        return false;
    }

    /**
     * Inserta un nuevo juego en la base de datos. Verifica primero si el juego ya existe en la tabla de sugerencias
     * y lo inserta si no existe. Luego inserta el juego en la tabla de videojuegos.
     * 
     * @param Juego $juego La instancia del juego a insertar.
     * @return bool True si el juego se insertó con éxito, false en caso contrario.
     */
    private static function inserta(Juego $juego)
    {
        $conn = BD::getInstance()->getConexionBd();
        if (!$conn) {
            return false;
        }
        //Comprobar si el juego ya existe en sugerencias
        $querySugerencia = sprintf(
            "SELECT COUNT(*) AS existe FROM sugerenciasjuegos WHERE Juego = '%s'",
            $conn->real_escape_string($juego->getNombreJuego())
        );
        $resultadoSugerencia = $conn->query($querySugerencia);
        $fila = $resultadoSugerencia->fetch_assoc();
        $resultadoSugerencia->free();

        if ($fila['existe'] == 0) {
            // El juego no existe en sugerencias, insertar primero allí
            self::sugiere($juego->getNombreJuego(), $juego->getAnioDeSalida(), $juego->getDesarrollador(), $juego->getGenero(), $juego->getDescripcion());
        }

        // Insertar en Videojuegos
        $query = sprintf(
            "INSERT INTO videojuegos (Juego, `Año de salida`, Desarrollador, Genero, Nota, Descripcion) VALUES ('%s', '%s', '%s', '%s', '%f', '%s')",
            $conn->real_escape_string($juego->getNombreJuego()),
            $conn->real_escape_string($juego->getAnioDeSalida()),
            $conn->real_escape_string($juego->getDesarrollador()),
            $conn->real_escape_string($juego->getGenero()),
            $juego->getNota(),
            $conn->real_escape_string($juego->getDescripcion())
        );

        if ($conn->query($query)) {
            $juego->id = $conn->insert_id; //actualizar juego con el id generado automaticamente por la ultima insercion
            return true;
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
    }

    /**
     * Sugerir un nuevo juego insertándolo en la tabla de sugerenciasjuegos, siempre que no exista previamente.
     * 
     * @param string $nombreJuego El nombre del juego.
     * @param int $anioDeSalida El año de salida del juego.
     * @param string $desarrollador El desarrollador del juego.
     * @param string $genero El género del juego.
     * @param string $descripcion La descripción del juego.
     * @return bool True si la sugerencia se registró con éxito, false en caso contrario.
     */
    public static function sugiere($nombreJuego, $anioDeSalida, $desarrollador, $genero, $descripcion)
    {
        $conn = BD::getInstance()->getConexionBd();
        if (!$conn) {
            return false;
        }

        // Verificar si ya existe una sugerencia con el mismo nombre del juego
        $queryVerificacion = sprintf(
            "SELECT COUNT(*) AS cantidad FROM sugerenciasjuegos WHERE Juego = '%s'",
            $conn->real_escape_string($nombreJuego)
        );
        $resultadoVerificacion = $conn->query($queryVerificacion);
        $fila = $resultadoVerificacion->fetch_assoc();
        $resultadoVerificacion->free(); 
        
        if ($fila['cantidad'] > 0) {
            // Ya existe una sugerencia con este nombre, no insertar duplicados
            return false; 
        }

        $query = sprintf(
            "INSERT INTO sugerenciasjuegos (Juego, `Año de salida`, Desarrollador, Genero, Descripcion) VALUES ('%s', '%s', '%s', '%s', '%s')",
            $conn->real_escape_string($nombreJuego),
            $conn->real_escape_string($anioDeSalida),
            $conn->real_escape_string($desarrollador),
            $conn->real_escape_string($genero),
            $conn->real_escape_string($descripcion)
        );

        if ($conn->query($query)) {
            return true;
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
    }

    /**
     * Actualiza los datos de un juego existente en la base de datos en la tabla videojuegos.
     * 
     * @param Juego $juego La instancia del juego a actualizar.
     * @return bool True si el juego se actualizó con éxito, false en caso contrario.
     */
    private static function actualiza(Juego $juego)
    {
        $conn = BD::getInstance()->getConexionBd();
        if (!$conn) {
            return false;
        }

        $query = sprintf(
            "UPDATE videojuegos SET Juego='%s', `Año de salida`='%s', Desarrollador='%s', Genero='%s', Nota=%f, Descripcion='%s' WHERE ID=%d",
            $conn->real_escape_string($juego->getNombreJuego()),
            $conn->real_escape_string($juego->getAnioDeSalida()),
            $conn->real_escape_string($juego->getDesarrollador()),
            $conn->real_escape_string($juego->getGenero()),
            $juego->getNota(),
            $conn->real_escape_string($juego->getDescripcion()),
            $juego->getId()
        );

        if ($conn->query($query)) {
            return true; 
        } else {
            error_log("Error al actualizar el juego en la BD ({$conn->errno}): {$conn->error}");
            return false;
        }
    }

    /**
     * Borra un juego específico de la base de datos en la tabla videojuegos utilizando su ID único.
     * 
     * @param int $id El ID del juego a borrar.
     * @return bool True si el juego se borró con éxito, false en caso contrario.
     */

    private static function borraDeVideojuegos($id)
    {
        $conn = BD::getInstance()->getConexionBd();
        if (!$conn) {
            return false;
        }

        $query = sprintf("DELETE FROM videojuegos WHERE ID = %d", $id);

        if ($conn->query($query)) {
            return true;
        } else {
            error_log("Error al borrar el juego de videojuegos ({$conn->errno}): {$conn->error}");
            return false;
        }
    }

    /**
     * Obtiene una lista de juegos de la base de datos ordenados por su nota de mayor a menor.
     *
     * @return Juego[] Array de objetos Juego ordenados por nota.
     */
    public static function obtenerTopJuegos() {
        $conn = BD::getInstance()->getConexionBd();
        $query = "SELECT * FROM videojuegos ORDER BY Nota DESC";
        $result = $conn->query($query);
        
        $juegos = [];
        if ($result) {
            while ($fila = $result->fetch_assoc()) {
                $juegos[] = new Juego(
                    $fila['Juego'],
                    $fila['Año de salida'],
                    $fila['Desarrollador'],
                    $fila['Genero'],
                    $fila['Nota'],
                    $fila['Descripcion']
                );
            }
            $result->free();
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        
        return $juegos;
    }

    /**
     * Obtiene los juegos ordenados por año de salida de menor a mayor (ascendente).
     *
     * @return Juego[] Array de objetos Juego ordenados por año de salida ascendente.
     */
    public static function obtenerJuegosPorAnioAscendente()
    {
        $conn = BD::getInstance()->getConexionBd();
        $query = "SELECT * FROM videojuegos ORDER BY `Año de salida` ASC";
        $result = $conn->query($query);

        $juegos = [];
        if ($result) {
            while ($fila = $result->fetch_assoc()) {
                $juegos[] = new Juego(
                    $fila['Juego'],
                    $fila['Año de salida'],
                    $fila['Desarrollador'],
                    $fila['Genero'],
                    $fila['Nota'],
                    $fila['Descripcion']
                );
            }
            $result->free();
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }

        return $juegos;
    }

    /**
     * Obtiene los juegos ordenados por año de salida de mayor a menor (descendente).
     *
     * @return Juego[] Array de objetos Juego ordenados por año de salida descendente.
     */
    public static function obtenerJuegosPorAnioDescendente()
    {
        $conn = BD::getInstance()->getConexionBd();
        $query = "SELECT * FROM videojuegos ORDER BY `Año de salida` DESC";
        $result = $conn->query($query);

        $juegos = [];
        if ($result) {
            while ($fila = $result->fetch_assoc()) {
                $juegos[] = new Juego(
                    $fila['Juego'],
                    $fila['Año de salida'],
                    $fila['Desarrollador'],
                    $fila['Genero'],
                    $fila['Nota'],
                    $fila['Descripcion']
                );
            }
            $result->free();
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }

        return $juegos;
    }
    /**
     * Obtiene una lista de juegos de la base de datos ordenados por su nota de menor a mayor.
     *
     * @return Juego[] Array de objetos Juego ordenados por nota de manera ascendente.
     */
    public static function obtenerJuegosPorNotaAscendente()
    {
        $conn = BD::getInstance()->getConexionBd(); 
        if (!$conn) {
            error_log("Error al conectar a la base de datos");
            return [];
        }

        $query = "SELECT * FROM videojuegos ORDER BY Nota ASC";
        $result = $conn->query($query);

        $juegos = [];
        if ($result) {
            while ($fila = $result->fetch_assoc()) {
                $juegos[] = new Juego(
                    $fila['Juego'],
                    $fila['Año de salida'],
                    $fila['Desarrollador'],
                    $fila['Genero'],
                    $fila['Nota'],
                    $fila['Descripcion']
                );
            }
            $result->free();
        } else {
            error_log("Error al obtener juegos por nota ascendente: ({$conn->errno}): {$conn->error}");
        }

        return $juegos;
    }
}