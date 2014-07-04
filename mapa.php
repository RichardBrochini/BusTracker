<!DOCTYPE html>
<html>
  <head>
    <title>Bus Tracker</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      html, body, #map_canvas {
        margin: 0;
        padding: 0;
        height: 100%;
        background-color:#c7cdcf;
      }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true"></script><script>
      var directionDisplay;
      var directionsService = new google.maps.DirectionsService();    
	  var onibus = new google.maps.LatLng(<? echo $_GET['p']; ?>);
	  var eu     = new google.maps.LatLng(<? echo $_GET['eu']; ?>);
<?if($_GET['eu']==''){?>
	  if(navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            eu = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
			eu = eu+"";
			eu=eu.replace("(","");
			eu=eu.replace(")","");
			eu=eu.replace(" ","");						
			location.href='mapa.php?eu='+eu+'&p=<? echo $_GET['p']?>';
        }, function() {
          handleNoGeolocation(true);
        });
      } else {
    	  eu     = new google.maps.LatLng(<? echo $_GET['eu']; ?>);
    	  handleNoGeolocation(false);
      }
<?}else{?>
	  if(eu==null){
	  	alert("Seu GPS esta desativado ou sem sinal, por favor verifique seu sinal e tente novamente");
	  }else{
	      var locationArray     = [eu,onibus];
	      var locationNameArray = ['EU','ONIBUS'];
	      var locationImg       = ['img/icone_people.png','img/icone_bus.png'];
	       
	      var mapFinal;
	      function initialize() {
	    	directionsDisplay = new google.maps.DirectionsRenderer();	  
	        var mapOptions = {
	          zoom: 14,
	          center: eu,
	      	preserveViewport:true,
	          mapTypeId: google.maps.MapTypeId.ROADMAP
	        };
	     	
	        mapFinal = new google.maps.Map(document.getElementById('map_canvas'),mapOptions);
	
	        var coord;
	        for (coord in locationArray) {
	          new google.maps.Marker({
	            position: locationArray[coord],
	            map: mapFinal,
	            title: locationNameArray[coord],
	            icon: locationImg[coord]
	          });
	        }
	        directionsDisplay.setMap(mapFinal);
	           var request = {
	                origin:eu,
	                destination:onibus,
	                travelMode: google.maps.DirectionsTravelMode.WALKING
	            };
	            directionsService.route(request, function(response, status) {
	              if (status == google.maps.DirectionsStatus.OK) {
	                directionsDisplay.setDirections(response);
	                }
	            });        
	      }    
	      google.maps.event.addDomListener(window, 'load', initialize);	  	
	  }      	
 <?}?>
    </script>
  </head>
  <body>
	<div align="CENTER">
		<a name="x" href="index.html"><img src="img/logo_topo.jpg"/></a>
	</div>
	<?if($_GET['eu']==''){?>
			<br/><br/><br/>
			<center>
				<h1>Pegando Coordenadas..</h1>
			</center>
	<?}else{?>
	    <div id="map_canvas"></div>		
	<?}?>	
  </body>
</html>
