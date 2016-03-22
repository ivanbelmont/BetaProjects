<?php
function conectar($conectar)
{
    $link='';
    if($conectar==1)
        {
        $link=  mysql_connect('mysql.hostinger.es','u136363300_app','Ji75ZFbdEpr') or die ('Error al conectar a la base de datos ->'.mysql_error());
        mysql_select_db('u136363300_APP') or die ('No existe la base de datos');
        if($link){}
        }
    if($conectar==0)
        {
        
        $link= mysql_connect('mysql.hostinger.es','u136363300_app','Ji75ZFbdEpr') or die ('Error al conectar a la base de datos');
        mysql_close($link);
        }
}

?>
