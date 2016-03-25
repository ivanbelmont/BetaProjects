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

	$Com=$_GET['Comida'];
	$Ing=$_GET['Ing'];
	$Prepa=$_GET['Prepa'];

	echo $Com;
	echo "<br>";
	var_dump($Ing);
	echo "<br>";
	var_dump($Prepa);

// INSERTAR COMIDA
try{

 if (!$mysqli->query("INSERT INTO comida (id,nombre) VALUES (null,'$Com')"))
 { 
    throw new Exception('error!'); 
 }

}catch( Exception $e ){
	echo "<br>error type -> ".$e;
  $mysqli->rollback();
}
$mysqli->commit();

//OBTENER ID MAS ACTUAL

    $resultado = $mysqli->query("SELECT MAX(id) id FROM comida");
    $fila = $resultado->fetch_assoc();

    $ids= $fila['id'];



// INSERTAR EN HISTORIO
try{

 if (!$mysqli->query("INSERT INTO historico (id,id_comida) VALUES (null,$ids)"))
 { 
    throw new Exception('error!'); 
 }

}catch( Exception $e ){
	echo "<br>error type -> ".$e;
  $mysqli->rollback();
}
$mysqli->commit();

// INSERTAR INGREDIENTES

for ($i=0; $i <count($Ing) ; $i++) { 
	try{

 if (!$mysqli->query("INSERT INTO ingredientes (id,nombre,precio,id_comida) VALUES (null,'".$Ing[$i]."',0,$ids)"))
 { 
    throw new Exception('error!'); 
 }

}catch( Exception $e ){
	echo "<br>error type -> ".$e;
  $mysqli->rollback();
}
$mysqli->commit();

	# code...
}


// INSERTAR PREPARACION
for ($i=0; $i <count($Prepa) ; $i++) { 
	try{

 if (!$mysqli->query("INSERT INTO preparacion (id,nombre,orden,descripcion,id_comida) VALUES 
 	(null,'".$Prepa[$i]."',0,'NA',$ids)"))
 { 
    throw new Exception('error!'); 
 }

}catch( Exception $e ){
	echo "<br>error type -> ".$e;
  $mysqli->rollback();
}
$mysqli->commit();

	# code...
}

$mysqli=conectar(0);
		break;
	default:
		# code...
		break;
}


?>