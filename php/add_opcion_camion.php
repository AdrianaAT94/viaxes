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
            @session_start();
            $login = $_SESSION['administrador']; 
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

            //ID de administrador             
            $administrador = mysqli_query($con, "SELECT id FROM usuarios WHERE admin='si' AND login = '$login'");
            $id_administrador=mysqli_fetch_array($administrador, MYSQLI_NUM);

            if (isset($_REQUEST['publicar_camion'])) {
                $marca_camion = $_REQUEST['marca_camion'];
                $marca_camion = mysqli_real_escape_string($con, $marca_camion);
                $modelo_camion = $_REQUEST['modelo_camion'];
                $modelo_camion = mysqli_real_escape_string($con, $modelo_camion);
                $matricula_camion = $_REQUEST['matricula_camion'];
                $matricula_camion = mysqli_real_escape_string($con, $matricula_camion);
                $km_camion = $_REQUEST['km_camion'];
                $km_camion = mysqli_real_escape_string($con, $km_camion);  

                //generar codigo
                $key = 'cam'.'';
                $pattern = '1234567890VIAXES';
                $max = strlen($pattern)-1;
                for($i=0;$i < 9;$i++) $key .= $pattern{mt_rand(0,$max)};

                //Ejecucion de la sentencia SQL
                mysqli_query($con, "insert into camiones (codigo, marca, modelo, matricula, kilometros) values ('$key','$marca_camion','$modelo_camion','$matricula_camion','$km_camion')");
               
                //Redireccionamiento
                echo "<script> location.href=\"../administracion.php?list_camiones\";</script>";
                
        }
        
        mysqli_close($con); 
        ?>
    </body>
</html> 