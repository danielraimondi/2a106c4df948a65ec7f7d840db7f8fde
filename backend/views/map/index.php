<?php

use yii\helpers\Html;



/* @var $this yii\web\View */
/* @var $model backend\models\ClientSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Map');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-map">

   
<div id="map" style="height:800px; width:100%;"></div>

</div>

<script>

  // In the following example, markers appear when the user clicks on the map.
  // The markers are stored in an array.
  // The user can then click an option to hide, show or delete the markers.
  var map;
  var markers = [];
      
  var clients = <?php echo json_encode($clients) ?> ;
  var relevators = <?php echo json_encode($relevators) ?> ;
  
  function initMap() {
    var center = {lat: -34.893753, lng: -56.165217};
  
    map = new google.maps.Map(document.getElementById('map'), {
    zoom: 13,
    center: center,
    mapTypeId: google.maps.MapTypeId.TERRAIN
    });
    
    prev_infowindow = false;
    
    
    // MARKERS COMERCIOS
    for (c in clients){
        
        var markerIcon = {
                    url: "images/shop2.ico",
                    size: new google.maps.Size(32, 32),
                    //origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(15, 25),
                    scaledSize: new google.maps.Size(32, 32)
                };
        
        var marker = new google.maps.Marker({
            position: {lat: parseFloat(clients[c].client_lat), lng: parseFloat(clients[c].client_long)},
            map: map,
            icon: markerIcon
        });
        
        
        // var marker = new google.maps.Marker({
        //     position: {lat: parseFloat(clients[c].client_lat), lng: parseFloat(clients[c].client_long)},
        //     map: map,
        //     //icon: markerIcon
        // });
        
        markers.push(marker);
        
        var content = 'ID: '+clients[c].client_id+'<br>Name: '+clients[c].client_name;     

        var infowindow = new google.maps.InfoWindow();

        google.maps.event.addListener(marker,'click', (function(marker,content,infowindow){ 
            return function() {
                if (prev_infowindow) 
                    prev_infowindow.close();
                infowindow.setContent(content);
                infowindow.open(map,marker);
                prev_infowindow = infowindow;
            };
        })(marker,content,infowindow)); 
        
    }
    
    // MARKERS RELEVADORES
    for (r in relevators){
        
        if (relevators[r].user_lat != null && relevators[r].user_lng != null){
            
            var markerIcon = {
                    url: "images/streetview.ico",
                    size: new google.maps.Size(32, 32),
                    //origin: new google.maps.Point(25, 25),
                    anchor: new google.maps.Point(16, 24),
                    scaledSize: new google.maps.Size(32, 32)
                };
            
            var marker = new google.maps.Marker({
                position: {lat: parseFloat(relevators[r].user_lat), lng: parseFloat(relevators[r].user_lng)},
                map: map,
                icon: markerIcon
            });
        
            markers.push(marker);
            
            
            var cityCircle = new google.maps.Circle({
                strokeColor: '#0000FF',
                  strokeOpacity: 0.5,
                  strokeWeight: 0.5,
                  fillColor: '#3366FF',
                  fillOpacity: 0.1,
                  map: map,
                  center: {lat: parseFloat(relevators[r].user_lat), lng: parseFloat(relevators[r].user_lng)},
                  radius: parseFloat(relevators[r].user_radius)
                });
                
            var content = 'ID: '+relevators[r].id+'<br>Name: '+relevators[r].username;     
        
            var infowindow = new google.maps.InfoWindow();
        
            google.maps.event.addListener(marker,'click', (function(marker,content,infowindow){ 
                return function() {
                    if (prev_infowindow) 
                        prev_infowindow.close();
                    infowindow.setContent(content);
                    infowindow.open(map,marker);
                    prev_infowindow = infowindow;
                };
            })(marker,content,infowindow));
        
        }
        
    }
    
    // // CERRAR INFOWINDOW
    // map.addListener('click', function(event) {
    //   if (prev_infowindow)
    //     prev_infowindow.close();
    // });
    
 }
  
  // Adds a marker to the map and push to the array.
  // function addMarker(location) {
  //   var marker = new google.maps.Marker({
  //     position: location,
  //     map: map
  //   });
  //   markers.push(marker);
  // }
  
  // Sets the map on all markers in the array.
//   function setMapOnAll(map) {
//     for (var i = 0; i < markers.length; i++) {
//       markers[i].setMap(map);
//     }
//   }
  
  // Removes the markers from the map, but keeps them in the array.
  // function clearMarkers() {
  //   setMapOnAll(null);
  // }
  
  // Shows any markers currently in the array.
  // function showMarkers() {
  //   setMapOnAll(map);
  // }
  
  // Deletes all markers in the array by removing references to them.
  // function deleteMarkers() {
  //   clearMarkers();
  //   markers = [];
  // }

</script>
<script async defer
  src="https://maps.googleapis.com/maps/api/js?v=3.exp&callback=initMap">
        
</script>


