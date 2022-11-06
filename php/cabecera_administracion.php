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

            
    ?>

<div class="cabecera_izq">
	<div class="logo_pardal"><a href="index.php"><img src="" alt="LOGO" /></a></div>
</div>
<div class="cabecera_der">
	<div class="user_administrador">
		<?php 
		$result = mysqli_query($con, "SELECT nombre FROM usuarios WHERE login = '$login'");
           $row=mysqli_fetch_array($result, MYSQLI_NUM);
           echo "<h4>".$row[0]."</h4>"; 
           mysqli_close($con); 
           ?>
	</div>
	<div class="user_salir">
		<a href='logout.php'><h5>Cerrar sesión</h5></a>
	</div>
	<div class="clear"></div>
</div>
<div class="clear"></div>
