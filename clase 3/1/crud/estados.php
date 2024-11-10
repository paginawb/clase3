<?php
header('Content-Type: application/json');
include "dbcontext.php";

$con = conectar();

if (isset($_POST['lista']) && $_POST['lista'] == "todos") {
    $sql = "SELECT * FROM estados";
    $rs = $con->query($sql);
    $estados = [];
    while ($row = $rs->fetch_assoc()) {
        $estados[] = $row;
    }
    echo json_encode($estados);
    exit();
}

if (isset($_POST['ADD']) && $_POST['ADD'] == "estado") {
    $nombreEstado = $_POST['nombre'];
    try {
        $sql = "INSERT INTO estados(nombre) VALUES(?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("s", $nombreEstado);
        $stmt->execute();
        echo json_encode(['estado' => 'Estado agregado exitosamente']);
    } catch (Exception $e) {
        echo json_encode(['estado' => 'Error en la consulta MySQL']);
    }
    exit();
}

if (isset($_POST['DELETE']) && $_POST['DELETE'] == "estado") {
    $nombreEstado = $_POST['nombre'];
    try {
        $sql = "DELETE FROM estados WHERE nombre = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("s", $nombreEstado);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo json_encode(['estado' => 'Estado eliminado exitosamente']);
        } else {
            echo json_encode(['estado' => 'Estado no encontrado']);
        }
    } catch (Exception $e) {
        echo json_encode(['estado' => 'Error en la eliminación del estado']);
    }
    exit();
}

if (isset($_POST['UPDATE']) && $_POST['UPDATE'] == "estado") {
    $nombreEstado = $_POST['nombre'];
    $idEstado = $_POST['idEstado'];
    try {
        $sql = "UPDATE estados SET nombre = ? WHERE idestado = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("si", $nombreEstado, $idEstado);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo json_encode(['estado' => 'Estado actualizado exitosamente']);
        } else {
            echo json_encode(['estado' => 'Estado no encontrado']);
        }
    } catch (Exception $e) {
        echo json_encode(['estado' => 'Error en la actualización']);
    }
    exit();
}
?>


