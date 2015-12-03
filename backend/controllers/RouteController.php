<?php

namespace backend\controllers;

use Yii;
use backend\models\Route;
use backend\models\RouteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RouteController implements the CRUD actions for Route model.
 */
class RouteController extends Controller
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
     * Lists all Route models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RouteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Route model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($route_date, $user_id, $client_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($route_date, $user_id, $client_id),
        ]);
    }

    /**
     * Creates a new Route model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Route();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'route_date' => $model->route_date, 'user_id' => $model->user_id, 'client_id' => $model->client_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Route model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($route_date, $user_id, $client_id)
    {
        $model = $this->findModel($route_date, $user_id, $client_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'route_date' => $model->route_date, 'user_id' => $model->user_id, 'client_id' => $model->client_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Route model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($route_date, $user_id, $client_id)
    {
        $this->findModel($route_date, $user_id, $client_id )->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Route model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Route the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($route_date, $user_id, $client_id)
    {
        if (($model = Route::findOne(['route_date' => $route_date, 'user_id' => $user_id, 'client_id' => $client_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
