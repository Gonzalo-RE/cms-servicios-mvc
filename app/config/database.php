<?php
// Carga manual de variables de entorno (compatible con hostings que bloquean putenv)
function cargarEnv($path) {
    if (!file_exists($path)) {
        return false;
    }

    $lineas = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lineas as $linea) {
        $lineaTrim = trim($linea);
        if (strpos($lineaTrim, '#') === 0 || empty($lineaTrim)) continue;
        if (strpos($linea, '=') === false) continue;

        list($nombre, $valor) = explode('=', $linea, 2);
        $_ENV[trim($nombre)] = trim($valor);
        $_SERVER[trim($nombre)] = trim($valor);
    }
}

// Cargar .env desde la raíz del proyecto
cargarEnv(__DIR__ . '/../../.env');

$host    = $_ENV['DB_HOST'] ?? 'localhost';
$db      = $_ENV['DB_NAME'] ?? 'servicios_db';
$user    = $_ENV['DB_USER'] ?? 'root';
$pass    = $_ENV['DB_PASS'] ?? '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("❌ Error de conexión a la Base de Datos: " . $e->getMessage());
}
?>