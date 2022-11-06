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
            @session_start();
            $login = $_SESSION['administrador']; 
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

            //ID de administrador             
            $administrador = mysqli_query($con, "SELECT id FROM usuarios WHERE admin='si' AND login = '$login'");
            $id_administrador=mysqli_fetch_array($administrador, MYSQLI_NUM);

            if (isset($_REQUEST['publicar_chofer'])) {
                $nombre_chofer = $_REQUEST['nombre_chofer'];
                $nombre_chofer = mysqli_real_escape_string($con, $nombre_chofer);
                $apellidos_chofer = $_REQUEST['apellidos_chofer'];
                $apellidos_chofer = mysqli_real_escape_string($con, $apellidos_chofer);
                $dni_chofer = $_REQUEST['dni_chofer'];
                $dni_chofer = mysqli_real_escape_string($con, $dni_chofer);
                $telefono_chofer = $_REQUEST['telefono_chofer'];
                $telefono_chofer = mysqli_real_escape_string($con, $telefono_chofer);
                $login_chofer = $_REQUEST['login_chofer'];
                $login_chofer = mysqli_real_escape_string($con, $login_chofer);
                $clave_chofer = md5(trim($_REQUEST["clave_chofer"]));
                $clave_chofer = mysqli_real_escape_string($con, $clave_chofer);  
                

                //generar codigo
                $key = 'user'.'';
                $pattern = '1234567890VIAXES';
                $max = strlen($pattern)-1;
                for($i=0;$i < 9;$i++) $key .= $pattern{mt_rand(0,$max)};

                //Ejecucion de la sentencia SQL
                mysqli_query($con, "insert into usuarios (codigo, dni, login, clave, nombre, apellidos, telefono, disco, usuario, chofer, admin) values ('$key','$dni_chofer','$login_chofer','$clave_chofer','$nombre_chofer','$apellidos_chofer','$telefono_chofer','x','no','si','no')");
               
                //Redireccionamiento
                echo "<script> location.href=\"../administracion.php?list_chofers\";</script>";
                
            }
        
        mysqli_close($con); 
        ?>
    </body>
</html> 