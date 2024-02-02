<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
// Definimos las variables de conexión
$host = "localhost";
$port = 3306;
$database = "octopi";
$username = "root";
$password = "*123456*";

// Creamos la conexión
$db = new PDO("mysql:host=$host;port=$port;dbname=$database", $username, $password);

// Verificamos la conexión
if ($db === false) {
  die("Error al conectar a la base de datos");
}

// Mostramos el mensaje de éxito
return "Conexión a la base de datos exitosa";


?>