<!DOCTYPE html> 
<?php include '../../conexion.php';
$mysqli=conectar(1);
setlocale(LC_ALL,"esp");
?>
<html> 
<head> 
  <title>Editar</title> 
  <meta name="viewport" content="initial-scale=1.0">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <link rel="stylesheet" href="jquery.mobile-1.3.1.css" />
  <script src="libs/jquery-1.9.1.min.js"></script>
  <script src="libs/jquery.mobile-1.3.1.min.js"></script>
</head> 
<body> 
    <script>
    function myFunctioninput() {
      var CajaSolicitada = document.getElementById('contar').value;//Se obtiene
      CajaSolicitada++;
      var Valor=document.getElementById('contar').value=CajaSolicitada;//Caja

      var btn = document.createElement("input");
      btn.setAttribute("value", "");
      btn.setAttribute("placeholder", "Ingrediente "+Valor);
      btn.setAttribute("id", Valor);
      //btn.setAttribute("name", "Ing"+Valor);
      btn.setAttribute("name", "Ing[]");
      btn.setAttribute("type", "text");
      //btn.setAttribute("readonly", "true");

      //IMAGEN
  var img = document.createElement("img");
      img.setAttribute("id", "Del"+Valor);
      img.setAttribute("name", "Ing"+Valor);
      img.setAttribute("src", "images/Delete.ico");
      img.setAttribute("WIDTH", "2%");
      img.setAttribute("HEIGHT", "2%");
      img.setAttribute("onclick", "Delete("+Valor+")");

      //BR
      var br = document.createElement("br");
      
      
      document.getElementById("myDIV").appendChild(btn);
      document.getElementById("myDIV").appendChild(img);
      document.getElementById("myDIV").appendChild(br);
}

function myFunctioninputPrep() {
      var CajaSolicitada = document.getElementById('contarPrep').value;//Se obtiene
      CajaSolicitada++;
      var Valor=document.getElementById('contarPrep').value=CajaSolicitada;//Caja

      var btn = document.createElement("input");
      btn.setAttribute("value", "");
      btn.setAttribute("placeholder", "Preparacion "+Valor);
      btn.setAttribute("id", "Prep"+Valor);
      //btn.setAttribute("name", "Ing"+Valor+"[]");
      btn.setAttribute("name", "Prepa[]");
      btn.setAttribute("type", "text");
      //btn.setAttribute("readonly", "true");

      //IMAGEN
  var img = document.createElement("img");
      img.setAttribute("id", "DelPrep"+Valor);
      img.setAttribute("name", "Ing"+Valor);
      img.setAttribute("src", "images/Delete.ico");
      img.setAttribute("WIDTH", "2%");
      img.setAttribute("HEIGHT", "2%");
      img.setAttribute("onclick", "DeletePrep('Prep"+Valor+"')");

      //BR
      var br = document.createElement("br");
      br.setAttribute("id", Valor);
      
      
      document.getElementById("myDIV2").appendChild(btn);
      document.getElementById("myDIV2").appendChild(img);
      document.getElementById("myDIV2").appendChild(br);
}

function Delete(id) {
  var CajaSolicitada = document.getElementById('contar').value;//Se obtiene
      CajaSolicitada--;
      var Valor=document.getElementById('contar').value=CajaSolicitada;//Caja


      var ids=id;
      var ElementoDelete = document.getElementById(ids);
      ElementoDelete.parentNode.removeChild(ElementoDelete);

      var idsDel="Del"+id;
      var ElementoDelete = document.getElementById(idsDel);
      ElementoDelete.parentNode.removeChild(ElementoDelete);

}
function DeletePrep(id) {
  var CajaSolicitada = document.getElementById('contarPrep').value;//Se obtiene
      CajaSolicitada--;
      var Valor=document.getElementById('contarPrep').value=CajaSolicitada;//Caja


      var ids=id;
      var ElementoDelete = document.getElementById(ids);
      ElementoDelete.parentNode.removeChild(ElementoDelete);

      var idsDel="Del"+id;
      var ElementoDelete = document.getElementById(idsDel);
      ElementoDelete.parentNode.removeChild(ElementoDelete);

}
  </script>

