<?php

class calendario{
	var $nombre_dias = array('Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado');
	function calendario(){
		
	}
	
	function mostrarBarra(){
		//proximamente
		?>
        <div id="barcal">
        	<?php $mes=date('m',time());//Obtener mes actual ?>
        	<h1><?php

switch ($mes) {
	case 1:
		echo "Enero"." del ".date('Y',time());
		break;
	case 2:
		echo "Febrero"." del ".date('Y',time());
		break;
	case 3:
		echo "Marzo"." del ".date('Y',time());
		break;
	case 4:
		echo "Abril"." del ".date('Y',time());
		break;
	case 5:
		echo "Mayo"." del ".date('Y',time());
		break;
	case 6:
		echo "Junio"." del ".date('Y',time());
		break;
	case 7:
		echo "Julio"." del ".date('Y',time());
		break;
	case 8:
		echo "Agosto"." del ".date('Y',time());
		break;
	case 9:
		echo "Septiembre"." del ".date('Y',time());
		break;
	case 10:
		echo "Octubre"." del ".date('Y',time());
		break;
	case 11:
		echo "Noviembre"." del ".date('Y',time());
		break;
	case 12:
		echo "Diciembre"." del ".date('Y',time());
		break;

	
	default:
		# code...
		break;
}
 ?></h1>
        </div>
        <?php
	}
	
	function mostrar(){
		include '../../conexion.php';
        $mysqli=conectar(1);

		$mes=date('m',time());//Obtener mes actual
		$anio=date('Y',time());
		//dias mes anterior
		if($mes==1){ $mes_anterior=12; $anio_anterior = $anio-1; }
		else{ $mes_anterior = $mes-1; $anio_anterior = $anio; }
		
		$ultimo_dia_mes_anterior = date('t',mktime(0,0,0,$mes_anterior,1,$anio_anterior));
		
		$dia=1;
		if(strlen($mes)==1) $mes='0'.$mes;
		?>
		<table id="minical" cellpadding="0" cellspacing="0">
        <thead>
		 <tr >
		  <th><?php echo $this->nombre_dias[0]?></th>
		  <th><?php echo $this->nombre_dias[1]?></th>
		  <th><?php echo $this->nombre_dias[2]?></th>
		  <th><?php echo $this->nombre_dias[3]?></th>
		  <th><?php echo $this->nombre_dias[4]?></th>
		  <th><?php echo $this->nombre_dias[5]?></th>
		  <th><?php echo $this->nombre_dias[6]?></th>
		 </tr>
        </thead>
        <tbody>
		<?php
	
		
		$numero_primer_dia = date('w', mktime(0,0,0,$mes,$dia,$anio)); //numero dia en semana
		
		$ultimo_dia = date('t', mktime(0,0,0,$mes,$dia,$anio));
		
		$diferencia_mes_anterior = $ultimo_dia_mes_anterior - ($numero_primer_dia-1);
		
		$total_dias=$numero_primer_dia+$ultimo_dia;
		$diames=1;
		//$j dias totales (dias que empieza a contarse el 1º + los dias del mes)
		$j=1;
		while($j<=$total_dias){
			//if($j%2==0) echo "<tr class=\"odd\"> \n";
			//else 
			echo "<tr> \n";
			//$i contador dias por semana
			$i=0;
			$k=1; //dias proximo mes
			while($i<7){
				if($j<=$numero_primer_dia){
					echo "<td class=\"disabled\"> \n";
					echo "<div class=\"headbox\"> \n";
					echo $diferencia_mes_anterior;
					echo "</div>";
					echo "<div class=\"bodybox\"></div> \n";//Bandera 1
					echo "</td> \n";
					$diferencia_mes_anterior++;
				}elseif($diames>$ultimo_dia){
					echo "<td class=\"disabled\"> \n";
					echo "<div class=\"headbox\"> \n";
					echo $k;
					echo "</div>";
					echo "<div class=\"bodybox\"></div> \n";//bandera 2
					echo"</td> \n";
					$k++; //dias proximo mes
				}else{
					if($diames<10) $diames_con_cero='0'.$diames;
					else $diames_con_cero=$diames;
	
					echo "<td>";
					echo "<div class=\"headbox\"> \n";
					if (date("d")==$diames) {
						$sty="style='color:RED;'";
					}
					else{ $sty=""; }
					echo "<b ".$sty.">".$diames."</b>";

					$fechaComp=date("y-m-d");
					$fechaComp2=substr($fechaComp, 0,6);

					//echo
					 $comp=strlen($diames);

					if ($comp==1) {
						$add="0";
					}
					else
					{
						$add="";
					}

					//echo 
					$fechaComp3=$fechaComp2.$add.$diames;

					echo "</div> \n";


					$mysqli->real_query ('SELECT h.fecha_preparacion,c.nombre FROM historico h,comida c WHERE h.id_comida=c.id');
					$resultado = $mysqli->use_result();
					while ($fila = $resultado->fetch_object())
					{
					  //echo 
					  $eve=substr($fila->fecha_preparacion, 2); 
					  //echo "<br>";
					 if($fechaComp3==$eve)
					 {
					 	echo "<a title='$fila->nombre' href='#'>".$fila->nombre."</a><br>";
					 }
					 else{  echo ""; }
					}


					echo "<div class=\"bodybox\"><a href='#' title='x'></a>+</div> \n"; //BANDERA
					echo "</td> \n";
					$diames++;
				}
				$i++;
				$j++;
			}
			echo "</tr> \n";
		}
		?>
         </tbody>
		</table>
		<?php
	}

}
?>
