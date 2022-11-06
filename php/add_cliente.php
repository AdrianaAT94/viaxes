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

<table class="tabla_add_cliente">
	<tr>
		<th>Añadir Cliente</th>
	</tr>
</table>

<form action="php/add_opcion_cliente.php" class="formulario_cliente" method="POST" enctype="multipart/form-data">
	<div class="nombre_cliente">
	    <p>Nombre del cliente:</p>
	    <input type="text" id="nombre_cliente" placeholder="Escriba aquí el nombre del cliente" name="nombre_cliente" required>
	</div>

	<div class="apellidos_cliente">
	    <p>Apellidos del cliente</p>
	    <input type="text" id="apellidos_cliente" placeholder="Escriba aquí los apellidos del cliente" name="apellidos_cliente" required>
	</div>

	<div class="dni_cliente">
	    <p>DNI del cliente</p>
	    <input type="text" id="dni_cliente" placeholder="Escriba aquí el DNI del cliente" name="dni_cliente" required>
	</div>

	<div class="telefono_cliente">
	    <p>Teléfono del cliente</p>
	    <input type="number" id="telefono_cliente" placeholder="Escriba aquí el teléfono del cliente" name="telefono_cliente" required>
	</div>

	<div class="nombre_empresa">
	    <p>Nombre de la empresa</p>
	    <input type="text" id="nombre_empresa" placeholder="Escriba aquí el nombre de la empresa" name="nombre_empresa" required>
	</div>

	<div class="dni_cliente">
	    <p>CIF de la empresa</p>
	    <input type="text" id="cif_empresa" placeholder="Escriba aquí el CIF de la empresa" name="cif_empresa" required>
	</div>

	<div class="boton_cliente">
	    <input type="submit" name="publicar_cliente" value="Añadir cliente">
	</div>            
</form>

