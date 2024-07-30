<?php
class AttendanceController {
    private $model;
    private $apiKey;

    public function __construct($model) {
        $this->model = $model;
        $this->apiKey = 'Y%MzJA:R}:G{=Q(U;wx6T';
    }

    public function handleRequest() {
        $headers = apache_request_headers();
        error_log(print_r($headers, true)); // Log headers for debugging

        if (!isset($headers['X-Api-Key']) || $headers['X-Api-Key'] !== $this->apiKey) {
            $this->renderJSON(['status' => 'error', 'message' => 'API key incorrecta'], 403);
            return;
        }

        $input = json_decode(file_get_contents('php://input'), true);
        error_log("Datos recibidos: " . json_encode($input));

        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->renderJSON(['status' => 'error', 'message' => 'JSON mal formado'], 400);
            return;
        }

        if (!isset($input['data'])) {
            error_log("Datos no proporcionados en la solicitud");
            $this->renderJSON(['status' => 'error', 'message' => 'Datos no proporcionados'], 400);
            return;
        }

        $data = $input['data'];

        // Validación adicional de datos
        if (!$this->validateData($data)) {
            $this->renderJSON(['status' => 'error', 'message' => 'Datos inválidos'], 400);
            return;
        }

        if ($this->model->saveAttendance($data)) {
            error_log("Asistencia guardada correctamente");
            $this->renderJSON(['status' => 'success', 'message' => 'Asistencia guardada'], 200);
        } else {
            error_log("Error al guardar asistencia");
            $this->renderJSON(['status' => 'error', 'message' => 'Error al guardar asistencia'], 500);
        }
    }

    private function renderJSON($response, $statusCode = 200) {
        header('Content-Type: application/json');
        http_response_code($statusCode);
        echo json_encode($response);
    }

    private function validateData($data) {
        // Validaciones adicionales según la estructura de los datos
        if (!isset($data['foto']) || !isset($data['coordenadas']) || !isset($data['asistencia'])) {
            return false;
        }
        return true;
    }
}
?>
