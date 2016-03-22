<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        include './conexion.php';
        conectar(1);
        //$fecha=  date("y-m-d a:h:i");
        $fecha=  date("y-m-d  h:i:s");
        ?>
        <form action="cargar.php" method="Post">
        URL del video:
        <input required type="text" maxlength="100" size="50" name="url"><br>
        Nombre:
        <input required type="text" maxlength="100" size="50" name="nombre" value="Video<?php echo $fecha; ?>"><br>
        <input required type="hidden" maxlength="100" size="50" name="fecha" value="<?php echo $fecha; ?>">
        <input type="submit" name="Cargar" value="Cargar"><br><br>
        </form>
        <?php
        $sql="SELECT * FROM videos ORDER BY  fecha_video DESC";
        $cons=  mysql_query($sql);
        while ($result=  mysql_fetch_object($cons))
                {
            ?>
        <h3><?php echo $result->nombre;?></h3>
        <h4>Creado el: <?php echo $result->fecha_video;?></h4>
<!--        <input type="radio" name="group1" value="Milk">-->
            <?php // if($result->principal==1){
//     echo "Aparecer en pagina principal";}
//     else
//         {
//    echo "NO Aparecer en pagina principal";
//         }
        ?><br>
        <iframe width="300" height="200" src="//www.youtube.com/embed/<?php echo $result->url;?>" frameborder="0" allowfullscreen></iframe>
        <a title="Editar video" href="Funciones_Video.php?id=<?php echo $result->id_video;?>&opc=1"><img src="img/icons/edit.png">Editar</a>
            <?php
                }
                
        ?>
        
    </body>
</html>
