<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Relevador;
use backend\models\Client;

/* @var $this yii\web\View */
/* @var $model backend\models\Route */
/* @var $form yii\widgets\ActiveForm */

$model->route_date = date("Y-m-d");

?>

<div class="route-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'route_date')->textInput() ?>

    <?= $form->field($model, 'user_id')->dropDownList(
        ArrayHelper::map(Relevador::find()->all(),'id','username'),
        ['prompt'=>'Select Relevator'])?>
        
    <?= $form->field($model, 'client_id')->dropDownList(
        ArrayHelper::map(Client::find()->all(),'client_id','client_name'),
        ['prompt'=>'Select Client'])?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
