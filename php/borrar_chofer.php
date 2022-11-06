<?php
header("Content-Type: text/html;charset=utf-8");
//creamos la sesion
@session_start();
$login = $_SESSION['administrador']; 
if(!isset($_SESSION['administrador'])) {
    header("Location: ../administracion.php");
}

//Conexion con la base
include('conexion.php');

$elem = $_GET['borrar_chofer'];

mysqli_query($con, "DELETE FROM usuarios WHERE chofer='si' AND codigo ='".$elem."'");
mysqli_close($con); 

//Redireccionamiento
echo "<script> location.href=\"administracion.php?list_chofers\";</script>";

?>