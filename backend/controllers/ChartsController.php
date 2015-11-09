<?php

namespace backend\controllers;

use Yii;
use backend\models\charts;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class ChartsController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    
   

}
