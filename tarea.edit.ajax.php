<?php

require_once 'database.php';

if( isset($_POST["nombre"]) && isset($_POST["descripcion"]) ){

    $query = Database::connect()->prepare("UPDATE tareas SET 
                                                            nombre = :nombre, descripcion = :descripcion
                                                            WHERE id = :id");

    $query->bindParam(":nombre",$_POST["nombre"],PDO::PARAM_STR);
    $query->bindParam(":descripcion",$_POST["descripcion"],PDO::PARAM_STR);
    $query->bindParam(":id",$_POST["id"],PDO::PARAM_STR);

    if($query->execute()){
        echo json_encode("ok");
    }
    else{
        echo json_encode("error");
    }
}