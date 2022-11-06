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

//Ejecutamos la sentencia SQL
$consulta_camiones = "SELECT * FROM camiones";
$rs_camiones = mysqli_query($con, $consulta_camiones);

//Contamos numero de registros
$num_total_camiones = mysqli_num_rows($rs_camiones);

//Limito la busqueda
$tam_pag = 10;

//examino la página a mostrar y el inicio del registro a mostrar
if(!isset($_GET["pagina"]))
    $pagina="";
else
    $pagina = $_GET["pagina"];

if (!$pagina) {
   $inicio = 0;
   $pagina = 1;
}
else {
   $inicio = ($pagina - 1) * $tam_pag;
}
//calculo el total de páginas
$total_paginas = ceil($num_total_camiones / $tam_pag);
/*consulta paginada*/
$consulta = "SELECT * FROM camiones ORDER BY marca ASC LIMIT ".$inicio."," . $tam_pag;
$result = mysqli_query($con, $consulta);

//Variable que contendrá el resultado de la búsqueda 
$texto = ''; 
//Variable que contendrá el número de resgistros encontrados 
$registros = '';  
if (isset($_POST['buscar_camion'])) {

    $busqueda = trim($_POST['buscar_camion']);
    $busqueda = mysqli_real_escape_string($con, $busqueda);
    $entero = 0;  
    if (empty($busqueda)){ 
      $texto = '<p class="texto_busqueda">Búsqueda sin resultados<p>'; 
    }else{ 
        // Si hay información para buscar, abrimos la conexión 
        mysqli_set_charset('utf8'); // para indicar a la bbdd que vamos a mostrar la info en utf 
        //Contulta para la base de datos, se utiliza un comparador LIKE para acceder a todo lo que contenga la cadena a buscar 
        $sql = "SELECT * FROM camiones WHERE marca LIKE '%" .$busqueda. "%' ORDER BY marca ASC";  
        $resultado = mysqli_query($con, $sql); //Ejecución de la consulta 
         //Si hay resultados... 
        if (mysqli_num_rows($resultado) > 0){  
            echo '<table class="tabla_camiones" align="center">
                <tr>
                <th>Listado de camiones</th>
                <th>Matrícula</th>
                <th>Kilómetros</th>
                </tr>';
            // Se almacenan las cadenas de resultado 
            while ($fila=mysqli_fetch_array($resultado, MYSQLI_ASSOC))
            {

              if(!isset($_GET["elem"]))
                $elem = $fila['codigo'];
            else
                $elem = '';
            echo '<tr><td><div>'.$fila["marca"].' '.$fila["modelo"]; ?>
            <div class="iconos_bd"><div class="img1_bd"><a href="?editar_camion=<?php echo $elem; ?>"><img src ="images/iconos_areaprivada/ap_editar.png"></a></div>
            <div class="img2_bd"><a onclick="if(confirm('ADVERTENCIA \n Si acepta eliminar el archivo, también será eliminado de su servidor. ¿Desea borrar de forma permanente este archivo?') == false){return false;}" href="?borrar_camion=<?php echo $elem; ?>"><img src="images/iconos_areaprivada/ap_eliminar.png"></a></div><div class="clear"></div></div></div></td>
            <?php echo '<td>'.$fila["matricula"].'</td>';
            echo '<td>'.$fila["kilometros"].'</td></tr>';
            }
            mysqli_free_result($result);
            echo '</table>';
        }  
        else{ 
            $texto = "<p class='texto_busqueda'>No hay resultados</p>";   
        } 
    } 

echo $texto; 
} else {

?>
<div class="buscador">
  <form id="buscador_camion"  method="post" action="">  
    <div class="formu_input"><input id="buscar_camion" name="buscar_camion" type="search" placeholder="Buscar..." autofocus > </div>
    <div class="formu_img"><input type="image" src="images/iconos_areaprivada/ap_buscar.png" alt="submit" class="boton" value="buscar"> </div>
    <div class="clear"></div>
  </form>
</div>

<table class="tabla_camiones" align="center">
<tr>
<th>Listado de camiones</th>
<th>Matrícula</th>
<th>Kilómetros</th>
</tr>
<?php
//Mostramos los registros
while ($row=mysqli_fetch_array($result, MYSQLI_ASSOC))
{

  if(!isset($_GET["elem"]))
    $elem = $row['codigo'];
else
    $elem = '';
echo '<tr><td><div>'.$row["marca"].' '.$row["modelo"]; ?>
<div class="iconos_bd"><div class="img1_bd"><a href="?editar_camion=<?php echo $elem; ?>"><img src ="images/iconos_areaprivada/ap_editar.png"></a></div>
<div class="img2_bd"><a onclick="if(confirm('ADVERTENCIA \n Si acepta eliminar el archivo, también será eliminado de su servidor. ¿Desea borrar de forma permanente este archivo?') == false){return false;}" href="?borrar_camion=<?php echo $elem; ?>"><img src="images/iconos_areaprivada/ap_eliminar.png"></a></div><div class="clear"></div></div></div></td>
<?php echo '<td>'.$row["matricula"].'</td>';
echo '<td>'.$row["kilometros"].'</td></tr>';
}
mysqli_free_result($result)
?>
</table>


<?php
echo '<div class="paginacion_camiones">';
if ($total_paginas > 1) {
            echo '<a href="?list_camiones&pagina='.($pagina-1).'">« Anterior</a> | ';
            for ($i=1;$i<=$total_paginas;$i++) {
                if ($pagina == $i)
                        //si muestro el índice de la página actual, no coloco enlace
                    echo ' | '.$pagina." | ";
                else
                    //si el índice no corresponde con la página mostrada actualmente,
                    //coloco el enlace para ir a esa página
                    echo '  <a class="color" href="?list_camiones&pagina='.$i.'">'.$i.'</a>  ';
           }
           if ($pagina != $total_paginas)
               echo '<a href="?list_camiones&pagina='.($pagina+1).'"> | Siguiente »</a>';
} }
echo "</div>";
mysqli_close($con); 
?>