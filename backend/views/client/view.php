<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Client */


$this->title = $model->client_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Clients'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->client_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->client_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'client_id',
            'client_name',
            'client_address',
            //'client_lat',
            //'client_long',
            'priority',
            'open_time',
            'close_time',
        ],
    ]) ?>
    
    <div id="map" style="height:300px; width:100%;"></div>
    


</div>

<div id= 'latitud' style= 'display: none'>
    <?php
        echo ($model->client_lat);
    ?>
</div>

<div id= 'longitud' style= 'display: none' >
    <?php
        echo ($model->client_long);
    ?>
</div>

<script>

  // In the following example, markers appear when the user clicks on the map.
  // The markers are stored in an array.
  // The user can then click an option to hide, show or delete the markers.
  var map;
  var markers = [];
  var lat = document.getElementById('latitud'),
      lng = document.getElementById('longitud');
 
  function initMap() {
    var center = {lat: parseFloat(lat.innerHTML), lng: parseFloat(lng.innerHTML)};
  
    map = new google.maps.Map(document.getElementById('map'), {
      zoom: 15,
      center: center,
      mapTypeId: google.maps.MapTypeId.TERRAIN
    });
  
    // This event listener will call addMarker() when the map is clicked.
  
    // Adds a marker at the center of the map.
    //addMarker(haightAshbury);
  
      
      addMarker({lat: parseFloat(lat.innerHTML), lng: parseFloat(lng.innerHTML)});
  }
  
  // Adds a marker to the map and push to the array.
  function addMarker(location) {
    var marker = new google.maps.Marker({
      position: location,
      map: map
    });
    markers.push(marker);
  }
  
  // Sets the map on all markers in the array.
  function setMapOnAll(map) {
    for (var i = 0; i < markers.length; i++) {
      markers[i].setMap(map);
    }
  }
  
  // Removes the markers from the map, but keeps them in the array.
  function clearMarkers() {
    setMapOnAll(null);
  }
  
  // Shows any markers currently in the array.
  // function showMarkers() {
  //   setMapOnAll(map);
  // }
  
  // Deletes all markers in the array by removing references to them.
  function deleteMarkers() {
    clearMarkers();
    markers = [];
  }

</script>
<script async defer
  src="https://maps.googleapis.com/maps/api/js?v=3.exp&callback=initMap">
        
</script>

