<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\RelevadorSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="relevador-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'password_hash') ?>

    <?= $form->field($model, 'auth_key') ?>

    <?php // echo $form->field($model, 'confirmed_at') ?>

    <?php // echo $form->field($model, 'unconfirmed_email') ?>

    <?php // echo $form->field($model, 'blocked_at') ?>

    <?php // echo $form->field($model, 'registration_ip') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'flags') ?>

    <?php // echo $form->field($model, 'user_lat') ?>

    <?php // echo $form->field($model, 'user_lng') ?>

    <?php // echo $form->field($model, 'user_radius') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
