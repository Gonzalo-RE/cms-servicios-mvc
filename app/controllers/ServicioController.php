<?php
require_once __DIR__ . '/../models/Servicio.php';

class ServicioController {
    private $servicioModel;

    public function __construct($pdo) {
        $this->servicioModel = new Servicio($pdo);
    }

    // Verificar si el usuario autenticado tiene rol de Administrador (RBAC)
    private function esAdmin() {
        return isset($_SESSION['usuario_rol']) && $_SESSION['usuario_rol'] === 'admin';
    }

    // 1. Mostrar la lista general de servicios
    public function index() {
        $servicios = $this->servicioModel->obtenerTodos();
        require_once __DIR__ . '/../views/servicios/index.php';
    }

    // 2. Crear servicio (Solo Admin + Protección CSRF)
    public function crear() {
        if (!$this->esAdmin()) {
            header("Location: index.php?action=index");
            exit;
        }

        $mensaje = "";
        $tipoMensaje = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST['csrf_token'] ?? '';
            if (!verificarCSRFToken($token)) {
                die("❌ Error de seguridad: Petición no autorizada (CSRF Token inválido).");
            }

            $nombre = trim($_POST['nombre'] ?? '');
            $descripcion = trim($_POST['descripcion'] ?? '');
            $precio = (float)($_POST['precio'] ?? 0);

            if (!empty($nombre) && !empty($descripcion) && $precio > 0) {
                if ($this->servicioModel->crear($nombre, $descripcion, $precio)) {
                    $mensaje = "✅ Servicio registrado correctamente.";
                    $tipoMensaje = "exito";
                } else {
                    $mensaje = "❌ Error al guardar el servicio.";
                    $tipoMensaje = "error";
                }
            } else {
                $mensaje = "⚠️ Por favor, llena todos los campos correctamente.";
                $tipoMensaje = "error";
            }
        }

        require_once __DIR__ . '/../views/servicios/crear.php';
    }

    // 3. Editar servicio (Solo Admin + Protección CSRF)
    public function editar() {
        if (!$this->esAdmin()) {
            header("Location: index.php?action=index");
            exit;
        }

        $id = (int)($_GET['id'] ?? $_POST['id'] ?? 0);

        if ($id <= 0) {
            header("Location: index.php?action=index");
            exit;
        }

        $mensaje = "";
        $tipoMensaje = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST['csrf_token'] ?? '';
            if (!verificarCSRFToken($token)) {
                die("❌ Error de seguridad: Petición no autorizada (CSRF Token inválido).");
            }

            $nombre = trim($_POST['nombre'] ?? '');
            $descripcion = trim($_POST['descripcion'] ?? '');
            $precio = (float)($_POST['precio'] ?? 0);

            if (!empty($nombre) && !empty($descripcion) && $precio > 0) {
                if ($this->servicioModel->actualizar($id, $nombre, $descripcion, $precio)) {
                    $mensaje = "✅ Servicio actualizado correctamente.";
                    $tipoMensaje = "exito";
                } else {
                    $mensaje = "❌ Error al actualizar el servicio.";
                    $tipoMensaje = "error";
                }
            } else {
                $mensaje = "⚠️ Por favor, llena todos los campos correctamente.";
                $tipoMensaje = "error";
            }
        }

        $servicio = $this->servicioModel->obtenerPorId($id);
        if (!$servicio) {
            header("Location: index.php?action=index");
            exit;
        }

        require_once __DIR__ . '/../views/servicios/editar.php';
    }

    // 4. Eliminar servicio (Solo Admin)
    public function eliminar() {
        if (!$this->esAdmin()) {
            header("Location: index.php?action=index");
            exit;
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