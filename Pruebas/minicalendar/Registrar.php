<?php 

include '../../conexion.php';
$mysqli=conectar(1);

$comida=$_GET['comida'];
$fecha=$_GET['fecha'];

 try{

 if (!$mysqli->query("UPDATE historico SET fecha_preparacion='".$fecha."', fecha_repeticion = (SELECT CURDATE()+ INTERVAL 15 DAY HOY FROM DUAL)
WHERE id_comida= ".$comida))
 { 
    throw new Exception('error!'); 
 }

}catch( Exception $e ){
	echo "<br>error type -> ".$e;
  $mysqli->rollback();
}
printf("Se han guardado los datos %d\n", $mysqli->affected_rows);
$mysqli->commit();



header("location: index.php");
$mysqli=conectar(0);


?>