<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Survey */

$this->title = $model->survey_date;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Surveys'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="survey-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'survey_date' => $model->survey_date, 'client_id' => $model->client_id, 'user_id' => $model->user_id, 'prod_id' => $model->prod_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'survey_date' => $model->survey_date, 'client_id' => $model->client_id, 'user_id' => $model->user_id, 'prod_id' => $model->prod_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'survey_date',
            // 'client_id',
            // 'user_id',
            // 'prod_id',
            'user.username',
            'client.client_name',
            'prod.prod_name',
            'stock',
            'order',
        ],
    ]) ?>

</div>
