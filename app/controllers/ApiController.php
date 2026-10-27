<?php
require_once __DIR__ . '/../models/Servicio.php';

class ApiController {
    private $servicioModel;

    public function __construct($pdo) {
        $this->servicioModel = new Servicio($pdo);
    }

    // Endpoint GET: Listar todos los servicios en JSON
    public function listarServicios() {
        header("Content-Type: application/json; charset=utf-8");
        header("Access-Control-Allow-Origin: *");

        try {
            $servicios = $this->servicioModel->obtenerTodos();

            http_response_code(200);
            echo json_encode([
                "status" => "success",
                "total"  => count($servicios),
                "data"   => $servicios
            ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        } catch (\PDOException $e) {
            http_response_code(500);
            echo json_encode([
                "status"  => "error",
                "mensaje" => "Error al obtener los datos de la base de datos."
            ]);
        }
        exit;
    }

    // Endpoint GET: Obtener un servicio específico por ID en JSON
    public function detalleServicio($id) {
        header("Content-Type: application/json; charset=utf-8");
        header("Access-Control-Allow-Origin: *");

        $id = (int)$id;

        if ($id <= 0) {
            http_response_code(400);
            echo json_encode(["status" => "error", "mensaje" => "ID de servicio no válido."]);
            exit;
        }

        $servicio = $this->servicioModel->obtenerPorId($id);

        if ($servicio) {
            http_response_code(200);
            echo json_encode([
                "status" => "success",
                "data"   => $servicio
            ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        } else {
            http_response_code(404);
            echo json_encode(["status" => "error", "mensaje" => "Servicio no encontrado."]);
        }
        exit;
    }
}
?>