<?php
require_once 'database.php';

 $stmt = Database::connect()->prepare("SELECT * FROM tareas");
 $stmt->execute();
 $result = $stmt->fetchAll();
 echo json_encode($result);