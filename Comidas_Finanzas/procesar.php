<?php 

include '../conexion.php';
$mysqli=conectar(1);
$opc=$_GET['opc'];


switch ($opc) {
	case 1:
	$checkbox=$_GET['checkbox'];
$fechas=$_GET['fechas'];

		for ($i=0; $i <count($checkbox) ; $i++) {

 try{

 if (!$mysqli->query("UPDATE historico SET fecha_preparacion='".$fechas[$i]."', fecha_repeticion = (SELECT CURDATE()+ INTERVAL 15 DAY HOY FROM DUAL)
WHERE id_comida= ".$checkbox[$i]))
 { 
    throw new Exception('error!'); 
 }

}catch( Exception $e ){
	echo "<br>error type -> ".$e;
  $mysqli->rollback();
}
printf("Se han guardado los datos %d\n", $mysqli->affected_rows);
$mysqli->commit();

}

header("location: ComidasSemana.php");
$mysqli=conectar(0);
		break;
	case 2:
$numero = count($_GET);
$tags = array_keys($_GET);// obtiene los nombres de las varibles
$valores = array_values($_GET);// obtiene los valores de las varibles

// crea las variables y les asigna el valor
for($i=0;$i<$numero;$i++){
echo $tags[$i];
echo "<br>";
echo $tags[$i]=$valores[$i];
echo "<br>";
echo $numero[$i];
}

	//header("location: addIng.php?id=10");
		break;
	default:
		# code...
		break;
}


?>