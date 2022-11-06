<?php
error_reporting(E_ALL ^ E_NOTICE);

require_once '../Mobile_Detect.php';
$detect = new Mobile_Detect;
$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
$scriptVersion = $detect->getScriptVersion();
$idioma = $_GET['lan'];

session_start();
?>
<!DOCTYPE html>
<html>
<head lang="es">
    <meta charset="UTF-8">
    <title>Palets</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/funciones_admin.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/desktop.css"/>

    <?php
    if ($deviceType == 'tablet' ) { 
        header ("Location: ../administracion.php");
    } if ($deviceType == 'phone' ){ 
        header ("Location: ../administracion.php");
    }
    ?>
    </head>
    <body>
<?php
header("Content-Type: text/html;charset=utf-8");
//creamos la sesion
session_start();
@$login = $_SESSION['administrador']; 
if(!isset($_SESSION['administrador'])) {
    header("Location: ../administracion.php");
}

//Conexion con la base
include('../conexion.php');

$asw = mysqli_query($con, "SELECT usuario FROM usuarios where login ='$login'");
$ter=mysqli_fetch_array($asw, MYSQLI_NUM);
    $esta = $ter[0];
if ($esta == "si") {
    echo "entra";
    header("Location: administracion.php");
}
        
if (isset($_REQUEST['editar_cliente'])) {
  $cod = $_REQUEST['cod_ed_cliente'];
  $nombre_cliente = $_REQUEST['nombre_ed_cliente'];
  $nombre_cliente = mysqli_real_escape_string($con, $nombre_cliente);
  $apellidos_cliente = $_REQUEST['apellidos_ed_cliente'];
  $apellidos_cliente = mysqli_real_escape_string($con, $apellidos_cliente);
  $dni_cliente = $_REQUEST['dni_ed_cliente'];
  $dni_cliente = mysqli_real_escape_string($con, $dni_cliente);
  $telefono_cliente = $_REQUEST['telefono_ed_cliente'];
  $telefono_cliente = mysqli_real_escape_string($con, $telefono_cliente);
  $nombre_empresa = $_REQUEST['nombre_ed_empresa'];
  $nombre_empresa = mysqli_real_escape_string($con, $nombre_empresa);
  $cif_empresa = $_REQUEST['cif_ed_empresa'];
  $cif_empresa = mysqli_real_escape_string($con, $cif_empresa);           


   //Ejecucion de la sentencia SQL
   	mysqli_query($con, "update clientes set nombre='$nombre_cliente', apellidos='$apellidos_cliente', dni='$dni_cliente', telefono='$telefono_cliente', nombre_empresa='$nombre_empresa', cif='$cif_empresa' where codigo='$cod'");
   	        
    //Redireccionamiento
    echo "<script> location.href=\"../administracion.php?list_clientes\";</script>";
}

@mysqli_close($con); 
?>

</body>
</html>