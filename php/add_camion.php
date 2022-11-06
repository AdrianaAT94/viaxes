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

<table class="tabla_add_camion">
	<tr>
		<th>Añadir Camión</th>
	</tr>
</table>

<form action="php/add_opcion_camion.php" class="formulario_camion" method="POST" enctype="multipart/form-data">
	<div class="marca_camion">
	    <p>Marca del camión:</p>
	    <input type="text" id="marca_camion" placeholder="Escriba aquí la marca del camión" name="marca_camion" required>
	</div>

	<div class="modelo_camion">
	    <p>Modelo del camión</p>
	    <input type="text" id="modelo_camion" placeholder="Escriba aquí el modelo del camión" name="modelo_camion" required>
	</div>

	<div class="matricula_camion">
	    <p>Matrícula del camión</p>
	    <input type="text" id="matricula_camion" placeholder="Escriba aquí la matrícula del camión" name="matricula_camion" required>
	</div>

	<div class="km_camion">
	    <p>Kilómetros del camión</p>
	    <input type="number" id="km_camion" placeholder="Escriba aquí los ´kilómetros del camión" name="km_camion" required>
	</div>

	<div class="boton_camion">
	    <input type="submit" name="publicar_camion" value="Añadir camión">
	</div>            
</form>

