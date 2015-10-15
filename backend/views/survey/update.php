<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Survey */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Survey',
]) . ' ' . $model->survey_date;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Surveys'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->survey_date, 'url' => ['view', 'survey_date' => $model->survey_date, 'client_id' => $model->client_id, 'user_id' => $model->user_id, 'prod_id' => $model->prod_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="survey-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
