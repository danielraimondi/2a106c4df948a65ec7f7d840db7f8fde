<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ClientController implements the CRUD actions for Client model.
 */
class MapController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Client models.
     * @return mixed
     */
    public function actionIndex()
    {
        $clients = \backend\models\Client::find()->asArray()->all();
        $relevators = \backend\models\Relevador::find()->asArray()->all();
        return $this->render('index', [
            'clients' => $clients,
            'relevators' => $relevators] );
    }

    
}
