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

$elem = $_GET['editar_chofer'];
$result = mysqli_query($con, "SELECT codigo, dni, login, clave, nombre, apellidos, telefono, disco FROM usuarios WHERE chofer='si' AND codigo ='$elem'");
$row=mysqli_fetch_array($result, MYSQLI_NUM);
	$cod = $row[0];
	$dni = $row[1];
	$login = $row[2];
	$clave = $row[3];
	$nombre = $row[4];
	$apellidos = $row[5];
	$telefono = $row[6];
	$disco = $row[7];

?>

<table class="tabla_add_chofer">
	<tr>
		<th>Modificar Chófer</th>
	</tr>
</table>

<form action="php/editar_opcion_chofer.php" class="formulario_chofer" method="POST" enctype="multipart/form-data">
	<div class="nombre_chofer">
	    <p>Nombre del chófer</p>
	    <input type="text" id="nombre_chofer" placeholder="Escriba aquí el nombre del chófer" value="<?php echo $nombre;?>" name="nombre_ed_chofer" required>
	</div>

	<div class="apellidos_chofer">
	    <p>Apellidos del chófer</p>
	    <input type="text" id="apellidos_chofer" placeholder="Escriba aquí los apellidos del chófer" value="<?php echo $apellidos;?>" name="apellidos_ed_chofer" required>
	</div>

	<div class="dni_chofer">
	    <p>DNI del chófer</p>
	    <input type="text" id="dni_chofer" placeholder="Escriba aquí el DNI del chófer" value="<?php echo $dni;?>" name="dni_ed_chofer" required>
	</div>

	<div class="telefono_chofer">
	    <p>Teléfono del chófer</p>
	    <input type="number" id="telefono_chofer" placeholder="Escriba aquí el teléfono del chófer" value="<?php echo $telefono;?>" name="telefono_ed_chofer" required>
	</div>

	<div class="login_chofer">
	    <p>Login del chófer</p>
	    <input type="text" id="login_chofer" placeholder="Escriba aquí el login del chófer" value="<?php echo $login;?>" name="login_ed_chofer" required>
	</div>

	<div class="clave_chofer">
	    <p>Clave del chófer</p>
	    <input type="password" id="clave_chofer" placeholder="Escriba aquí la clave del chófer" name="clave_ed_chofer">
	</div>

	<input type="hidden" name="cod_ed_chofer" value="<?php echo $cod;?>">

	<div class="boton_chofer">
	    <input type="submit" name="editar_chofer" value="Aceptar información">
	</div>            
</form>
<?php
mysqli_close($con); 
?>