<div data-role="page">

  <div data-role="header" data-position="fixed">
    <a href="index.php" >Principal</a>
    <a href="Recetas.php" >Regresar</a>
    <?php 
    $idX=$_GET['id'];

$resultado = $mysqli->query("SELECT * FROM comida WHERE id=".$idX);
    $fila = $resultado->fetch_object();
    echo "<h1> Editar " . $fila->nombre . "\n"."</h1>";
    ?>
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
          
           <form action='procesar.php' id="miform" method='GET' data-ajax="false">

   <input type="text" value="<?php echo $fila->nombre; ?>"  required name='Comida' placeholder="Nombre del Platillo" id="Com" class="custom" />
                          
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         </label>
                         <!-- <input type="date" name="fechas[]"><br><br>-->
                         <div data-role="fieldcontain" id ="<?php echo $fila->id?>"></div>
                         <input type="hidden" name="opc" value="3">
                          <label>Agregar Ingrediente</label><img onclick="myFunctioninput()" title="Agregar Ingrediente" WIDTH='5%' HEIGHT='5%' src="images/Add.ico"> </img><br>
                          <label>Agregar preparacion</label><img onclick="myFunctioninputPrep()" title="Agregar Preparacion" WIDTH='5%' HEIGHT='5%' src="images/addPrep.png"> </img>
                          
                          <input name="X" id="contar" type="hidden" value="0" > 
                          <input name="X" id="contarPrep" type="hidden" value="0" > 
                          <hr style="border: 0; border-top: 1px solid #999; border-bottom: 1px solid #333; height:0;">Ingredientes</hr>
<div id="myDIV">
  <?php 

$mysqli->real_query ('SELECT * FROM ingredientes i WHERE i.id_comida='.$idX);

          $resultado = $mysqli->use_result();
          while ($fila = $resultado->fetch_object())
           {
            echo '<input id="X2" name="IngEdit[]" value="'.$fila->nombre.'" type="text"><br>';
            echo '<input id="X2id" name="IngEditId[]" value="'.$fila->id.'" type="hidden">';
           }

  ?>
</div>
<hr style="border: 0; border-top: 1px solid #999; border-bottom: 1px solid #333; height:0;">Preparacion</hr>
<div id="myDIV2">


<?php 

$mysqli->real_query ('SELECT * FROM preparacion p WHERE p.id_comida='.$idX);

          $resultado = $mysqli->use_result();
          while ($fila = $resultado->fetch_object())
           {
            echo '<input id="X3" name="PrepaEdit[]" value="'.$fila->nombre.'" type="text"><br>';
            echo '<input id="X4" name="PrepaEditId[]" value="'.$fila->id.'" type="hidden">';
           }

  ?>

</div>
<?php
$resultado = $mysqli->query("SELECT * FROM videos WHERE id_comida=".$idX);
    $fila = $resultado->fetch_object();

    if ($fila) 
    {
     $url= "https://www.youtube.com/watch?v=".$fila->url;
     $nameVid= $fila->nombre;
     echo "<input type='hidden' name='NuevoVideo' value='0' >";
    }    
    else 
  {
    $url= "";
    $nameVid= "";
    echo "<input type='hidden' name='NuevoVideo' value='1' >";

  }
    ?>
<label>Editar Video</label><img  title="Editar Video" WIDTH='8%' HEIGHT='8%' src="images/youtube-logo.png"> </img><br>
<input type="text" value="<?php echo $nameVid; ?>" name="namevideo" placeholder="Nombre del Video">
<input type="text" value="<?php echo $url; ?>" name="url" placeholder="URL del VIDEO"><br><br>
<input type="hidden" name="id" value="<?php echo $idX; ?>">
<input type="submit" value="Editar">
</form>
          </fieldset>
      </div>
</div><!-- /page -->

</body>
</html>
