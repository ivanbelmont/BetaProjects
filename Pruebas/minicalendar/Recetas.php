
    <script type="text/javascript">
    function Modules(id){
      var idT =id;
      $("#Di"+idT).load('ingredientes.php', { id: idT})
      //$('#ModulosBox').css('display','none');//Cambiar valor CSS ocultar
    }
    </script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<?php 
		include '../../conexion.php';
        $mysqli=conectar(1);

?>
<a href="addcomidas.php"  title="Agregar Comida"><img src="images/Add.png" width='5%' height='5%'></a>
<a href='index.php'>Regresar</a><br><br><?php
        $mysqli->real_query ('SELECT * FROM  comida c ORDER BY nombre;');
          $resultado = $mysqli->use_result();
          while ($fila = $resultado->fetch_object())
           {
			echo "<h3 onclick='Modules(".$fila->id.")'>".$fila->nombre.
      "<a href='edit.php?id=".$fila->id."' title='Editar ".$fila->nombre."'><img  width='2%' height='5%' src='images/Edit-icon.png'></a>";
      ?>
      <a 
      onClick="if(confirm('Eliminar <?php echo $fila->nombre; ?> ?'))
       location.href='procesar.php?id=<?php echo $fila->id.'&opc=4';?>' " 
       href='#' title='Eliminar <?php echo $fila->nombre; ?>'><img  width='2%' height='5%' src='images/Delete.ico'></a></h3><?php
			echo "<div id=Di".$fila->id."></div>";
			echo '<HR width=50% align="left">';
           }

?>