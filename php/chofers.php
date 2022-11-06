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
$consulta_chofers = "SELECT * FROM usuarios WHERE chofer='si' ORDER BY nombre ASC";
$rs_chofers = mysqli_query($con, $consulta_chofers);

//Contamos numero de registros
$num_total_chofers = mysqli_num_rows($rs_chofers);

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
$total_paginas = ceil($num_total_chofers / $tam_pag);
/*consulta paginada*/
$consulta = "SELECT * FROM usuarios WHERE chofer='si' ORDER BY nombre ASC LIMIT ".$inicio."," . $tam_pag;
$result = mysqli_query($con, $consulta);

//Variable que contendrá el resultado de la búsqueda 
$texto = ''; 
//Variable que contendrá el número de resgistros encontrados 
$registros = '';  
if (isset($_POST['buscar_chofer'])) {

    $busqueda = trim($_POST['buscar_chofer']);
    $busqueda = mysqli_real_escape_string($con, $busqueda);
    $entero = 0;  
    if (empty($busqueda)){ 
      $texto = '<p class="texto_busqueda">Búsqueda sin resultados<p>'; 
    }else{ 
        // Si hay información para buscar, abrimos la conexión 
        //Contulta para la base de datos, se utiliza un comparador LIKE para acceder a todo lo que contenga la cadena a buscar 
        $sql = "SELECT * FROM usuarios WHERE chofer='si' AND nombre LIKE '%" .$busqueda. "%' ORDER BY nombre ASC";  
        $resultado = mysqli_query($con, $sql); //Ejecución de la consulta 
         //Si hay resultados... 
        if (mysqli_num_rows($resultado) > 0){  
            echo '<table class="tabla_chofers" align="center">
                <tr>
                <th>Listado de chofers</th>
                <th>DNI</th>
                <th>Teléfono</th>
                <th>Disco</th>
                </tr>';
            // Se almacenan las cadenas de resultado 
            while ($fila=mysqli_fetch_array($resultado, MYSQLI_ASSOC))
            {

              if(!isset($_GET["elem"]))
                $elem = $fila['codigo'];
            else
                $elem = '';
            echo '<tr><td><div>'.$fila["nombre"].' '.$fila["apellidos"]; ?>
            <div class="iconos_bd"><div class="img1_bd"><a href="?editar_chofer=<?php echo $elem; ?>"><img src ="images/iconos_areaprivada/ap_editar.png"></a></div>
            <div class="img2_bd"><a onclick="if(confirm('ADVERTENCIA \n Si acepta eliminar el archivo, también será eliminado de su servidor. ¿Desea borrar de forma permanente este archivo?') == false){return false;}" href="?borrar_chofer=<?php echo $elem; ?>"><img src="images/iconos_areaprivada/ap_eliminar.png"></a></div><div class="clear"></div></div></div></td>
            <?php echo '<td>'.$fila["dni"].'</td>';
            echo '<td>'.$fila["telefono"].'</td>';
            echo '<td>'.$fila["disco"].'</td></tr>';
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
  <form id="buscador_chofer"  method="post" action="">  
    <div class="formu_input"><input id="buscar_chofer" name="buscar_chofer" type="search" placeholder="Buscar..." autofocus > </div>
    <div class="formu_img"><input type="image" src="images/iconos_areaprivada/ap_buscar.png" alt="submit" class="boton" value="buscar"> </div>
    <div class="clear"></div>
  </form>
</div>

<table class="tabla_chofers" align="center">
<tr>
<th>Listado de chófers</th>
<th>DNI</th>
<th>Teléfono</th>
<th>Disco</th>
</tr>
<?php
//Mostramos los registros
while ($row=mysqli_fetch_array($result, MYSQLI_ASSOC))
{

  if(!isset($_GET["elem"]))
    $elem = $row['codigo'];
else
    $elem = '';
echo '<tr><td><div>'.$row["nombre"].' '.$row["apellidos"]; ?>
<div class="iconos_bd"><div class="img1_bd"><a href="?editar_chofer=<?php echo $elem; ?>"><img src ="images/iconos_areaprivada/ap_editar.png"></a></div>
<div class="img2_bd"><a onclick="if(confirm('ADVERTENCIA \n Si acepta eliminar el archivo, también será eliminado de su servidor. ¿Desea borrar de forma permanente este archivo?') == false){return false;}" href="?borrar_chofer=<?php echo $elem; ?>"><img src="images/iconos_areaprivada/ap_eliminar.png"></a></div><div class="clear"></div></div></div></td>
<?php echo '<td>'.$row["dni"].'</td>';
echo '<td>'.$row["telefono"].'</td>';
echo '<td>'.$row["disco"].'</td></tr>';
}
mysqli_free_result($result)
?>
</table>


<?php
echo '<div class="paginacion_chofers">';
if ($total_paginas > 1) {
            echo '<a href="?list_chofers&pagina='.($pagina-1).'">« Anterior</a> | ';
            for ($i=1;$i<=$total_paginas;$i++) {
                if ($pagina == $i)
                        //si muestro el índice de la página actual, no coloco enlace
                    echo ' | '.$pagina." | ";
                else
                    //si el índice no corresponde con la página mostrada actualmente,
                    //coloco el enlace para ir a esa página
                    echo '  <a class="color" href="?list_chofers&pagina='.$i.'">'.$i.'</a>  ';
           }
           if ($pagina != $total_paginas)
               echo '<a href="?list_chofers&pagina='.($pagina+1).'"> | Siguiente »</a>';
 } }
echo "</div>";
mysqli_close($con); 
?>