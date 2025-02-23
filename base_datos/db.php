<?php

// $servername = "arielon23.duckdns.org:3306"; 
// $username = "ismael";        
// $password = "isma2025";     
// $dbname = "pruebas_marquez2"; 


$servername = "localhost"; 
$username = "root";        
$password = "";     
$dbname = "bar_de_mou"; 


$conn = new mysqli($servername, $username, $password, $dbname);
//echo"conectado";

if ($conn->connect_error) { 
    die("Conexión fallida: " . $conn->connect_error); 
}

date_default_timezone_set('America/Argentina/Buenos_Aires'); 
$fecha_hora_actual = date('Y-m-d H:i:s'); 
?>      




