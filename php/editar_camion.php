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

$asw = mysqli_query($con, "SELECT usuario FROM usuarios where login ='$login'");
$ter=mysqli_fetch_array($asw, MYSQLI_NUM);
    $esta = $ter[0];
if ($esta == "si") {
    echo "entra";
    header("Location: administracion.php");
}

$elem = $_GET['editar_camion'];
$result = mysqli_query($con, "SELECT codigo, marca, modelo, matricula, kilometros FROM camiones where codigo ='$elem'");
$row=mysqli_fetch_array($result, MYSQLI_NUM);
	$cod = $row[0];
	$marca_camion = $row[1];
	$modelo_camion = $row[2];
	$matricula_camion = $row[3];
	$km_camion = $row[4];

?>

<table class="tabla_add_camion">
	<tr>
		<th>Modificar Camión</th>
	</tr>
</table>

<form action="php/editar_opcion_camion.php" class="formulario_camion" method="POST" enctype="multipart/form-data">
	<div class="marca_camion">
	    <p>Marca del camión:</p>
	    <input type="text" id="marca_camion" placeholder="Escriba aquí la marca del camión" value="<?php echo $marca_camion;?>" name="marca_ed_camion" required>
	</div>

	<div class="modelo_camion">
	    <p>Modelo del camión</p>
	    <input type="text" id="modelo_camion" placeholder="Escriba aquí el modelo del camión" value="<?php echo $modelo_camion;?>" name="modelo_ed_camion" required>
	</div>

	<div class="matricula_camion">
	    <p>Matrícula del camión</p>
	    <input type="text" id="matricula_camion" placeholder="Escriba aquí la matrícula del camión" value="<?php echo $matricula_camion;?>" name="matricula_ed_camion" required>
	</div>

	<div class="km_camion">
	    <p>Kilómetros del camión</p>
	    <input type="number" id="km_camion" placeholder="Escriba aquí los ´kilómetros del camión" value="<?php echo $km_camion;?>" name="km_ed_camion" required>
	</div>

	<input type="hidden" name="cod_ed_camion" value="<?php echo $cod;?>">

	<div class="boton_camion">
	    <input type="submit" name="editar_camion" value="Aceptar información">
	</div>            
</form>
<?php
mysqli_close($con); 
?>