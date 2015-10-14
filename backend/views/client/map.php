<?php

use yii\helpers\Html;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $model backend\models\ClientSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Map');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-map">

    <?php
        $models = $dataProvider->getModels();
        $locations = array();
        foreach ($models as $model) {
            $locations[] = array('id'=>$model->client_id, 'name'=>$model->client_name, 'lat'=>$model->client_lat, 'lng'=>$model->client_long);
        }
    ?>
    
    
<div id="map" style="height:800px; width:100%;"></div>

</div>

<script>

  // In the following example, markers appear when the user clicks on the map.
  // The markers are stored in an array.
  // The user can then click an option to hide, show or delete the markers.
  var map;
  var markers = [];
      
  var locations = <?php echo json_encode($locations) ?> ;
  
  function initMap() {
    var center = {lat: -34.893753, lng: -56.165217};
  
    map = new google.maps.Map(document.getElementById('map'), {
    zoom: 13,
    center: center,
    mapTypeId: google.maps.MapTypeId.TERRAIN
    });
          
    for (l in locations){
        var marker = new google.maps.Marker({
            position: {lat: locations[l].lat, lng: locations[l].lng},
            map: map
        });
        markers.push(marker);
        
        var content = 'ID: '+locations[l].id+'<br>Name: '+locations[l].name;     

        var infowindow = new google.maps.InfoWindow();

        google.maps.event.addListener(marker,'click', (function(marker,content,infowindow){ 
            return function() {
                infowindow.setContent(content);
                infowindow.open(map,marker);
            };
        })(marker,content,infowindow)); 
        
    }
    
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


