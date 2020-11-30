<?php

class Database{

    static public function connect(){
        $db = new PDO('mysql:host=localhost;dbname=tareas','root','12345678');
        $db->exec("SET CHARACTER SET utf8;");
        return $db;
    }

}

