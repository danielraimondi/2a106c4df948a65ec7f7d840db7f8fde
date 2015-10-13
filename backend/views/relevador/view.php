<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Relevador */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Relevadors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="relevador-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
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
            //'id',
            'username',
            //'email:email',
            //'password_hash',
            //'auth_key',
            //'confirmed_at',
            //'unconfirmed_email:email',
            //'blocked_at',
            //'registration_ip',
            //'created_at',
            //'updated_at',
            //'flags',
            //'user_lat',
            //'user_lng',
            //'user_radius',
        ],
    ]) ?>

    <div id="map" style="height:300px; width:100%;"></div>

</div>


<script>

  // In the following example, markers appear when the user clicks on the map.
  // The markers are stored in an array.
  // The user can then click an option to hide, show or delete the markers.
  var map;
  var markers = [];
  var lat = <?= $model->user_lat ?>,
      lng = <?= $model->user_lng ?>,
      radius = <?= $model->user_radius ?>;
 
  function initMap() {
    var center = {lat: parseFloat(lat), lng: parseFloat(lng)};
  
    map = new google.maps.Map(document.getElementById('map'), {
      zoom: 15,
      center: center,
      mapTypeId: google.maps.MapTypeId.TERRAIN
    });
  
    // This event listener will call addMarker() when the map is clicked.
  
    // Adds a marker at the center of the map.
    //addMarker(haightAshbury);
  
      
      addMarker({lat: parseFloat(lat), lng: parseFloat(lng)});
      drawRadius()
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
  
  function drawRadius(){
      var cityCircle = new google.maps.Circle({
      strokeColor: '#0000FF',
      strokeOpacity: 0.5,
      strokeWeight: 0.5,
      fillColor: '#3366FF',
      fillOpacity: 0.1,
      map: map,
      center: {lat: parseFloat(lat), lng: parseFloat(lng)},
      radius: parseFloat(radius)
    });
  }

</script>
<script async defer
  src="https://maps.googleapis.com/maps/api/js?v=3.exp&callback=initMap">
</script>


