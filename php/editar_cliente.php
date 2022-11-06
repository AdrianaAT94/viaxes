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

$elem = $_GET['editar_cliente'];
$result = mysqli_query($con, "SELECT codigo, dni, nombre, apellidos, telefono, nombre_empresa, cif FROM clientes where codigo ='$elem'");
$row=mysqli_fetch_array($result, MYSQLI_NUM);
	$cod = $row[0];
	$dni = $row[1];
	$nombre = $row[2];
	$apellidos = $row[3];
	$telefono = $row[4];
	$nombre_empresa = $row[5];
	$cif = $row[6];

?>

<table class="tabla_add_cliente">
	<tr>
		<th>Modificar cliente</th>
	</tr>
</table>

<form action="php/editar_opcion_cliente.php" class="formulario_cliente" method="POST" enctype="multipart/form-data">
	<div class="nombre_cliente">
	    <p>Nombre del cliente:</p>
	    <input type="text" id="nombre_cliente" placeholder="Escriba aquí el nombre del cliente" value="<?php echo $nombre;?>" name="nombre_ed_cliente" required>
	</div>

	<div class="apellidos_cliente">
	    <p>Apellidos del cliente</p>
	    <input type="text" id="apellidos_cliente" placeholder="Escriba aquí los apellidos del cliente" value="<?php echo $apellidos;?>" name="apellidos_ed_cliente" required>
	</div>

	<div class="dni_cliente">
	    <p>DNI del cliente</p>
	    <input type="text" id="dni_cliente" placeholder="Escriba aquí el DNI del cliente" value="<?php echo $dni;?>" name="dni_ed_cliente" required>
	</div>

	<div class="telefono_cliente">
	    <p>Teléfono del cliente</p>
	    <input type="number" id="telefono_cliente" placeholder="Escriba aquí el teléfono del cliente" value="<?php echo $telefono;?>" name="telefono_ed_cliente" required>
	</div>

	<div class="nombre_empresa">
	    <p>Nombre de la empresa</p>
	    <input type="text" id="nombre_empresa" placeholder="Escriba aquí el nombre de la empresa" value="<?php echo $nombre_empresa;?>" name="nombre_ed_empresa" required>
	</div>

	<div class="dni_cliente">
	    <p>CIF de la empresa</p>
	    <input type="text" id="cif_empresa" placeholder="Escriba aquí el CIF de la empresa" value="<?php echo $cif;?>" name="cif_ed_empresa" required>
	</div>
	<input type="hidden" name="cod_ed_cliente" value="<?php echo $cod;?>">

	<div class="boton_cliente">
	    <input type="submit" name="editar_cliente" value="Aceptar información">
	</div>            
</form>
<?php
mysqli_close($con); 
?>