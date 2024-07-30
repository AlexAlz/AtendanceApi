<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'models/Connection.php';
require_once 'models/AttendanceModel.php';
require_once 'controllers/AttendanceController.php';

/*===================================
   CORS
  ===================================*/

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
// Conectar a la base de datos
$database = new Connection();
$db = $database->connect();

// Crear una instancia del modelo
$model = new AttendanceModel($db);

// Crear una instancia del controlador pasando el modelo
$controller = new AttendanceController($model);

// Manejar la solicitud
$controller->handleRequest();
?>
