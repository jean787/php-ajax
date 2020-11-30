<?php

require_once 'database.php';

if($_POST["id"]){

    $stmt = Database::connect()->prepare("DELETE FROM tareas WHERE id = :id");
    $stmt->bindParam(":id",$_POST["id"]);


    if($stmt->execute()){
        echo json_encode("ok");
    }
    else{
        echo json_encode("false");
    }


}