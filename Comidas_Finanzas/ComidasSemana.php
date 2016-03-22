<!DOCTYPE html> 
<?php include '../conexion.php';
$mysqli=conectar(1);
setlocale(LC_ALL,"esp");
?>
<html> 
<head> 
  <title>Comidas para la semana</title> 
  <meta name="viewport" content="initial-scale=1.0">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <link rel="stylesheet" href="jquery.mobile-1.3.1.css" />
  <script src="libs/jquery-1.9.1.min.js"></script>
  <script src="libs/jquery.mobile-1.3.1.min.js"></script>
</head> 
<body> 

<div data-role="page">

  <div data-role="header" data-position="fixed">
    <a href="index.php" data-transition="flip" >Principal</a>
    <a href="addcomida.php" data-transition="pop" >Comidas y recetas</a>
    <h1>Comidas de la semana</h1>
  </div><!-- /header -->

    <div class="ui-body">
      <h1>Comidas para esta semana</h1>
      <p>En esta seccion encontraras:
        <br><em>* Recetas</em>
        <br><em>* Videos</em>
        <br><em>* Notas</em>
        <br><em>* Precio estimado por comida</em>

    
        <?php 
$mysqli->real_query ('select * from comida c,historico h
where h.id_comida=c.id
order by h.fecha_preparacion DESC
LIMIT 5;');
          $resultado = $mysqli->use_result();
          while ($fila = $resultado->fetch_object())
           {

          ?> 
            <div data-role="collapsible" data-collapsed="true" data-theme="a">
        <h3><?php echo $fila->nombre; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php

         $fechaD= $fila->fecha_preparacion; 
         $fechats = strtotime($fechaD); //a timestamp 

switch (date('w', $fechats)){ 
    case 0: echo "Para el Domingo"; break; 
    case 1: echo "Para el Lunes"; break; 
    case 2: echo "Para el Martes"; break; 
    case 3: echo "Para el Miercoles"; break; 
    case 4: echo "Para el Jueves"; break; 
    case 5: echo "Para el Viernes"; break; 
    case 6: echo "Para el Sabado"; break; 
}  


         ?></h3>
         <b>Ingredientes</b><br><br>
        <?php  $sqlIngre="SELECT * FROM ingredientes i WHERE i.id_comida= ".$fila->id_comida;

        $consIng=mysql_query($sqlIngre);
        while ($fileIng=mysql_fetch_object($consIng)) 
        {
          echo utf8_encode($fileIng->nombre." <b>$".$fileIng->precio."</b> <br>");
        }
         ?>

         </div><!-- /collapsible -->
        <?php  
        }

         ?>

      
      
    </div><!-- /themed container -->

   

</div><!-- /page -->

</body>
</html>
