<?php


session_start();


?>

<html lang="en">
<head>
  <meta charset="UTF-8">
  
<meta name="format-detection" content="telephone=no">
<meta name="msapplication-tap-highlight" content="no">
<meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width">
<title>AQUAFILTEK</title>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

<link rel="stylesheet" href="trakin.css" >

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

<link rel="stylesheet" type="text/css" href="js/alertify.js/themes/alertify.core.css" />
<link rel="stylesheet" type="text/css" href="js/alertify.js/themes/alertify.default.css" />
<link rel="stylesheet" type="text/css" href="js/alertify.js/themes/alertify.bootstrap.css" />
<script type="text/javascript" src="js/alertify.js/lib/alertify.min.js"></script>

<style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #floating-panel {
       
        
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }
    </style>
<style>
    .gm-style .gm-style-iw-c {
      padding-top: 0px;padding-left: 0px;

      background: linear-gradient(-90deg, #007BFF, #007BFF); 
      overflow-y:hidden!important;
      overflow-x:hidden!important;

    }
    .gm-style-iw-d{
      background: linear-gradient(-90deg, #007BFF, #007BFF); 
      overflow-y:hidden!important;
      overflow-x:hidden!important;
    }
          </style>
</head>
<body>
<nav class="navbar navbar-default" style="background-color: #007BFF;">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
            <a class="navbar-brand" href="#" style="color:#ffffff; font-family: 'Roboto Black'">AQUAFILTEK Rutas</a>
    </div>

  
  </div><!-- /.container-fluid -->
</nav>

<div class="container" style="margin: 0px; padding: 0px;">
    <article class="card" style="height: 820px;">
        <div class="card-body">
            <input type="hidden" id="n_orden" name="n_orden" value="<?php echo  $contenido; ?>">
            <input type="hidden" id="id_driver" name="id_driver" value="<?php echo  $resultado[0]["id_driver"]; ?>">


         
            <div id="floating-panel">
    <b>Mode of Travel: </b>
    <select id="mode">
      <option value="DRIVING">Conducir </option>
      <option value="WALKING">Caminar </option>
      <option value="BICYCLING">Ciclismo </option>
      <option value="TRANSIT">Transit</option>
    </select>
    </div>
    <style type="text/css">      
      #map_canvas { /* Must bigger size than 100x100 pixels */
        width: 100%;
        height: 90%;
      }
      </style>
    <div id="map" style="height:540px"></div>
    <canvas height="79px" width="50px" id="micanvas"></canvas>

    <hr>
          
    

    

          <a href="sms:58426745124"><img src="mensaje.svg"  style="width:40px; height:40px"></a>
          <a href="tel:58426745124"><img src="phone.svg"  style="width:40px; height:40px"> </a>



    </article>
</div>

</div>







    <script>



$("#micanvas").hide();

      function initMap() {
        

var geocoder  = new google.maps.Geocoder();             // create a geocoder object
var location  = new google.maps.LatLng(10.484726, -66.951628);    // turn coordinates into an object          
geocoder.geocode({'latLng': location}, function (results, status) {
if(status == google.maps.GeocoderStatus.OK) {           // if geocode success
var add=results[0].formatted_address;         // if address found, pass to processing function
console.log(add);
}
});



        var directionsRenderer = new google.maps.DirectionsRenderer;
        var directionsService = new google.maps.DirectionsService;
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 14,
        });
        directionsRenderer.setMap(map);

        calculateAndDisplayRoute(directionsService, directionsRenderer);
        document.getElementById('mode').addEventListener('change', function() {
          calculateAndDisplayRoute(directionsService, directionsRenderer);
        });
      }

      function calculateAndDisplayRoute(directionsService, directionsRenderer) {
        var selectedMode = document.getElementById('mode').value;
        directionsService.route({
          origin: {lat: 10.487081, lng: -66.951628},  // Haight.        
          destination: {lat:  10.484726, lng: -66.938918},  // Ocean Beach.
          // Note that Javascript allows us to access the constant
          // using square brackets and a string value as its
          // "property."
          travelMode: google.maps.TravelMode[selectedMode]
        }, function(response, status) {
          if (status == 'OK') {
            directionsRenderer.setDirections(response);
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDIGdFBFq3BZoAY8qAROElO2PZzN5PLCmY&callback=initMap">
    </script>



<script>
function cancelar_soli(){
  $.post("controlador/schema_base/tbl_ordenes.php", {
      accion:"cancelar_soli",
      id_orden:$("#n_orden").val(),
      id_driver:$("#id_driver").val()
    }, 
		function procesar(data){
      location.reload();
        
          

      }, "json");
}
</script>

<script>
function confirmar_soli(){
  $.post("controlador/schema_base/tbl_ordenes.php", {
      accion:"aceptar_solic",
      id_orden:$("#n_orden").val()
    }, 
		function procesar(data){

      location.reload();
        
          

      }, "json");
}


function yatienesorden(){
  $.post("controlador/schema_base/tbl_ordenes.php", {
      accion:"tengo_orden",
      id_orden:$("#n_orden").val()
    }, 
		function procesar(data){

      location.reload();
        
          

      }, "json");
}

function entregeor(){
  $.post("controlador/schema_base/tbl_ordenes.php", {
      accion:"termi_orden",
      id_orden:$("#n_orden").val()
    }, 
		function procesar(data){

      location.reload();
        
          

      }, "json");
}



</script>



</body>
</html>
