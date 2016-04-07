<?php 

include '../../conexion.php';
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


if(isset($_GET['url'])){

$mystring=$_GET['url'];
$nombre=$_GET['namevideo'];
$fecha='';
$findme   = '=';
$pos = strpos($mystring, $findme)+1;

if ($pos === false) {
    echo "La cadena '$findme' no fue encontrada en la cadena '$mystring'";
} else {
    $rest = substr($mystring, $pos, 100);  // devuelve "abcde"


	try{

 if (!$mysqli->query("INSERT INTO videos (id_video,nombre,url,fecha_video,id_comida)
        VALUES
        (null,'$nombre','$rest','$fecha',$ids)"))
 { 
    throw new Exception('error!'); 
 }

}catch( Exception $e ){
	echo "<br>error type -> ".$e;
  $mysqli->rollback();
}
$mysqli->commit();
}
}
else
{
	echo "";
}

$mysqli=conectar(0);
header("location: Recetas.php");
		break;
		#############################################  CASE 3 #########################################################
		case 3:
	$id=$_GET['id'];	
	$Com=$_GET['Comida'];
	$IngEdit=$_GET['IngEdit'];
	$PrepaEdit=$_GET['PrepaEdit'];
	$IngEditId=$_GET['IngEditId'];
	$PrepaEditId=$_GET['PrepaEditId'];
	$video=$_GET['NuevoVideo'];
 $ids= $id;
if (isset($_GET['Ing'])) {
	$Ing=$_GET['Ing'];
	// INSERTAR INGREDIENTES NUEVOS
//var_dump($Ing);
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

}
}

if (isset($_GET['Prepa'])) {
	$Prepa=$_GET['Prepa'];

//	var_dump($Prepa);
	// INSERTAR PREPARACION NUEVOS
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
}

	//echo 
	$Com;
	//echo "<br>";
	//var_dump($Ing);
	//echo "<br>";
	//var_dump($Prepa);

try{

 if (!$mysqli->query("UPDATE comida SET nombre = '$Com' where id = $id "))
 { 
    throw new Exception('error!'); 
 }

}catch( Exception $e ){
	echo "<br>error type -> ".$e;
  $mysqli->rollback();
}
$mysqli->commit();

// ACTUALIZAR INGREDIENTES
for ($i=0; $i <count($IngEdit) ; $i++) { 
	try{

 if (!$mysqli->query("UPDATE ingredientes SET nombre ='".$IngEdit[$i]."' WHERE id = ".$IngEditId[$i]))
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

# EDITAR PREPARACIONES
for ($i=0; $i <count($PrepaEdit) ; $i++) { 
	try{

 if (!$mysqli->query("UPDATE preparacion  SET nombre = '".$PrepaEdit[$i]."' WHERE id = ".$PrepaEditId[$i]))
 { 
    throw new Exception('error!'."UPDATE preparacion  SET nombre = '".$PrepaEdit[$i]."' WHERE id = ".$PrepaEditId[$i]); 
 }

}catch( Exception $e ){
	echo "<br>error type -> ".$e;
  $mysqli->rollback();
}
$mysqli->commit();

	# code...
}


echo $video;

if ($video==0) {
//EDITAR VIDEO
if(isset($_GET['url'])){

$mystring=$_GET['url'];
$nombre=$_GET['namevideo'];
$fecha='';
$findme   = '=';
$pos = strpos($mystring, $findme)+1;

if ($pos === false) {
    echo "La cadena '$findme' no fue encontrada en la cadena '$mystring'";
} else {
    $url = substr($mystring, $pos, 100);  // devuelve "abcde"


	try{

 if (!$mysqli->query("UPDATE videos SET nombre='$nombre',url='$url' WHERE id_comida=$ids"))
 { 
    throw new Exception('error!'); 
 }

}catch( Exception $e ){
	echo "<br>error type -> ".$e;
  $mysqli->rollback();
}
$mysqli->commit();
}
}
else
{
	echo "";
}	
}
else
{
	$mystring=$_GET['url'];
$nombre=$_GET['namevideo'];
$fecha='';
$findme   = '=';
$pos = strpos($mystring, $findme)+1;

if ($pos === false) {
    echo "La cadena '$findme' no fue encontrada en la cadena '$mystring'";
} else {
    $url = substr($mystring, $pos, 100);  // devuelve "abcde"

		try{

 if (!$mysqli->query("INSERT INTO videos (id_video,nombre,url,id_comida) VALUES  (null,'$nombre','$url',$ids)"))
 { 
    throw new Exception('error!'."INSERT INTO videos (id_video,nombre,url,id_comida) VALUES  (null,'$nombre','$url',$ids)"); 
 }

}catch( Exception $e ){
	echo "<br>error type -> ".$e;
  $mysqli->rollback();
}}
$mysqli->commit();
}


$mysqli=conectar(0);
header("location: edit.php?id=".$ids);
		break;
	default:
		# code...
		break;
		#############################################  CASE 4 #########################################################
		case 4:
			echo $id=$_GET['id'];


			//ELIMINAR COMIDA
			try{
 if (!$mysqli->query("DELETE FROM comida  where id =".$id))
 { 
    throw new Exception('error!'); 
 }

}catch( Exception $e ){
	echo "<br>error type -> ".$e;
  $mysqli->rollback();
}
$mysqli->commit();

			//ELIMINAR HISTORICO
			try{
 if (!$mysqli->query("DELETE FROM historico  where id_comida =".$id))
 { 
    throw new Exception('error!'); 
 }

}catch( Exception $e ){
	echo "<br>error type -> ".$e;
  $mysqli->rollback();
}
$mysqli->commit();

			//ELIMINAR INGREDIENTES
			try{
 if (!$mysqli->query("DELETE FROM ingredientes  where id_comida =".$id))
 { 
    throw new Exception('error!'); 
 }

}catch( Exception $e ){
	echo "<br>error type -> ".$e;
  $mysqli->rollback();
}
$mysqli->commit();

			//ELIMINAR PREPARACION
			try{
 if (!$mysqli->query("DELETE FROM preparacion  where id_comida =".$id))
 { 
    throw new Exception('error!'); 
 }

}catch( Exception $e ){
	echo "<br>error type -> ".$e;
  $mysqli->rollback();
}
$mysqli->commit();

			//ELIMINAR VIDEOS
			try{
 if (!$mysqli->query("DELETE FROM videos  where id_comida =".$id))
 { 
    throw new Exception('error!'); 
 }

}catch( Exception $e ){
	echo "<br>error type -> ".$e;
  $mysqli->rollback();
}
$mysqli->commit();

$mysqli=conectar(0);
header("location: Recetas.php");

			break;
}


?>