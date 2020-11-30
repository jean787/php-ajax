<?php

require_once 'database.php';

if($_POST["id"]){
    $stmt = Database::connect()->prepare("SELECT * FROM tareas WHERE id = :id");
    $stmt->bindParam(":id",$_POST["id"]);
    $stmt->execute();
    $resultado = $stmt->fetch();
    echo json_encode($resultado);
}