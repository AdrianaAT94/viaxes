<?php
header("Content-Type: text/html;charset=utf-8");
//creamos la sesion
@session_start();
$login = $_SESSION['administrador']; 
if(!isset($_SESSION['administrador'])) {
    header("Location: ../administracion.php");
}

//Conexion con la base
include('conexion.php'); ?>
<div class="l_chofers">	
	<div class="chofers_fila1">
		<h2>Bienvenido al panel de administración</h2>
	</div>	
</div>	

<?php mysqli_close($con); 
?>