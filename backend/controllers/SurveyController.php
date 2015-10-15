<?php

namespace backend\controllers;

use Yii;
use backend\models\Survey;
use backend\models\SurveySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SurveyController implements the CRUD actions for Survey model.
 */
class SurveyController extends Controller
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
     * Lists all Survey models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SurveySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Survey model.
     * @param string $survey_date
     * @param integer $client_id
     * @param integer $user_id
     * @param integer $prod_id
     * @return mixed
     */
    public function actionView($survey_date, $client_id, $user_id, $prod_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($survey_date, $client_id, $user_id, $prod_id),
        ]);
    }

    /**
     * Creates a new Survey model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Survey();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'survey_date' => $model->survey_date, 'client_id' => $model->client_id, 'user_id' => $model->user_id, 'prod_id' => $model->prod_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Survey model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $survey_date
     * @param integer $client_id
     * @param integer $user_id
     * @param integer $prod_id
     * @return mixed
     */
    public function actionUpdate($survey_date, $client_id, $user_id, $prod_id)
    {
        $model = $this->findModel($survey_date, $client_id, $user_id, $prod_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'survey_date' => $model->survey_date, 'client_id' => $model->client_id, 'user_id' => $model->user_id, 'prod_id' => $model->prod_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Survey model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $survey_date
     * @param integer $client_id
     * @param integer $user_id
     * @param integer $prod_id
     * @return mixed
     */
    public function actionDelete($survey_date, $client_id, $user_id, $prod_id)
    {
        $this->findModel($survey_date, $client_id, $user_id, $prod_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Survey model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $survey_date
     * @param integer $client_id
     * @param integer $user_id
     * @param integer $prod_id
     * @return Survey the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($survey_date, $client_id, $user_id, $prod_id)
    {
        if (($model = Survey::findOne(['survey_date' => $survey_date, 'client_id' => $client_id, 'user_id' => $user_id, 'prod_id' => $prod_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
