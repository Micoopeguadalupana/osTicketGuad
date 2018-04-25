<?php
$server="localhost";
$usuario="root";
$password="";
$dbname="ostprod";

$conn= new mysqli($server,$usuario,$password,$dbname);

if ($conn->connect_error) {
  die("No se ha podido conectar ".$conn->connect_error);
}



 ?>
