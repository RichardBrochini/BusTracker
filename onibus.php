<?
if($_GET['cod']==''){
	$_GET['cod']='340015329';
}
$onibus = file("http://200.189.189.54/InternetServices/Previsao?cb=jQuery172032039905060082674_1359795074526&codigoParada=340015329");
$onibus = explode("},{",$onibus[0]);
$corredorPontos = null;
$i = 0;
$j = 0;
while($onibus[$i]){
        $onibus[$i] = str_replace('}]} );','',$onibus[$i]);
        $tempCorredor   = str_replace('jQuery172021167572867125273_1359796403660( {"ParadasPorCorredorResult":[{','',$onibus[$i]);
        $tempCorredor   = explode(",",$tempCorredor);
	$corredorPontos[$j]['cod'] = explode(":",$tempCorredor[0]);
        $corredorPontos[$j]['cod'] = trim($corredorPontos[$j]['cod'][1]);
	if(trim($corredorPontos[$j]['cod'])!='false' && trim($corredorPontos[$j]['cod'])!='true'){
			$corredorPontos[$j]['cod'] = explode(":",$tempCorredor[0]);
        		$corredorPontos[$j]['cod'] = trim($corredorPontos[$j]['cod'][1]);
        		$corredorPontos[$j]['nome'] = explode(":",$tempCorredor[2]);
        		$corredorPontos[$j]['nome'] = trim($corredorPontos[$j]['nome'][1]);
        		$corredorPontos[$j]['lat'] = explode(":",$tempCorredor[8]);
        		$corredorPontos[$j]['lat'] = trim($corredorPontos[$j]['lat'][1]);
        		$corredorPontos[$j]['lon'] = explode(":",$tempCorredor[9]);
        		$corredorPontos[$j]['lon'] = trim($corredorPontos[$j]['lon'][1]);
		$j++;
	}
	$i++;
}
?>
<html>
	<head>
		<title>BusTracker</title>
		<style>
		table tr td {
    		display:block;
    		height:100%;
    		width:500px;
    		background-color:#E8E3E3;
		}
		a:link,a:visited
		{
			display:block;
			font-weight:bold;
			color:#000000;
			background-color:#c7cdcf;
			text-align:center;
			padding:4px;
			text-decoration:none;
		}
		body {
			background-color:#c7cdcf;
		}
		</style>
	</head>
	<body>
	<div align="CENTER">
		<a name="x" href="index.html"><img src="img/logo_topo.jpg"/></a><br>
		<table >
		<?
			$i=1;
			while($corredorPontos[$i]){
				if($corredorPontos[$i]['cod']!='' && $corredorPontos[$i]['lon']!=''){
				?>
					<tr><td><a href="mapa.php?p=<? echo $corredorPontos[$i]['lon'].",".$corredorPontos[$i]['lat']; ?>"><? echo $corredorPontos[$i]['nome']." ". $corredorPontos[$i]['cod'];?></a></td></tr>
				<?
				}
				$i++;
			}
		?>
		</table>
	</div>
	</body>
</html>
