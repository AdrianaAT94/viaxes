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
$result = mysqli_query($con, "SELECT usuario, admin FROM usuarios where login ='$login'");
$row=mysqli_fetch_array($result, MYSQLI_NUM);
	$user = $row[0];
	$admin = $row[1];
?>
<div class="listas">
	<div class="lista_opcions_admin">
		<ul>
			<?php if ($user == "si" || $admin == "si") { ?>
			<li class="chofers_admin"><img src="./images/iconos_areaprivada/ap_chofers.png">CHÓFERS
				<div class="lista_subopcions_chofer">
					<ul>
						<a href="?list_chofers"><li class="list_chofers">LISTADO DE CHÓFERS</li></a>
						<a href="?add_chofer"><li class="add_chofer">AÑADIR CHÓFER</li></a>
					</ul>
				</div>
			</li>
			<?php } ?>
			<?php if ($user == "si" || $admin == "si") { ?>
			<li class="clientes_admin"><img src="./images/iconos_areaprivada/ap_clientes.png">CLIENTES
				<div class="lista_subopcions_cliente">
					<ul>
						<a href="?list_clientes"><li class="list_clientes">LISTADO DE CLIENTES</li></a>
						<a href="?add_cliente"><li class="add_cliente">AÑADIR CLIENTE</li></a>
					</ul>
				</div>
			</li>
			<?php } ?>
			<?php if ($user == "si" || $admin == "si") { ?>
			<li class="camiones_admin"><img src="./images/iconos_areaprivada/ap_camiones.png">CAMIONES
				<div class="lista_subopcions_camion">
					<ul>
						<a href="?list_camiones"><li class="list_camiones">LISTADO DE CAMIONES</li></a>
						<a href="?add_camion"><li class="add_camion">AÑADIR CAMION</li></a>
					</ul>
				</div>
			</li>
			<?php } ?>
			<a class="no_estilo" href="?editar_clave"><li class="clave_user"><img src="./images/iconos_areaprivada/ap_clientes.png">CONTRASEÑA</li></a>
		</ul>
	</div>
	<div class="clear"></div>
</div>
<div class="cuerpo_opcion_admin">
	<?php if (isset($_GET['list_chofers'])) { ?>
		<?php if ($user == "si" || $admin == "si") { ?>
		<div class="l_chofers">
			<div class="chofers_fila1">
				<div>
					<h2>CHÓFERS</h2>
				</div>
				<div>
					<a href="?add_chofer"><p class="enl_chofer">Añadir chófer</p></a>
				</div>
				<div class="oculto">
					
				</div>
				<div class="clear"></div>
			</div>
	        <div class="en_chofer"><?php include('chofers.php')?></div>
		</div><?php  
		} 
		else {
			include('inicio.php');
		}
	}?>
	<?php if (isset($_GET['add_chofer'])) { ?>
		<?php if ($user == "si" || $admin == "si") { ?>
		<div class="a_chofers">
			<div class="chofers_fila1">
				<div>
					<h2>CHÓFERS</h2>
				</div>
				<div>
					
				</div>
				<div class="oculto">
				</div>
				<div class="clear"></div>
			</div>
	        <div class="in_chofer"><?php include('add_chofer.php')?></div>
		</div><?php  
		} 
		else {
			include('inicio.php');
		}
	}?>
<?php if (isset($_GET['list_camiones'])) { ?>
	<div class="l_camiones">
		<div class="camiones_fila1">
			<div>
				<h2>CAMIONES</h2>
			</div>
			<div>
				<a href="?add_camion"><p class="enl_camion">Añadir camión</p></a>
			</div>
			<div class="oculto">
				
			</div>
			<div class="clear"></div>
		</div>
        <div class="en_camion"><?php include('camiones.php')?></div>
	</div><?php }?>
	<?php if (isset($_GET['add_camion'])) { ?>
	<div class="a_camiones">
		<div class="camiones_fila1">
			<div>
				<h2>CAMIONES</h2>
			</div>
			<div>
				
			</div>
			<div class="oculto">
			</div>
			<div class="clear"></div>
		</div>
        <div class="in_camion"><?php include('add_camion.php')?></div>
	</div><?php }?>
