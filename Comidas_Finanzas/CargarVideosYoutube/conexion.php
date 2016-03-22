<?php
function conectar($conectar)
{
    $link="";
    if($conectar==1)
        {
        $link = mysql_connect('localhost','root','') 
                or die ("No se pudo conectar :(");
        mysql_select_db('videos')
        or die ("Base de Datos invalida ://");
        }
        if($conectar==0)
            {
            $link= mysql_connect('localhost','root','');
            mysql_close();//para cerrar la base de datos
            }
}

?>
