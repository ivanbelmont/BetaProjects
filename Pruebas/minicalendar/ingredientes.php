<?php 

include 'conexion.php';
$mysqli=conectar(1);
   
$id=$_POST['id'];
echo "<h3 style='color:RED;'>ingredientes</h3>";
$mysqli->real_query ('SELECT * FROM ingredientes i WHERE i.id_comida='.$id);
          $resultado = $mysqli->use_result();
          while ($fila = $resultado->fetch_object())
           {
			echo "<h4>".$fila->nombre."</h4>"; 
           }

?>
<h2 style='color:RED;'>Pasos preparacion</h2>
<?php
$mysqli->real_query ('SELECT * FROM preparacion p WHERE p.id_comida='.$id);
          $resultado = $mysqli->use_result();
          while ($fila = $resultado->fetch_object())
           {
			echo "<h5>".$fila->nombre."</h5>"; 
           }
?>