<?php

require_once 'database.php';


if( isset($_POST["nombre"]) && isset($_POST["descripcion"]) ){

    $query = Database::connect()->prepare("INSERT INTO tareas(nombre, descripcion)
                                                    VALUES (:nombre, :descripcion)");

    $query->bindParam(":nombre",$_POST["nombre"],PDO::PARAM_STR);
    $query->bindParam(":descripcion",$_POST["descripcion"],PDO::PARAM_STR);

    if($query->execute()){
        echo "<script>console.log(`n: ${_POST['nombre']}, d: ${_POST['descripcion']}`)</script>";
    }
}