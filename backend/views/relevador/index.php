<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RelevadorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Relevadors');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="relevador-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'username',
            //'email:email',
            //'password_hash',
            //'auth_key',
            // 'confirmed_at',
            // 'unconfirmed_email:email',
            // 'blocked_at',
            // 'registration_ip',
            // 'created_at',
            // 'updated_at',
            // 'flags',
            'user_lat',
            'user_lng',
            'user_radius',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
