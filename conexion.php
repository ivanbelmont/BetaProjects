
<?php
function conectar($con)
{
    if ($con == 1) {
        # Conectar...
        #$mysqli = new mysqli('localhost','root','','comidas');//Local 
        $mysqli = new mysqli("mysql.hostinger.es", "u824935582_admin", "mgWwqJ73cLa", "u824935582_beta");//HOSTING
if ($mysqli->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

    }//END 1
    if ($con == 0) {

        # Desconectar...
       #$mysqli = new mysqli('localhost','root','','comidas');//Local 
       $mysqli = new mysqli("mysql.hostinger.es", "u824935582_admin", "mgWwqJ73cLa", "u824935582_beta");
if ($mysqli->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        $mysqli->close();
    }

}
//
return $mysqli;
}
?>
