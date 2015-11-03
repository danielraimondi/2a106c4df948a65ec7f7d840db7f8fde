<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Route */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Route',
]) . ' ' . $model->route_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Routes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->route_id, 'url' => ['view', 'id' => $model->route_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="route-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
