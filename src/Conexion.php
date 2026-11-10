<?php


 function conectar(){

$host="";
$user="root";
$password="";

try{

$conexion= new SQLite3("../BD/Anime.bd");

return $conexion;
} catch (Exception $e){
    echo $e->getMessage();
}

}


?>
