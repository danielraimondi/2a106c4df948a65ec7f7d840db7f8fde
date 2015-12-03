<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Client;

/* @var $this yii\web\View */
/* @var $model backend\models\Routeclient */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="routeclient-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'route_id')->textInput() ?>

    <?= $form->field($model, 'client_id')->dropDownList(
        ArrayHelper::map(Client::find()->all(),'client_id','client_name'),
        ['prompt'=>'Select client'])?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
