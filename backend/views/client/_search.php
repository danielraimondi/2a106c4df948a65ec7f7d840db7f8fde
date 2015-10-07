<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ClientSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="client-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'client_id') ?>

    <?= $form->field($model, 'client_name') ?>

    <?= $form->field($model, 'client_lat') ?>

    <?= $form->field($model, 'client_long') ?>

    <?= $form->field($model, 'priority') ?>

    <?php // echo $form->field($model, 'open_time') ?>

    <?php // echo $form->field($model, 'close_time') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
