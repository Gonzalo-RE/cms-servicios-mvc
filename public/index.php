<?php
session_start();

// 1. Cargar configuraciones
require_once __DIR__ . '/../app/config/database.php';
require_once __DIR__ . '/../app/config/security.php';

// 2. Cargar controladores
require_once __DIR__ . '/../app/controllers/ServicioController.php';
require_once __DIR__ . '/../app/controllers/ApiController.php';

// 3. Capturar acción solicitada desde la URL
$action = $_GET['action'] ?? 'index';

// 4. Instanciar controladores con la conexión PDO
$controller = new ServicioController($pdo);
$apiController = new ApiController($pdo);

// 5. Tabla de enrutamiento
switch ($action) {
    // Endpoints públicos de la API RESTful (JSON)
    case 'api_servicios':
        $apiController->listarServicios();
        break;

    case 'api_servicio':
        $id = $_GET['id'] ?? 0;
        $apiController->detalleServicio($id);
        break;

    // Rutas de Autenticación
    case 'login':
        require_once __DIR__ . '/../app/views/auth/login.php';
        break;

    case 'logout':
        session_unset();
        session_destroy();
        header("Location: index.php?action=login");
        exit;

    // Rutas del Panel de Administración (Protegidas)
    case 'crear':
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: index.php?action=login");
            exit;
        }
        $controller->crear();
        break;

    case 'editar':
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: index.php?action=login");
            exit;
        }
        $controller->editar();
        break;

    case 'eliminar':
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: index.php?action=login");
            exit;
        }
        $controller->eliminar();
        break;

    case 'index':
    default:
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: index.php?action=login");
            exit;
        }
        $controller->index();
        break;
}
?>