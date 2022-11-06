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
        
if (isset($_REQUEST['editar_usuario'])) {
	$cod = $_REQUEST['cod_ed_usuario'];
    $clave_usuario = md5(trim($_REQUEST["contra_ed_usuario"]));
    $clave_usuario = mysqli_real_escape_string($con, $clave_usuario);               


       //Ejecucion de la sentencia SQL


       	if ($_REQUEST["contra_ed_usuario"] !="") {
       		mysqli_query($con, "update usuarios set clave='$clave_usuario' where codigo='$cod'");
       	}
        
        //Redireccionamiento
        echo "<script> location.href=\"../administracion.php?inicio\";</script>";
}

@mysqli_close($con); 
?>

</body>
</html>