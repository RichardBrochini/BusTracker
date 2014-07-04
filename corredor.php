<?
if($_GET['cod']==''){
        $_GET['cod']=1;
}
$corredor   = file("http://200.189.189.54/InternetServices/ParadasPorCorredor?cb=jQuery172021167572867125273_1359796403660&codigoCorredor=".trim($_GET['cod']));
$corredores = explode("},{",$corredor[0]);
$i=0;
while($corredores[$i]){
	$corredores[$i] = str_replace('}]} );','',$corredores[$i]);
	$tempCorredor   = str_replace('jQuery172021167572867125273_1359796403660( {"ParadasPorCorredorResult":[{','',$corredores[$i]);
        $tempCorredor   = explode(",",$tempCorredor);
        $corredorPontos[$i]['cod'] = explode(":",$tempCorredor[0]);
        $corredorPontos[$i]['cod'] = trim($corredorPontos[$i]['cod'][1]);
        $corredorPontos[$i]['nome'] = explode(":",$tempCorredor[4]);
        $corredorPontos[$i]['nome'] = trim($corredorPontos[$i]['nome'][1]);
        $corredorPontos[$i]['lat'] = explode(":",$tempCorredor[2]);
        $corredorPontos[$i]['lat'] = trim($corredorPontos[$i]['lat'][1]);
        $corredorPontos[$i]['lon'] = explode(":",$tempCorredor[3]);
        $corredorPontos[$i]['lon'] = trim($corredorPontos[$i]['lat'][1]);
        $corredorPontos[$i]['end'] = explode(":",$tempCorredor[1]);
        $corredorPontos[$i]['end'] = trim($corredorPontos[$i]['end'][1]);
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
		<table>
		<?
			$i=0;
			while($corredorPontos[$i]){
				?>
					
					<tr><td><a href="onibus.php?cod=<? echo $corredorPontos[$i]['cod']; ?>">
					<? echo $corredorPontos[$i]['nome']; ?><br><? echo $corredorPontos[$i]['end']; ?>   </a></td> 					
					</tr>
				<?
				$i++;
			}
		?>
		</table>
	</div>
	</body>
</html>
