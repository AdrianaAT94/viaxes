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

$asw = mysqli_query($con, "SELECT usuario FROM administrador where login ='$login'");
$ter=mysqli_fetch_array($asw, MYSQLI_NUM);
    $esta = $ter[0];
if ($esta == "si") {
    echo "entra";
    header("Location: administracion.php");
}
        
if (isset($_REQUEST['editar_chofer'])) {  
  $cod = $_REQUEST['cod_ed_chofer'];
  $nombre_chofer = $_REQUEST['nombre_ed_chofer'];
  $nombre_chofer = mysqli_real_escape_string($con, $nombre_chofer);
  $apellidos_chofer = $_REQUEST['apellidos_ed_chofer'];
  $apellidos_chofer = mysqli_real_escape_string($con, $apellidos_chofer);
  $dni_chofer = $_REQUEST['dni_ed_chofer'];
  $dni_chofer = mysqli_real_escape_string($con, $dni_chofer);
  $telefono_chofer = $_REQUEST['telefono_ed_chofer'];
  $telefono_chofer = mysqli_real_escape_string($con, $telefono_chofer);
  $login_chofer = $_REQUEST['login_ed_chofer'];
  $login_chofer = mysqli_real_escape_string($con, $login_chofer);
  $clave_chofer = md5(trim($_REQUEST["clave_ed_chofer"]));
  $clave_chofer = mysqli_real_escape_string($con, $clave_chofer);  


 //Ejecucion de la sentencia SQL
 if ($_REQUEST["clave_ed_chofer"] =="") {
    mysqli_query($con, "update usuarios set nombre='$nombre_chofer', apellidos='$apellidos_chofer', dni='$dni_chofer', telefono='$telefono_chofer', login='$login_chofer' where codigo='$cod'");
  }

  else {
    mysqli_query($con, "update usuarios set nombre='$nombre_chofer', apellidos='$apellidos_chofer', dni='$dni_chofer', telefono='$telefono_chofer', login='$login_chofer', clave='$clave_chofer' where codigo='$cod'");
  }

  //Redireccionamiento
  echo "<script> location.href=\"../administracion.php?list_chofers\";</script>";
        
}


@mysqli_close($con); 
?>

</body>
</html>