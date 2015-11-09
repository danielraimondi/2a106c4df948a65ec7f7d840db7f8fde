<?php
/* @var $this yii\web\View */
use yii\helpers\Html;

$this->title = 'tablaProductos';


?>

<?php

$Productos = Yii::api()->web->v1->products();
echo Yii::api()->web->v1->products();


?>