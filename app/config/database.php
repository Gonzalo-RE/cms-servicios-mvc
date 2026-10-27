<?php
// Función ligera para cargar variables desde el archivo .env
function cargarEnv($path) {
    if (!file_exists($path)) {
        return false;
    }

    $lineas = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lineas as $linea) {
        // Ignorar comentarios
        if (strpos(trim($linea), '#') === 0) {
            continue;
        }

        list($nombre, $valor) = explode('=', $linea, 2);
        $nombre = trim($nombre);
        $valor = trim($valor);

        if (!array_key_exists($nombre, $_SERVER) && !array_key_exists($nombre, $_ENV)) {
            putenv(sprintf('%s=%s', $nombre, $valor));
            $_ENV[$nombre] = $valor;
            $_SERVER[$nombre] = $valor;
        }
    }
}

// Cargar el archivo .env desde la raíz del proyecto
cargarEnv(__DIR__ . '/../../.env');

// Obtener credenciales desde las variables de entorno
$host     = getenv('DB_HOST') ?: 'localhost';
$db       = getenv('DB_NAME') ?: 'servicios_db';
$user     = getenv('DB_USER') ?: 'root';
$pass     = getenv('DB_PASS') ?: '';
$charset  = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>