<?php
session_start();

// 1. Cargar configuraciones globales de BD y Seguridad
require_once __DIR__ . '/../app/config/database.php';
require_once __DIR__ . '/../app/config/security.php';

// 2. Cargar controladores
require_once __DIR__ . '/../app/controllers/ServicioController.php';
require_once __DIR__ . '/../app/controllers/ApiController.php';

// 3. Capturar la acción solicitada desde la URL
$action = $_GET['action'] ?? 'index';

$controller = new ServicioController($pdo);
$apiController = new ApiController($pdo);

// 4. Enrutador centralizado
switch ($action) {
    // Endpoints públicos de la API RESTful (Respuestas JSON)
    case 'api_servicios':
        $apiController->listarServicios();
        break;
    case 'api_servicio':
        $id = $_GET['id'] ?? 0;
        $apiController->detalleServicio($id);
        break;

    // Rutas protegidas del Panel de Administración
    case 'crear':
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: ../app/views/auth/login.php");
            exit;
        }
        $controller->crear();
        break;
    case 'editar':
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: ../app/views/auth/login.php");
            exit;
        }
        $controller->editar();
        break;
    case 'eliminar':
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: ../app/views/auth/login.php");
            exit;
        }
        $controller->eliminar();
        break;
    case 'index':
    default:
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: ../app/views/auth/login.php");
            exit;
        }
        $controller->index();
        break;
}
?>