<?php

namespace backend\controllers;

use Yii;
use backend\models\Routeclient;
use backend\models\RouteclientSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RouteclientController implements the CRUD actions for Routeclient model.
 */
class RouteclientController extends Controller
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
     * Lists all Routeclient models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RouteclientSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Routeclient model.
     * @param integer $route_id
     * @param integer $client_id
     * @return mixed
     */
    public function actionView($route_id, $client_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($route_id, $client_id),
        ]);
    }

    /**
     * Creates a new Routeclient model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Routeclient();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'route_id' => $model->route_id, 'client_id' => $model->client_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Routeclient model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $route_id
     * @param integer $client_id
     * @return mixed
     */
    public function actionUpdate($route_id, $client_id)
    {
        $model = $this->findModel($route_id, $client_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'route_id' => $model->route_id, 'client_id' => $model->client_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Routeclient model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $route_id
     * @param integer $client_id
     * @return mixed
     */
    public function actionDelete($route_id, $client_id)
    {
        $this->findModel($route_id, $client_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Routeclient model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $route_id
     * @param integer $client_id
     * @return Routeclient the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($route_id, $client_id)
    {
        if (($model = Routeclient::findOne(['route_id' => $route_id, 'client_id' => $client_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
