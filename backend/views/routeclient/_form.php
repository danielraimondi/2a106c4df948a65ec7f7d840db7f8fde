<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Routeclient */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="routeclient-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'route_id')->textInput() ?>

    <?= $form->field($model, 'client_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
