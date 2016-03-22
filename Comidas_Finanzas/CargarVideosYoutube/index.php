<!DOCTYPE html>
<html>          
                    <div width='40%' style='width:300px ;height:270px; background-color:#CCCCCC;'><img src="img/icons/social_4.png"></img>
                    <font color="#ffffff" size="4" face="Comic Sans MS, Arial, MS Sans Serif">Video Nombre</font>
<!--                    YOUTUBE--><?php

include './conexion.php';
        conectar(1);

                                 $sql="SELECT * FROM videos
WHERE fecha_video=(SELECT MAX(fecha_video) FROM videos) 
ORDER BY  fecha_video DESC";
        $cons=  mysql_query($sql);
        while ($result=  mysql_fetch_object($cons))
                {
            ?>
        <iframe width="300" height="200" src="//www.youtube.com/embed/<?php echo $result->url;?>" frameborder="0" allowfullscreen></iframe>
            <?php
                }

                ?>
<!--                  YOUTUBE-->
</div>
            </td>

        </tr>
    </table>
    
</body>
</html>