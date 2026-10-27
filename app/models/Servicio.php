<?php
class Servicio {
    private $pdo;

    public function __construct($pdoConnection) {
        $this->pdo = $pdoConnection;
    }

    // 1. Obtener todos los servicios (READ)
    public function obtenerTodos() {
        $stmt = $this->pdo->query("SELECT * FROM servicios ORDER BY id ASC");
        return $stmt->fetchAll();
    }

    // 2. Obtener un servicio por su ID (READ)
    public function obtenerPorId($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM servicios WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // 3. Crear un nuevo servicio (CREATE)
    public function crear($nombre, $descripcion, $precio) {
        $stmt = $this->pdo->prepare("INSERT INTO servicios (nombre, descripcion, precio) VALUES (?, ?, ?)");
        return $stmt->execute([$nombre, $descripcion, $precio]);
    }

    // 4. Actualizar un servicio existente (UPDATE)
    public function actualizar($id, $nombre, $descripcion, $precio) {
        $stmt = $this->pdo->prepare("UPDATE servicios SET nombre = ?, descripcion = ?, precio = ? WHERE id = ?");
        return $stmt->execute([$nombre, $descripcion, $precio, $id]);
    }

    // 5. Eliminar un servicio (DELETE)
    public function eliminar($id) {
        $stmt = $this->pdo->prepare("DELETE FROM servicios WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>