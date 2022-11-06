<?php
error_reporting(E_ALL ^ E_NOTICE);

require_once 'Mobile_Detect.php';
$detect = new Mobile_Detect;
$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
$scriptVersion = $detect->getScriptVersion();

//Conexion con la base
include('conexion.php');   

session_start();
?>
<!DOCTYPE html>
<html>
<head lang="es">
    <meta charset="UTF-8">
    <title>Viaxes</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
    <script src="js/jquery.min.js"></script>
    <script src="js/funciones_admin.js"></script>

    <?php
    if ($deviceType == 'computer' ){ ?>
    <link rel="stylesheet" type="text/css" href="css/desktop.css"/>
    <?php }

    if ($deviceType == 'tablet' ) { ?>
        <link rel="stylesheet" type="text/css" href="css/tablet.css"/>

    <?php
    } if ($deviceType == 'phone' ){ ?>
        <link rel="stylesheet" type="text/css" href="css/movil.css" />

    <?php  } ?>
        
    </head>
    <body class="body admin">
        <?php
            if ($deviceType == 'tablet' ) { ?>
                <div class="zona_admin"><?php include('php/cuerpo_movil.php')?></div>
            <?php } if ($deviceType == 'phone' ){ ?>
                <div class="zona_admin"><?php include('php/cuerpo_movil.php')?></div>
           <?php } if ($deviceType == 'computer' ){ ?>

         <?php
            //USUARIOS      
                               
        //validamos si se ha hecho o no el inicio de sesion correctamente
        if(!isset($_SESSION['administrador'])) { 
            if (isset($_REQUEST['enviar'])) {
                    $login = $_POST["txtlogin"];   
                    $password = md5(trim($_POST["txtpass"]));
                    $login = mysqli_real_escape_string($con, $login);
                    $password = mysqli_real_escape_string($con, $password);

                        /*Consulta de mysql con la que indicamos que necesitamos que seleccione
                        **solo los campos que tenga como login el que el formulario
                        **le ha enviado*/
                        $result = mysqli_query($con, "SELECT * FROM usuarios WHERE login = '$login'");

                    //Validamos si el login del usuario existe en la base de datos o es correcto
                    if($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {  
                        //Si el usuario es correcto ahora validamos su contraseña
                        if($row["clave"] == $password) {
                            //Creamos sesión
                            session_start();  
                            //Almacenamos el nombre de usuario en una variable de sesión usuario
                            $_SESSION['administrador'] = $login;  
                            //Redireccionamos a la pagina: index.php
                            header("Location: administracion.php");  
                        }
                        else { //en caso que la contraseña sea incorrecta ?> 
                            <div class="zona_admin"><?php include('php/cuerpo_admin_coninc.php')?></div>
                        <?php }
                    }
                    else { //en caso que el nombre de usuario es incorrecto ?>
                            <div class="zona_admin"><?php include('php/cuerpo_admin_usuinc.php')?></div>
                    <?php                  
                    }
                } else { ?>
                            <div class="zona_admin"><?php include('php/cuerpo_admin.php')?></div>
     <?php } 
    }
         if(isset($_SESSION['administrador'])) {
            $login = $_SESSION['administrador'];  
            ?>
            <div class="cabecera administracion"><?php include('php/cabecera_administracion.php')?></div>
            <div class="zona_administracion"><?php include('php/cuerpo_administracion.php')?></div
       <?php } 
        } ?>
    </body>
</html>
