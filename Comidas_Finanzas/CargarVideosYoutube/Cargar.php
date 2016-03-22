<?php
include './conexion.php';
conectar(1);
$mystring=$_POST['url'];
$nombre=$_POST['nombre'];
$fecha=$_POST['fecha'];
$findme   = '=';
$pos = strpos($mystring, $findme)+1;

// Nótese el uso de ===. Puesto que == simple no funcionará como se espera
// porque la posición de 'a' está en el 1° (primer) caracter.
if ($pos === false) {
    echo "La cadena '$findme' no fue encontrada en la cadena '$mystring'";
} else {
    $rest = substr($mystring, $pos, 100);  // devuelve "abcde"
//    echo "Link anterior  $mystring<br>";
//    echo "Link nuevo   //www.youtube.com/embed/$rest<br>";
//    echo " y existe en la posición $pos";
    $sql="INSERT INTO videos (id_video,nombre,url,fecha_video,principal)
        VALUES
        (null,'$nombre','$rest','$fecha',0)";
    mysql_query($sql) or die ("Error al cargar el video<br><a href='Admin_videos.php'>Regresar</a><br>".mysql_error());
}?>
 <script languaje="JavaScript" type="text/javascript">
     var nombre="<?php echo $nombre?>";
    alert("Video "+nombre+" Ingresado con Exito");
    location.href="Administrar.php";
</script>
        