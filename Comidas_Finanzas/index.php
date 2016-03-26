<!DOCTYPE html> 
<?php include '../conexion.php';
$mysqli=conectar(1);
setlocale(LC_ALL,"esp");
?>
<html> 
<head> 
  <title>Comidas</title> 
  <meta name="viewport" content="initial-scale=1.0">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <link rel="stylesheet" href="jquery.mobile-1.3.1.css" />
  <script src="libs/jquery-1.9.1.min.js"></script>
  <script src="libs/jquery.mobile-1.3.1.min.js"></script>
</head> 
<body> 
    <script>
    function agregar(id)
    {


      var Valor=id;
      var Chk="checkbox-"+Valor;
      var Checado=document.getElementById(Chk).checked;//Esta en Check?
 if (Checado==true)
    {
    var btn = document.createElement("input");
      //btn.setAttribute("value", Valor);
      btn.setAttribute("value", "");
      btn.setAttribute("placeholder", "Fecha");
      btn.setAttribute("id", "CHK"+Valor);
      //btn.setAttribute("name", "Ing"+Valor);
      btn.setAttribute("name", "Ing[]");
      btn.setAttribute("type", "date");
      //btn.setAttribute("readonly", "true");
      
      
      document.getElementById("myDIV"+Valor).appendChild(btn);

     }
  else{
    Delete(Valor);
  }


      
    }//ENd ELSE
  function Delete(id) {
  
      var ids="CHK"+id;
      var ElementoDelete = document.getElementById(ids);
      ElementoDelete.parentNode.removeChild(ElementoDelete);

}
</script>

<div data-role="page">

  <div data-role="header" data-position="fixed">
    <a href="ComidasSemana.php" data-transition="flip" >Comidas para esta semana</a>

    <a href="addcomidas.php" data-transition="pop" >Comidas y recetas</a>
    <h1>Comidas por hacer</h1>
    <?php 
$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
 
echo $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ; 



$fecha='2015-11-04';

function ConvetidorFechas($fecha,$opcion)
{

switch ($opcion) {
  case 1:
    #En numero
  $year=substr($fecha,0,4); 
$month=substr($fecha,5,2); 
$day=substr($fecha,8,2); 
echo $fecha=$day."-".$month."-".$year;
    break;
  case 2:
    # Letras
$year=substr($fecha,0,4); 
$month=substr($fecha,5,2); 
$day=substr($fecha,8,2);
  switch ($month) {
          case 1: $month='Enero'; break;
          case 2: $month='Febrero'; break;
          case 3: $month='Marzo'; break;
          case 4: $month='Abril'; break;
          case 5: $month='Mayo'; break;
          case 6: $month='Junio'; break;
          case 7: $month='Julio'; break;
          case 8: $month='Agosto'; break;
          case 9: $month='Septiembre';  break;
          case 10: $month='Octubre'; break; 
          case 11: $month='Noviembre'; break;
          case 12: $month='Diciembre'; break;
    break;
 
}//END switch Letras
echo $fecha=$day." de ".$month." del ".$year;
break;
case 3:
#Dia y mes letras
$year=substr($fecha,0,4); 
$month=substr($fecha,5,2); 
$day=substr($fecha,8,2);

$dayN=date("D", strtotime($fecha)); 

switch ($dayN) {

  case 'Sun': $dayL='Domingo'; break;
  case 'Mon': $dayL='Lunes'; break;
  case 'Tue': $dayL='Martes'; break;
  case 'Wed': $dayL='Miercoles'; break;
  case 'Fri': $dayL='Viernes'; break;
   case 'Thu': $dayL='Jueves'; break;
   case 'Sat': $dayL='Sabado'; break;
   
   default:
     # code...
     break;
 } 

  switch ($month) {
          case 1: $month='Enero'; break;
          case 2: $month='Febrero'; break;
          case 3: $month='Marzo'; break;
          case 4: $month='Abril'; break;
          case 5: $month='Mayo'; break;
          case 6: $month='Junio'; break;
          case 7: $month='Julio'; break;
          case 8: $month='Agosto'; break;
          case 9: $month='Septiembre';  break;
          case 10: $month='Octubre'; break; 
          case 11: $month='Noviembre'; break;
          case 12: $month='Diciembre'; break;
    break;
 
}//END switch Letras
echo $fecha=$dayL." ".$day." de ".$month." del ".$year;
  break;
 default:
    echo "NULL";
    break;

}


}

?>
  </div><!-- /header -->

  <div data-role="content"> 
  
<div  data-role="fieldcontain">
        <fieldset data-role="controlgroup">
           <h1>Comidas disponibles</h1>
           <form action='procesar.php' id="miform" method='GET' data-ajax="false">

           <?php


$mysqli->real_query ('SELECT DISTINCT c.id,c.nombre,h.fecha_preparacion FROM historico h, comida c
                        WHERE c.id= h.id_comida
                        AND fecha_repeticion <= (SELECT CURDATE());');
$id=1;
          $resultado = $mysqli->use_result();
          while ($fila = $resultado->fetch_object())
           {
                     

                   
                        //$sqlPrecio="SELECT SUM(precio) PRECIO FROM ingredientes WHERE id_comida=$fila->id;";
             ?> 
                          <input type="checkbox" onclick="agregar('<?php echo $fila->id; ?>')" 
                          value="<?php echo $fila->id; ?>"
                           name='checkbox[]' id="checkbox-<?php echo $fila->id; ?>" class="custom" />
                          <label for="checkbox-<?php echo $fila->id; ?>" ><?php echo $fila->nombre; ?>
                          
         <?php echo "Precio total Estimado $" ?></label>
                         <!-- <input type="date" name="fechas[]"><br><br>-->
                         <div data-role="fieldcontain" id ="<?php echo $fila->id?>"></div>
                         <div id="myDIV<?php echo $fila->id; ?>">
                          </div>
                          <label >Ultima preparacion: <?php echo ConvetidorFechas($fila->fecha_preparacion,3); ?></label>
                          <?php
                          $id+=1;
                        }  
?>
<input type="hidden" name="opc" value="1">
<input type="submit" value="Selecionar">
</form>
          </fieldset>
      </div>
  

</div><!-- /page -->

</body>
</html>
