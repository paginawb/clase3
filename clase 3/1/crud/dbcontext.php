<?php
function conectar(){
    $host = "127.0.0.1";
    $user = "root";
    $pass = "angelgamers13";
    $db = "iceppracticas";
    // Hacemos la conexión
    $conn = new mysqli($host, $user, $pass, $db);
    // Validamos la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
    return $conn;
}
?>
