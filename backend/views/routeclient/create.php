<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Routeclient */

$this->title = Yii::t('app', 'Create Routeclient');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Routeclients'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="routeclient-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
