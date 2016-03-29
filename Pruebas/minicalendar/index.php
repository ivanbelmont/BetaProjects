<?php require('calendario.php') ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Mini Calendar</title>
<link type="text/css" rel="stylesheet" href="table.css" />
<link type="text/css" rel="stylesheet" href="style.css" />
<script type="text/javascript" src="jquery-1.2.3.min.js"></script>
<script type="text/javascript" src="jquery.func.js"></script>
</head>

<body>
<style>
#content {
    width: 900px;
    margin: 0px auto;
    padding: 2em 1em;
}

#header {
	background-color: #EBE9EA;
    border: 1px solid #D2D2D2;
    border-radius: 8px 8px 8px 8px;
    margin-bottom: 10px;
    text-align: center;
    width: 900px;
    min-height: 150px;
}

#column-right {
	background-color: #EBE9EA;
    border: 1px solid #D2D2D2;
    border-radius: 8px 8px 8px 8px;
    float: right;
    min-height: 225px;
    margin-bottom: 10px;
    overflow: hidden;
    text-align: center;
    width: 180px;
	padding-top:10px;
}

#central {
	background-color: #EBE9EA;
    border: 1px solid #D2D2D2;
    border-radius: 8px 8px 8px 8px;
    float: left;
    min-height: 225px;
    margin-bottom: 10px;
    margin-right: 10px;
    width: 685px;
	padding:10px;
}

#footer {
	background-color: #EBE9EA;
    border: 1px solid #D2D2D2;
    border-radius: 8px 8px 8px 8px;
    margin-top: 10px;
    text-align: center;
    clear: left;
    width: 900px;
    min-height: 100px;
}

#popup {
	left: 0;
    position: absolute;
    top: 0;
    width: 100%;
    z-index: 1001;
}

.content-popup {
	margin:0px auto;
	margin-top:120px;
	position:relative;
	padding:10px;
	width:500px;
	min-height:250px;
	border-radius:4px;
	background-color:#FFFFFF;
	box-shadow: 0 2px 5px #666666;
}

.content-popup h2 {
	color:#48484B;
	border-bottom: 1px solid #48484B;
    margin-top: 0;
    padding-bottom: 4px;
}

.popup-overlay {
	left: 0;
    position: absolute;
    top: 0;
    width: 100%;
    z-index: 999;
	display:none;
	background-color: #777777;
    cursor: pointer;
    opacity: 0.7;
}

.close {
	position: absolute;
    right: 15px;
}
</style>


	<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $('#open').click(function(){
		$('#popup').fadeIn('slow');
		$('.popup-overlay').fadeIn('slow');
		$('.popup-overlay').height($(window).height());
		return false;
	});
	
	$('#close').click(function(){
		$('#popup').fadeOut('slow');
		$('.popup-overlay').fadeOut('slow');
		return false;
	});
});
</script>


<div id="calendarview">
<?php

	$objCalendario = new calendario;
	$objCalendario->mostrarBarra();
	$objCalendario->mostrar();
?>
</div>
<a href="#" id="open">click aqui</a>

<div id="popup" style="display: none;">
    <div class="content-popup">
        <div class="close"><a href="#" id="close"><img src="images/close.png"/></a></div>
        <div>
        	<h2>Registrar comida</h2>
        	<form action="Registrar.php" method="GET">
        		<select name="comida">
        		<?php

                $mysqli=conectar(1);
        		$mysqli->real_query ('SELECT DISTINCT c.id,c.nombre,h.fecha_preparacion FROM historico h, comida c
                        WHERE c.id= h.id_comida
                        AND fecha_repeticion <= (SELECT CURDATE());');
          $resultado = $mysqli->use_result();
          while ($fila = $resultado->fetch_object())
           {
           	echo "<option value='".$fila->id."'>".$fila->nombre."</option>";
           }

           	?>
           	</select><br>
        		<input type="date" name="fecha">
        		<br>
        		<input type="Submit" value="Registrar">

        	</form>
            <p></p>
            <div style="float:left; width:100%;">
    </div>
        </div>
    </div>
</div>
<div class="popup-overlay"></div>

</body>
</html>
