<?php
class AttendanceModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function saveAttendance($data) {
        $sql = "INSERT INTO registro_asistencia (foto, coordenadas, asistencia) VALUES (:foto, :coordenadas, :asistencia)";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':foto', $data['foto']);
        $stmt->bindParam(':coordenadas', $data['coordenadas']);
        $stmt->bindParam(':asistencia', $data['asistencia']);

        if ($stmt->execute()) {
            return true;
        } else {
            $errorInfo = $stmt->errorInfo();
            error_log("Error al insertar datos: " . $errorInfo[2]);
            return false;
        }
    }
}
?>
