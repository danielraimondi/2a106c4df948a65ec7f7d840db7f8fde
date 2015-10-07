<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Product_cat */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Product Cat',
]) . ' ' . $model->cat_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Product Cats'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->cat_id, 'url' => ['view', 'id' => $model->cat_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="product-cat-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
