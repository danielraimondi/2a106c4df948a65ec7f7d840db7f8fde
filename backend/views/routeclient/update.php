<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Routeclient */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Routeclient',
]) . ' ' . $model->route_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Routeclients'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->route_id, 'url' => ['view', 'route_id' => $model->route_id, 'client_id' => $model->client_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="routeclient-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
