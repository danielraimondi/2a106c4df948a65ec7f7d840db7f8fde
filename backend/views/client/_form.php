<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Client */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="client-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'client_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'priority')->textInput() ?>

    <?= $form->field($model, 'open_time')->textInput() ?>
    
    <?= $form->field($model, 'close_time')->textInput() ?>
    
    <?= $form->field($model, 'client_address')->textInput() ?>
    
    <div id="map" style="height:300px; width:100%;"> </div> 
    <br>
    
    <?= $form->field($model, 'client_lat')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'client_long')->hiddenInput()->label(false) ?>
    


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

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
  
  function initMap() {
    
    var center = {lat: -34.893753, lng: -56.165217},
        latInput = document.getElementById("client-client_lat"),
        lngInput = document.getElementById("client-client_long");
    
    if (latInput.value && lngInput.value)
      center = {lat: parseFloat(latInput.value), lng: parseFloat(lngInput.value)}
      
    
    
    map = new google.maps.Map(document.getElementById('map'), {
      zoom: 15,
      center: center,
      mapTypeId: google.maps.MapTypeId.TERRAIN
    });
    
    if (latInput.value && lngInput.value)
      addMarker({lat: parseFloat(latInput.value), lng: parseFloat(lngInput.value)});
    
  
    // This event listener will call addMarker() when the map is clicked.
    map.addListener('click', function(event) {
      deleteMarkers();
      addMarker(event.latLng);
      latInput.value = event.latLng.H;;
      lngInput.value = event.latLng.L;;
    });
  

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
