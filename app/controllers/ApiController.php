<?php
require_once __DIR__ . '/../models/Servicio.php';

class ApiController {
    private $servicioModel;

    public function __construct($pdo) {
        $this->servicioModel = new Servicio($pdo);
    }

    private function setHeaders() {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
        header("Content-Type: application/json; charset=utf-8");
    }

    public function listarServicios() {
        $this->setHeaders();
        try {
            $servicios = $this->servicioModel->obtenerTodos();
            echo json_encode([
                'status' => 'success',
                'total'  => count($servicios),
                'data'   => $servicios
            ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'status'  => 'error',
                'message' => 'Error en el servidor al obtener servicios'
            ]);
        }
        exit;
    }

    public function detalleServicio($id) {
        $this->setHeaders();
        $id = (int)$id;
        if ($id <= 0) {
            http_response_code(400);
            echo json_encode([
                'status'  => 'error',
                'message' => 'ID de servicio no válido'
            ]);
            exit;
        }

        try {
            $servicio = $this->servicioModel->obtenerPorId($id);
            if ($servicio) {
                echo json_encode([
                    'status' => 'success',
                    'data'   => $servicio
                ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            } else {
                http_response_code(404);
                echo json_encode([
                    'status'  => 'error',
                    'message' => 'Servicio no encontrado'
                ]);
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'status'  => 'error',
                'message' => 'Error interno en el servidor'
            ]);
        }
        exit;
    }
}
?>