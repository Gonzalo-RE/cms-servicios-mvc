<?php
class Servicio {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function obtenerTodos() {
        $stmt = $this->pdo->query("SELECT * FROM servicios ORDER BY id DESC");
        return $stmt->fetchAll();
    }

    public function obtenerPorId($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM servicios WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function crear($nombre, $descripcion, $precio) {
        $stmt = $this->pdo->prepare("INSERT INTO servicios (nombre, descripcion, precio) VALUES (?, ?, ?)");
        return $stmt->execute([$nombre, $descripcion, $precio]);
    }

    public function actualizar($id, $nombre, $descripcion, $precio) {
        $stmt = $this->pdo->prepare("UPDATE servicios SET nombre = ?, descripcion = ?, precio = ? WHERE id = ?");
        return $stmt->execute([$nombre, $descripcion, $precio, $id]);
    }

    public function eliminar($id) {
        $stmt = $this->pdo->prepare("DELETE FROM servicios WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>