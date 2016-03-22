<?php 

include '../conexion.php';
conectar(1);

$checkbox=$_GET['checkbox'];
$fechas=$_GET['fechas'];

for ($i=0; $i <count($checkbox) ; $i++) {

 $sql="UPDATE historico SET fecha_preparacion='".$fechas[$i]."', fecha_repeticion = (SELECT CURDATE()+ INTERVAL 15 DAY HOY FROM DUAL)
WHERE id_comida= ".$checkbox[$i];
mysql_query($sql);
//echo $checkbox[$i]; 
//echo $fechas[$i];
}

header("location: ComidasSemana.php")
?>