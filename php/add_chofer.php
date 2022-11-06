<?php 

include('conexion.php');

$asw = mysqli_query($con, "SELECT usuario FROM usuarios where login ='$login'");
$ter=mysqli_fetch_array($asw, MYSQLI_NUM);
    $esta = $ter[0];
if ($esta == "si") {
    echo "entra";
    header("Location: administracion.php");
}

?>

<table class="tabla_add_chofer">
	<tr>
		<th>Añadir Chófer</th>
	</tr>
</table>

<form action="php/add_opcion_chofer.php" class="formulario_chofer" method="POST" enctype="multipart/form-data">
	<div class="nombre_chofer">
	    <p>Nombre del chófer</p>
	    <input type="text" id="nombre_chofer" placeholder="Escriba aquí el nombre del chófer" name="nombre_chofer" required>
	</div>

	<div class="apellidos_chofer">
	    <p>Apellidos del chófer</p>
	    <input type="text" id="apellidos_chofer" placeholder="Escriba aquí los apellidos del chófer" name="apellidos_chofer" required>
	</div>

	<div class="dni_chofer">
	    <p>DNI del chófer</p>
	    <input type="text" id="dni_chofer" placeholder="Escriba aquí el DNI del chófer" name="dni_chofer" required>
	</div>

	<div class="telefono_chofer">
	    <p>Teléfono del chófer</p>
	    <input type="number" id="telefono_chofer" placeholder="Escriba aquí el teléfono del chófer" name="telefono_chofer" required>
	</div>

	<div class="login_chofer">
	    <p>Login del chófer</p>
	    <input type="text" id="login_chofer" placeholder="Escriba aquí el login del chófer" name="login_chofer" required>
	</div>

	<div class="clave_chofer">
	    <p>Clave del chófer</p>
	    <input type="password" id="clave_chofer" placeholder="Escriba aquí la clave del chófer" name="clave_chofer" required>
	</div>

	<div class="boton_chofer">
	    <input type="submit" name="publicar_chofer" value="Añadir chófer">
	</div>            
</form>

