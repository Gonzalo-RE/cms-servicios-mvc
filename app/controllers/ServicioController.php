<?php
require_once __DIR__ . '/../models/Servicio.php';

class ServicioController {
    private $servicioModel;

    public function __construct($pdo) {
        $this->servicioModel = new Servicio($pdo);
    }

    public function index() {
        $servicios = $this->servicioModel->obtenerTodos();
        $tituloPagina = 'Panel de Servicios | Apple Minimalist';
        require_once __DIR__ . '/../views/templates/header.php';
        require_once __DIR__ . '/../views/servicios/index.php';
        require_once __DIR__ . '/../views/templates/footer.php';
    }

    public function crear() {
        if (($_SESSION['usuario_rol'] ?? '') !== 'admin') {
            die("❌ Acceso Denegado: No tienes permisos para crear servicios.");
        }

        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!verificarCSRFToken($_POST['csrf_token'] ?? '')) {
                die("❌ Error de seguridad: Token CSRF inválido.");
            }

            $nombre = trim($_POST['nombre'] ?? '');
            $descripcion = trim($_POST['descripcion'] ?? '');
            $precio = (float)($_POST['precio'] ?? 0);

            if (!empty($nombre) && !empty($descripcion) && $precio > 0) {
                $this->servicioModel->crear($nombre, $descripcion, $precio);
                header("Location: index.php?action=index");
                exit;
            } else {
                $error = "⚠️ Por favor completa todos los campos correctamente.";
            }
        }

        $tituloPagina = 'Crear Servicio';
        require_once __DIR__ . '/../views/templates/header.php';
        require_once __DIR__ . '/../views/servicios/crear.php';
        require_once __DIR__ . '/../views/templates/footer.php';
    }

    public function editar() {
        if (($_SESSION['usuario_rol'] ?? '') !== 'admin') {
            die("❌ Acceso Denegado: No tienes permisos para editar servicios.");
        }

        $id = (int)($_GET['id'] ?? 0);
        $servicio = $this->servicioModel->obtenerPorId($id);

        if (!$servicio) {
            header("Location: index.php?action=index");
            exit;
        }

        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!verificarCSRFToken($_POST['csrf_token'] ?? '')) {
                die("❌ Error de seguridad: Token CSRF inválido.");
            }

            $nombre = trim($_POST['nombre'] ?? '');
            $descripcion = trim($_POST['descripcion'] ?? '');
            $precio = (float)($_POST['precio'] ?? 0);

            if (!empty($nombre) && !empty($descripcion) && $precio > 0) {
                $this->servicioModel->actualizar($id, $nombre, $descripcion, $precio);
                header("Location: index.php?action=index");
                exit;
            } else {
                $error = "⚠️ Todos los campos son obligatorios.";
            }
        }

        $tituloPagina = 'Editar Servicio';
        require_once __DIR__ . '/../views/templates/header.php';
        require_once __DIR__ . '/../views/servicios/editar.php';
        require_once __DIR__ . '/../views/templates/footer.php';
    }

    public function eliminar() {
        if (($_SESSION['usuario_rol'] ?? '') !== 'admin') {
            die("❌ Acceso Denegado: No tienes permisos para eliminar servicios.");
        }

        $id = (int)($_GET['id'] ?? 0);
        if ($id > 0) {
            $this->servicioModel->eliminar($id);
        }
        header("Location: index.php?action=index");
        exit;
    }
}
?>