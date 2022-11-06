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

$result = mysqli_query($con, "SELECT codigo, login, clave, nombre FROM usuarios where login ='$login'");
$row=mysqli_fetch_array($result, MYSQLI_NUM);
	$cod = $row[0];
	$login_usuario = $row[1];
	$clave = $row[2];
	$nombre = $row[3];

?>

<table class="tabla_add_clave">
	<tr>
		<th>Modificar contraseña</th>
	</tr>
</table>

<form action="php/editar_opcion_clave.php" class="formulario_clave" method="POST" enctype="multipart/form-data">

	<div class="contra_usuario">
	    <p>Nueva contraseña:</p>
	    <input type="password" id="contra_usuario" placeholder="Escriba aquí la contraseña del usuario" name="contra_ed_usuario">
	</div>
	<input type="hidden" name="cod_ed_usuario" value="<?php echo $cod;?>">

	<div class="boton_clave">
	    <input type="submit" name="editar_usuario" value="Aceptar información">
	</div>            
</form>
<?php
mysqli_close($con); 
?>