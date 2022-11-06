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
    <title>Viaxes</title>
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
        
if (isset($_REQUEST['editar_camion'])) {
	$cod = $_REQUEST['cod_ed_camion'];
	$marca_camion = $_REQUEST['marca_ed_camion'];
    $marca_camion = mysqli_real_escape_string($con, $marca_camion);
    $modelo_camion = $_REQUEST['modelo_ed_camion'];
    $modelo_camion = mysqli_real_escape_string($con, $modelo_camion);
    $matricula_camion = $_REQUEST['matricula_ed_camion'];
    $matricula_camion = mysqli_real_escape_string($con, $matricula_camion);
    $km_camion = $_REQUEST['km_ed_camion'];
    $km_camion = mysqli_real_escape_string($con, $km_camion); 


   	mysqli_query($con, "update camiones set marca='$marca_camion', modelo='$modelo_camion', matricula='$matricula_camion', kilometros='$km_camion' where codigo='$cod'");
        
    //Redireccionamiento
    echo "<script> location.href=\"../administracion.php?list_camiones\";</script>";
      
}

@mysqli_close($con); 
?>

</body>
</html>