<?php if (isset($_GET['list_clientes'])) { ?>
	<?php if ($user == "si" || $admin == "si") { ?>
		<div class="l_clientes">
			<div class="clientes_fila1">
				<div>
					<h2>CLIENTES</h2>
				</div>
				<div>
					<a href="?add_cliente"><p class="enl_cliente">Añadir cliente</p></a>
				</div>
				<div class="oculto">
					
				</div>
				<div class="clear"></div>
			</div>
	        <div class="en_cliente"><?php include('clientes.php')?></div>
		</div><?php  
		} 
		else {
			include('inicio.php');
		}
	}?>
	<?php if (isset($_GET['add_cliente'])) { ?>
		<?php if ($user == "si" || $admin == "si") { ?>
		<div class="a_clientes">
			<div class="clientes_fila1">
				<div>
					<h2>CLIENTES</h2>
				</div>
				<div>
					
				</div>
				<div class="oculto">
				</div>
				<div class="clear"></div>
			</div>
	        <div class="in_cliente"><?php include('add_cliente.php')?></div>
		</div><?php  
		} 
		else {
			include('inicio.php');
		}
	}?>
	<?php if (isset($_GET['borrar_chofer'])) { ?>
		<?php if ($user == "si" || $admin == "si") { ?>
	        <div><?php include('borrar_chofer.php')?></div>	
	        <?php 
	    } 
		else {
			include('inicio.php');
		}
	}?>
	<?php if (isset($_GET['borrar_camion'])) { ?>
        <div><?php include('borrar_camion.php')?></div>	
        <?php }?>
    <?php if (isset($_GET['borrar_cliente'])) { ?>
	    <?php if ($user == "si" || $admin == "si") { ?>
	        <div><?php include('borrar_cliente.php')?></div>	
	        <?php 
	    } 
		else {
			include('inicio.php');
		} 
	}?>
    <?php if (isset($_GET['editar_clave'])) { ?>
		<div class="a_clave">
			<div class="clave_fila1">
				<div>
					<h2>CONTRASEÑA</h2>
				</div>
				<div>
					
				</div>
				<div class="oculto">
				</div>
				<div class="clear"></div>
			</div>
	        <div class="in_clave"><?php include('editar_clave.php')?></div>
		</div>
        <?php }?>
    <?php if (isset($_GET['editar_chofer'])) { ?>
	    <?php if ($user == "si" || $admin == "si") { ?>
	    	<div class="ed_chofer">
	    		<div>
					<h2>CHÓFERS</h2>
				</div>
	        <div class="in_chofer"><?php include('editar_chofer.php')?></div></div>
	        <?php 
	    } 
		else {
			include('inicio.php');
		} 
    }?>
    <?php if (isset($_GET['editar_camion'])) { ?>
    	<div class="ed_camion">
    		<div>
				<h2>CAMIONES</h2>
			</div>
        <div class="in_camion"><?php include('editar_camion.php')?></div></div>
        <?php }?>
    <?php if (isset($_GET['editar_cliente'])) { ?>
	    <?php if ($user == "si" || $admin == "si") { ?>
	    	<div class="ed_cliente">
	    		<div>
					<h2>CLIENTES</h2>
				</div>
	        <div class="in_cliente"><?php include('editar_cliente.php')?></div></div>
	        <?php 
	    } 
		else {
			include('inicio.php');
		} 
	}?>

	<?php if (!isset($_GET['list_chofers']) && !isset($_GET['add_chofer']) && !isset($_GET['borrar_chofer']) && !isset($_GET['editar_chofer'])
	&& !isset($_GET['list_camiones']) && !isset($_GET['add_camion']) && !isset($_GET['borrar_camion']) && !isset($_GET['editar_camion'])
	&& !isset($_GET['list_clientes']) && !isset($_GET['add_cliente']) && !isset($_GET['borrar_cliente']) && !isset($_GET['editar_cliente'])
	&& !isset($_GET['editar_clave'])) {?>
		<div class="l_chofers">	
        <?php include('inicio.php')?>
	</div><?php } ?>
	<div class="clear"></div>
</div>
<div class="clear"></div>