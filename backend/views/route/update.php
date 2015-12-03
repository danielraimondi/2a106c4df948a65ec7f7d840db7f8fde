<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Route */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Route',
]) . ' ' . $model->route_date;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Routes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->route_date, 'url' => ['view', 'route_date' => $model->route_date, 'client_id' => $model->client_id, 'user_id' => $model->user_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="route-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
