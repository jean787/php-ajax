<?php

require_once 'database.php';

if($_POST["nombre"]){

    $queryLike = "%".$_POST["nombre"]."%";
    $stmt = Database::connect()->prepare("SELECT * FROM tareas WHERE nombre LIKE :nombre");

    $stmt->bindParam(":nombre",$queryLike,PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetchAll();

    echo json_encode($result);
}
